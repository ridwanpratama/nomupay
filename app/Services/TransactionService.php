<?php

namespace App\Services;

use App\Models\Topup;

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
}
