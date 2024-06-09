<?php

namespace App\Services;

use Throwable;
use Config\Database;
use App\Models\Topup;
use App\Models\Transaction;
use App\Models\UserBalance;
use App\Services\UserService;

class TransactionService
{
    public function storeTopupTransaction($amount, $trxId, $metode, $paymentLink)
    {
        $topupModel = new Topup();
        return $topupModel->insert([
            'id' => $trxId,
            'user_id' => session('id'),
            'amount' => $amount,
            'payment_method' => $metode,
            'payment_link' => $paymentLink
        ]);
    }

    public function getTopupByTrxId($trxId)
    {
        $topupModel = new Topup();
        return $topupModel->where('id', $trxId)->first();
    }

    public function updateTopupTransaction($amount, $trxId, $status)
    {
        $topupModel = new Topup();
        $topupModel->update($trxId, ['status' => $status]);

        $updatedTopup = $topupModel->find($trxId);
        $user_id = $updatedTopup['user_id'];

        $userBalanceModel = new UserBalance();
        $userBalance = $userBalanceModel->where('user_id', $user_id)->first();
        $updatedBalance = $userBalance['balance'] + $updatedTopup['amount'];
        $userBalanceModel->update($user_id, ['balance' => $updatedBalance]);

        return json_encode(['success' => true]);
    }

    public function getUserBalance($user_id)
    {
        $userBalanceModel = new UserBalance();
        return $userBalanceModel->where('user_id', $user_id)->first();
    }

    public function getTopUpHistory($user_id)
    {
        $topupModel = new Topup();
        return $topupModel->where('user_id', $user_id)
            ->orderBy('created_at', 'DESC')->findAll();
    }

    public function sendMoney($recipient, $amount, $note)
    {
        $db = Database::connect();
        $db->transStart();

        try {

            $userService = new UserService();
            $userRecipient = $userService->findUserByPhone($recipient);

            $userBalanceModel = new UserBalance();
            $userBalance = $userBalanceModel->where('user_id', session('id'))->first();
            $recipientBalance = $userBalanceModel->where('user_id', $userRecipient['id'])->first();

            if ($userBalance['balance'] < $amount) {
                $db->transRollback();
                return false;
            }

            $updatedBalance = $userBalance['balance'] - $amount;
            $updatedRecipientBalance = $recipientBalance['balance'] + $amount;

            $userBalanceModel->set('balance', $updatedBalance)->where('user_id', session('id'))->update();
            $userBalanceModel->set('balance', $updatedRecipientBalance)->where('user_id', $userRecipient['id'])->update();

            $transaction = new Transaction();
            $transaction->insert([
                'user_id' => session('id'),
                'category_id' => 1,
                'amount' => $amount,
                'type' => 'Transfer',
                'description' => $note,
                'recipient_no' => $userRecipient['phone']
            ]);

            $db->transCommit();
            return true;
        } catch (Throwable $e) {
            $db->transRollback();
            throw $e;
        }
    }

    public function getExpenses($user_id)
    {
        $transactionModel = new Transaction();
        return $transactionModel->where('user_id', $user_id)
            ->where('category_id', 1)
            ->where('type', 'Transfer')
            ->selectSum('amount')
            ->first();
    }

    public function getIncome($user_id)
    {
        $userService = new UserService();
        $transactionModel = new Transaction();

        $userRecipient = $userService->findUserById($user_id);
        $topupHistory = $this->getTopUpHistory($user_id);

        $topupAmount = 0;
        foreach ($topupHistory as $value) {
            $topupAmount += $value['amount'];
        }

        $received = $transactionModel->where('recipient_no', $userRecipient['phone'])
            ->where('type', 'Transfer')
            ->selectSum('amount')
            ->first();

        return $received['amount'] + $topupAmount;
    }

    public function getLatestTransactions($userId)
    {
        $transactionModel = new Transaction();
        $topupModel = new Topup();
        $userService = new UserService();
        $userRecipient = $userService->findUserById($userId);

        $transactions = $transactionModel->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $topups = $topupModel->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $received = $transactionModel->where('recipient_no', $userRecipient['phone'])
            ->where('type', 'Transfer')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $mappedTransactions = $this->mapLatestTransactions($transactions, 'Expenses', 'Send');
        $mappedTopups = $this->mapLatestTransactions($topups, 'Income', 'Top Up');
        $mappedReceived = $this->mapLatestTransactions($received, 'Income', 'Receive');

        $combined = array_merge($mappedTransactions, $mappedTopups, $mappedReceived);

        // Sorting combined transactions by created_at
        usort($combined, fn ($a, $b) => strtotime($b['created_at']) - strtotime($a['created_at']));

        return array_slice($combined, 0, 5);
    }

    private function mapLatestTransactions($transactions, $type, $category)
    {
        return array_map(fn ($transaction) => [
            'id' => $transaction['id'],
            'user_id' => $transaction['user_id'],
            'amount' => $transaction['amount'],
            'created_at' => $transaction['created_at'],
            'type' => $type,
            'category' => $category
        ], $transactions);
    }
}
