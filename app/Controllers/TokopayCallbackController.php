<?php

namespace App\Controllers;

use App\Services\TransactionService;
use CodeIgniter\Controller;

class TokopayCallbackController extends BaseController
{
    public function handle()
    {
        $this->response->setContentType('application/json');
        $merchant_id = env('tokopay.merchantid');
        $secret_key = env('tokopay.secretkey');

        $json = $this->request->getBody();
        $data = json_decode($json, true);

        if (isset($data['status'], $data['reff_id'], $data['signature'])) {
            $status = $data['status'];
            if ($status == "Success") {
                $ref_id = $data['reff_id'];
                $amount = (string) $data['data']['total_dibayar'];

                $signature_from_tokopay = $data['signature'];
                $signature_validation = md5("$merchant_id:$secret_key:$ref_id");

                if ($signature_from_tokopay == $signature_validation) {
                $updateBalance = $this->updateUserBalance($amount, $ref_id, $status);
                    return json_encode(['status' => true, 'data' => $updateBalance]);
                } else {
                    return $this->response->setJSON(['error' => "Invalid Signature"]);
                }
            } else {
                $updateBalance = $this->updateUserBalance(0, $ref_id, "Failed");
                return $this->response->setJSON(['error' => "Status payment tidak success"]);
            }
        } else {
            return $this->response->setJSON(['error' => "Data json tidak sesuai"]);
        }
    }

    public function updateUserBalance($amount, $trx_id, $status)
    {
        $transactionService = new TransactionService();
        return $transactionService->updateTopupTransaction($amount, $trx_id, $status);
    }
}