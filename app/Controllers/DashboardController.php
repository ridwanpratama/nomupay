<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\TransactionService;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $transactionService = new TransactionService();
        $userBalance = $transactionService->getUserBalance(session('id'));
        return view('dashboard/index', compact('userBalance'));
    }
}
