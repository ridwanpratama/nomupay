<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Services\UserService;
use CodeIgniter\HTTP\RedirectResponse;

class UpdatePasswordController extends BaseController
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
     * Update the user password.
     *
     * @return RedirectResponse
     */
    public function updatePassword(): RedirectResponse
    {
        $userID = session()->get('id');

        if (!$this->validatePasswordRequest()) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $newPassword = $this->request->getVar('password');
        $oldPassword = $this->request->getVar('old-password');

        if (!$this->userService->updateUserPassword($userID, $oldPassword, $newPassword)) {
            return redirect()->back()->with('errors', 'Failed to update password');
        }

        return redirect()->back()->with('success', 'Password updated successfully');
    }

    /**
     * Validate the request for updating password.
     *
     * @return bool Returns true if the validation passes, false otherwise.
     */
    private function validatePasswordRequest(): bool
    {
        $rules = [
            'password'         => 'required|min_length[5]|password_strength[5]',
            'old-password'     => 'required',
            'confirm-password' => 'required|matches[password]',
        ];

        return $this->validate($rules);
    }
}
