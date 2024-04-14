<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class RegisterController extends BaseController
{
    /**
     * Displays the registration form.
     *
     * @return string The HTML for the registration form.
     */
    public function index(): string
    {
        helper('form');
        return view('auth/register');
    }

    /**
     * Store a new user.
     *
     * @param array<string, string> $postData
     *
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        helper('form');

        $postData = $this->request->getPost();

        if (!$this->validateFormRegisterRequest($postData)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        if ($userModel->insert($postData)) {
            return redirect()->to('auth/login')->with('success', 'User registered successfully');
        }

        return redirect()->back()->withInput()->with('errors', $userModel->errors());
    }

    /**
     * Validate form data for user registration.
     *
     * @param array $postData The data to be validated.
     *
     * @return bool Returns true if the validation passes, false otherwise.
     */
    private function validateFormRegisterRequest($postData): bool
    {
        return $this->validateData($postData, [
            'name'                  => 'required|min_length[3]|max_length[150]',
            'phone'                 => 'required|min_length[8]|max_length[20]|is_unique[users.phone]',
            'email'                 => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'password'              => 'required|min_length[5]|max_length[255]|password_strength[5]',
            'password_confirmation' => 'required|matches[password]',
        ]);
    }
}
