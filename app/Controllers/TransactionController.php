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
        // $createOrder = $tokopayLib->createOrder($amount, $trxId, $metode);
        $createOrder = '{"data":{"nomor_va":"4041601948964285","panduan_pembayaran":"\u003col\u003e\u003cli\u003eBuka \u003cstrong\u003eBCA mobile\u003c/strong\u003e.\u003c/li\u003e\u003cli\u003ePilih menu m-Transfer.\u003c/li\u003e\u003cli\u003ePilih menu \u003cstrong\u003eBCA Virtual Account\u003c/strong\u003e.\u003c/li\u003e\u003cli\u003eMasukkan nomor \u003cstrong\u003eBCA Virtual Account\u003c/strong\u003e.\u003c/li\u003e\u003cli\u003eKlik Send.\u003c/li\u003e\u003cli\u003eCek nominal yang muncul.\u003c/li\u003e\u003cli\u003eMasukkan PIN m-\u003cstrong\u003eBCA\u003c/strong\u003e.\u003c/li\u003e\u003cli\u003eNotifikasi transaksi berhasil akan muncul.\u003c/li\u003e\u003c/ol\u003e\u003cp\u003e\u003cbr\u003e\u003c/p\u003e","pay_url":"https://pay.tokopay.id/TP240508OMCJ018041","total_bayar":19200,"total_diterima":15000,"trx_id":"TP240508OMCJ018041"},"status":"Success"}';

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
