<?php

namespace App\Services;

use App\Models\Topup;
use App\Models\Transaction;
use App\Models\UserBalance;

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
        return $topupModel->where('user_id', $user_id)->findAll();
    }

    public function sendMoney($recipient, $amount, $note)
    {
        $userBalanceModel = new UserBalance();
        $userBalance = $userBalanceModel->where('user_id', session('id'))->first();

        if ($userBalance['balance'] < $amount) {
            return false;
        }

        $updatedBalance = $userBalance['balance'] - $amount;
        $userBalanceModel->set(['balance' => $updatedBalance])->where('user_id', session('id'))->update();
        
        $transaction = new Transaction();
        $transaction->insert([
            'user_id' => session('id'),
            'category_id' => 1,
            'amount' => $amount,
            'type' => 'Transfer',            
            'description' => $note
        ]);
    }
}
