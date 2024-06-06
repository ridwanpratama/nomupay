<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\TransactionService;

class SendController extends BaseController
{
    public function index ()
    {
        $transactionService     = new TransactionService();

        $userBalance            = $transactionService->getUserBalance(session('id'));

        return view('send/index', compact('userBalance'));
    }
}