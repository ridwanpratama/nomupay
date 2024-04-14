<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Helpers\GenerateRandomString;
use App\Helpers\SetSessionData;
use App\Services\UserService;
use App\ThirdParty\Fonnte;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;

class ForgotPasswordController extends BaseController
{
    private UserService $userService;

    /**
     * Constructor for initializing the UserService.
     */
    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * Shows the forgot password page
     *
     * @return string The rendered forgt password page
     */
    public function index()
    {
        return view('auth/forgot-password');
    }

    /**
     * Sends a reset password link to the user's phone number.
     *
     * Validates form data, generates a random token for the reset link,
     * sends the link via WhatsApp, and stores it if not already present.
     * Redirects to 'auth/forgot-password-sent' after completion.
     *
     * @return RedirectResponse Redirects the user to 'auth/forgot-password-sent'.
     */
    public function sendResetPasswordLink(): RedirectResponse
    {
        helper('form');

        $postData = $this->request->getPost();

        if (!$this->validateFormResetPasswordRequest()) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = $this->userService->findUserByPhone($postData['phone']);
        if (!$user) {
            return redirect()->to('auth/forgot-password-sent');
        }

        $fonnte               = new Fonnte();
        $generateRandomString = new GenerateRandomString();
        $token                = $generateRandomString->create();
        $message              = 'Nomupay - Berikut adalah link untuk melakukan reset password:' . PHP_EOL . base_url() . 'auth/reset-password?token=' . $token . $user['id'];
        $fonnte(str_replace('-', '', $user['phone']), $message);

        $checkTokenUrl = $this->userService->findResetPasswordUrl($user, $token);
        if (!$checkTokenUrl) {
            $this->userService->storeResetPasswordUrl($user, $token);
        }

        return redirect()->to('auth/forgot-password-sent');
    }

    /**
     * Validate the request for reset password.
     *
     * @return bool Returns true if the validation passes, false otherwise.
     */
    private function validateFormResetPasswordRequest(): bool
    {
        $rules = [
            'phone' => 'required|min_length[8]|max_length[20]',
        ];

        return $this->validate($rules);
    }

    /**
     * Shows the message reset password link sent
     *
     * @return string The rendered message reset password link sent
     */
    public function resetLinkSent(): string
    {
        return view('auth/reset-password-link-sent');
    }

    /**
     * Handles the password reset process.
     *
     * Retrieves the token from the request query parameters, extracts the user ID from the token,
     * retrieves the user associated with the ID, and validates the token.
     * If the user or the token is not found, a PageNotFoundException is thrown.
     * If the token is valid, the user is redirected to the 'auth/new-password' view to reset their password.
     *
     * @throws PageNotFoundException If the user or token is not found, or if the token is invalid.
     * @return string The view for resetting the password.
     */
    public function resetPassword(): string
    {
        $token = (string) $this->request->getGet('token');
        $id    = substr($token, -1);
        $user  = $this->userService->findUserById((int) $id);
        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }

        $checkTokenUrl = $this->userService->findResetPasswordUrl($user, substr($token, 0, -1));
        if (!$checkTokenUrl) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('auth/new-password');
    }

    /**
     * Updates a user's password based on a reset token.
     * 
     * If successful, it sets session data and redirects to the user's dashboard. Else redirect back with failed message
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects the user on success or failure (with error messages if applicable) 
     * @throws Exception If the password reset operation fails or the user is not found 
     */
    public function updateResetPassword(): RedirectResponse
    {
        helper('form');
        if (!$this->validateNewPasswordRequest()) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $token    = (string) $this->request->getPost('token');
        $password = (string) $this->request->getPost('password');
        $id       = (int) substr($token, -1);

        try {
            $user = $this->userService->findUserById((int) $id);
            if (!$this->userService->resetUserPassword($id, $password) || !$user) {
                throw new Exception('Password reset failed.');
            }
            $setSessionData = new SetSessionData();
            $setSessionData->create($user, true);
            return redirect()->to('mypanel/dashboard');
        } catch (Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    /**
     * Validate the request for reset password.
     *
     * @return bool Returns true if the validation passes, false otherwise.
     */
    private function validateNewPasswordRequest(): bool
    {
        $rules = [
            'password'         => 'required|min_length[5]|password_strength[5]',
            'confirm-password' => 'required|matches[password]',
        ];

        return $this->validate($rules);
    }
}
