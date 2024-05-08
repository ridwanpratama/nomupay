<?php

namespace App\Controllers;

use App\Services\TransactionService;
use CodeIgniter\Controller;

class TokopayCallbackController extends BaseController
{
    protected $merchant_id;
    protected $secret_key;

    public function __construct()
    {
        $this->merchant_id = env('tokopay.merchantid');
        $this->secret_key = env('tokopay.secretkey');
    }

    public function handle()
    {
        $this->response->setContentType('application/json');
        $json = $this->request->getBody();
        $data = json_decode($json, true);
        if (isset($data['status'], $data['reff_id'], $data['signature'])) {
            $status = $data['status'];
            if ($status === "Success") {
                $ref_id = $data['reff_id'];
                /*
                 * Validasi Signature
                 */
                $signature_from_tokopay = $data['signature'];
                $signature_validasi = md5($this->merchant_id . ":" . $this->secret_key . ":" . $ref_id);
                if ($signature_from_tokopay === $signature_validasi) {
                    $this->updateUserBalance($data['nominal'], $ref_id);
                    return $this->response->setJSON(['status' => true]);
                } else {
                    return $this->response->setJSON(['error' => "Invalid Signature"]);
                }
            } else {
                return $this->response->setJSON(['error' => "Status payment tidak success"]);
            }
        } else {
            return $this->response->setJSON(['error' => "Data json tidak sesuai"]);
        }
    }

    public function updateUserBalance($amount, $trx_id)
    {
        $transactionService = new TransactionService();
        return $transactionService->updateTopupTransaction($amount, $trx_id);
    }
}
