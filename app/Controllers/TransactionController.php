<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\TokopayLib;
use App\Models\Topup;
use App\Services\PaymentMethodService;
use App\Services\TransactionService;

class TransactionController extends BaseController
{
    private $paymentMethodService;
    private $transactionService;

    public function __construct()
    {
        $this->paymentMethodService = new PaymentMethodService();
        $this->transactionService = new TransactionService();
    }

    public function index()
    {
        $paymentMethodTypes = $this->paymentMethodService->getPaymentMethodTypes();
        return view('transaction/index', compact('paymentMethodTypes'));
    }

    public function getPaymentMethods()
    {
        $this->response->setContentType('application/json');
        $paymentMethod = $this->paymentMethodService->getPaymentMethodByType($this->request->getPostGet('type'));
        return json_encode($paymentMethod);
    }

    public function createTopup()
    {
        $postData = $this->request->getPost();
        if (!$this->validateTopupData($postData)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $amount = (float) str_replace(',', '', $postData['amount']);
        $trxId = 'TOPUP' . session('id') . date('YmdHis') . random_int(10, 99);
        $metode = $this->request->getPost('payment_method_id');

        $tokopayLib = new TokopayLib();
        $createOrder = $tokopayLib->createOrder($amount, $trxId, $metode);

        $createOrder = json_decode($createOrder, true);
    
        if ($createOrder['status'] != 'Success') {
            return redirect()->back()->withInput()->with('errors', $createOrder['status']);
        }
        $storeTopup = $this->transactionService->storeTopupTransaction($amount, $trxId, $metode);

        $session = session();
        $sessionData = [
            'trxId' => $trxId,
            'metode' => $metode,
            'amount' => $amount,
            'createOrder' => $createOrder
        ];
        $session->set($sessionData);
        
        return redirect()->to('mypanel/transaction/topup-instruction');
    }

    private function validateTopupData($postData): bool
    {
        return $this->validateData($postData, [
            'amount' => 'required|min_length[3]|max_length[6]',
            'payment_method_id' => 'required',
        ]);
    }

    public function topupInstruction()
    {
        $trxId = session()->get('trxId');
        $metode = session()->get('metode');
        $amount = session()->get('amount');
        $createOrder = session()->get('createOrder');
        return view('transaction/topup_instruction', compact('createOrder', 'amount', 'metode', 'trxId'));
    }

    public function checkTopupStatus()
    {
        $this->response->setContentType('application/json');
        $trxId = $this->request->getPostGet('trx_id');
        $topup = $this->transactionService->getTopupByTrxId($trxId);
    
        return json_encode($topup);
    }
}
