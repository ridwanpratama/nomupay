<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\UserService;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    /**
     * Check if a user with the given phone number exists
     */
    public function checkUserPhone(): ResponseInterface
    {
        $phoneNumber = (string) $this->request->getPostGet('phone-num');
        $userService = new UserService();

        $user = $userService->findUserByPhone($phoneNumber);

        if (empty($user)) {
            return $this->response->setJSON(['success' => false]);
        } else {
            return $this->response->setJSON(['success' => true]);
        }
    }
}
