<?php

namespace App\Controllers;

use App\Services\TransactionService;

class Home extends BaseController
{
    public function index(): string
    {
        $transactionService = new TransactionService();
        $userBalance = $transactionService->getUserBalance(session('id'));

        return view('home', compact('userBalance'));
    }
}
