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
        $expenses = $transactionService->getExpenses(session('id'));
        $income = $transactionService->getIncome(session('id'));
        $latestTransactions = $transactionService->getLatestTransactions(session('id'));
        // dd($latestTransactions);

        return view('dashboard/index', compact('userBalance', 'expenses', 'income', 'latestTransactions'));
    }
}
