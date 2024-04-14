<?php
namespace App\Services;

use App\Models\UserForgotPasswordModel;
use App\Models\UserModel;
use App\Models\UserProfile;

class UserService
{
    /**
     * Finds a user by email.
     *
     * @param string $email The email to search for
     * @return array The user data if found, or an empty array
     */
    public function findUserByEmail(string $email): array
    {
        $user = (new UserModel())
            ->asArray()
            ->where('email', $email)
            ->first();

        return $user ?? [];
    }

    /**
     * Find a user profile by user ID.
     *
     * @param int $userId The ID of the user
     * @return array The user profile data if found, or an empty array
     */
    public function findUserProfileByUserId(int $userId): array
    {
        $profile = (new UserProfile())
            ->asArray()
            ->where('id', $userId)
            ->first();

        return $profile ?? [];
    }

    /**
     * Find a user by ID.
     *
     * @param int $userId The ID of the user
     * @return array The user data if found, or an empty array
     */
    public function findUserById(int $userId): array
    {
        $user = (new UserModel())
            ->asArray()
            ->where('id', $userId)
            ->first();

        return $user ?? [];
    }

    /**
     * Updates the password of a user.
     *
     * This function checks if the provided current password matches the user's current password.
     * If the current password matches, it updates the user's password with the new password.
     *
     * @param int $userId The ID of the user whose password is to be updated.
     * @param string $currentPassword The current password of the user.
     * @param string $newPassword The new password to be set for the user.
     * @return bool True if the password is successfully updated, false otherwise.
     */

    public function updateUserPassword(int $userId, string $currentPassword, string $newPassword): bool
    {
        $user = $this->findUserById($userId);
        if ( ! $user || ! password_verify($currentPassword, $user['password'])) {
            return false;
        }

        $userModel = new UserModel();
        return $userModel->update($userId, ['password' => password_hash($newPassword, PASSWORD_DEFAULT)]);
    }

    /**
     * Find a user by ID.
     *
     * @param string $phone The phone number of the user
     * @return array The user data if found, or an empty array
     */
    public function findUserByPhone(string $phone): array
    {
        $user = (new UserModel())
            ->asArray()
            ->where('phone', $phone)
            ->first();

        return $user ?? [];
    }

    public function storeResetPasswordUrl(array $user, string $token): bool
    {
        $userForgotPasswordModel = new UserForgotPasswordModel();
        return $userForgotPasswordModel->insert([
            'user_id'    => $user['id'],
            'token'      => $token,
            'expired_at' => date('Y-m-d H:i:s', strtotime('+30 minutes')),
        ]);
    }

    public function findResetPasswordUrl(array $user, string $token)
    {
        $userForgotPasswordModel = new UserForgotPasswordModel();
        $url = $userForgotPasswordModel->where('user_id', $user['id'])
            ->where('token', $token)
            ->where('expired_at >', date('Y-m-d H:i:s'))
            ->first();
            
        return $url ?? [];
    }
}
