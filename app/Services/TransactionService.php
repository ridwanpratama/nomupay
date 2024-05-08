<?php

namespace App\Services;

use App\Models\Topup;
use App\Models\UserBalance;

class TransactionService
{
    public function storeTopupTransaction($amount, $trxId, $metode)
    {
        $topupModel = new Topup();
        return $topupModel->insert([
            'id' => $trxId,
            'user_id' => session('id'),
            'amount' => $amount,
            'payment_method' => $metode
        ]);
    }

    public function getTopupByTrxId($trxId)
    {
        $topupModel = new Topup();
        return $topupModel->where('id', $trxId)->first();
    }

    public function updateTopupTransaction($amount, $trxId)
    {
        // Start a database transaction
        $db = db_connect();
        $db->transStart();

        try {
            $topupModel = new Topup();
            $topupModel->update($trxId, ['amount' => $amount]);

            $updatedTopup = $topupModel->find($trxId);
            $user_id = $updatedTopup->user_id;

            $userBalanceModel = new UserBalance();
            $userBalance = $userBalanceModel->where('user_id', $user_id)->first();
            $updatedBalance = $userBalance->balance + $updatedTopup->amount;
            $userBalanceModel->update($user_id, ['balance' => $updatedBalance]);

            $db->transCommit();

            return $this->response->setJSON(['success' => true]);
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Transaction failed: ' . $e->getMessage());
            return $this->response->setJSON(['error' => 'Transaction failed.']);
        }
    }
}
