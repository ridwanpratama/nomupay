<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\BankService;
use App\Services\CategoryService;
use App\Services\UserService;

class SettingsController extends BaseController
{
    private $bankService;
    private $categoryService;

    public function __construct()
    {
        $this->bankService = new BankService();
        $this->categoryService = new CategoryService();
    }

    public function index()
    {
        $userService = new UserService();
        $banks = $this->bankService->getBanks();
        $userProfile = $userService->findUserProfileByUserId(session()->get('id'));
        $categories = $this->categoryService->getCategoriesByUserId(session()->get('id'));

        return view("settings/index", compact('banks', 'userProfile', 'categories'));
    }

    public function updateBank()
    {
        $bankName = $this->request->getPost('bank-name');
        $bankNumber = $this->request->getPost('bank-number');

        $this->bankService->updateUserBankAccount($bankName, $bankNumber);

        return redirect()->back();
    }

    public function addCategory()
    {
        $data = [
            'user_id' => session()->get('id'),
            'name' => $this->request->getPost('category-name'),
            'description' => $this->request->getPost('description')
        ];

        $this->categoryService->addNewCategory($data);

        return redirect()->back();
    }
}
