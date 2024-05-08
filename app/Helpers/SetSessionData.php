<?php

namespace App\Helpers;

use Config\Services;
use App\Helpers\EncryptionHelper;

class SetSessionData
{
    /**
     * Sets session data for the user.
     *
     * @param array $user The user data array.
     * @param bool $isLoggedIn The user's login status.
     * @return void
     */
    function create(array $user, bool $isLoggedIn): void
    {
        // Set other user data in the session
        $session     = session();
        $sessionData = [
            'id'             => (int) $user['id'],
            'name'           => (string) $user['name'],
            'email'          => (string) $user['email'],
            'phone'          => (string) $user['phone'],
            'isLoggedIn'     => $isLoggedIn,
            'last_login_ip'  => (string) $user['last_login_ip'],
        ];
        $session->set($sessionData);
    }
}
