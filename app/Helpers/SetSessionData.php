<?php

namespace App\Helpers;

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
        /**
         * @var Session $session
         */
        $session     = session();
        $sessionData = [
            'id'         => (int) $user['id'],
            'name'       => (string) $user['name'],
            'email'      => (string) $user['email'],
            'phone'      => (string) $user['phone'],
            'isLoggedIn' => $isLoggedIn,
        ];
        $session->set($sessionData);
    }
}
