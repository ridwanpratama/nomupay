<?php

namespace App\Services;

use App\Models\UserModel;
use App\ThirdParty\Fonnte;
use App\Models\SysOtpModel;

class SysOtpService
{
    /**
     * Generates a random 6-digit numeric OTP code.
     *
     * @return string The generated OTP code, represented as a string.
     */
    public function generateOTP(): string
    {
        return (string) mt_rand(100000, 999999);
    }

    /**
     * Sends an OTP code to the given phone number via Fonnte.
     *
     * @param string $phone The recipient's phone number.
     * @param string $otp The OTP code to send.
     * @return void
     */
    public function sendOTP(string $phone, string $otp): void
    {
        $this->storeOtpCode($otp);
        $fontee = new Fonnte();
        $message = 'Nomupay - Jangan berikan ke siapapun: ' . PHP_EOL . $otp;
        $fontee($phone, $message);
    }

    /**
     * Stores the OTP code in the database.
     *
     * @param string $otp The OTP code to store.
     * @return bool Whether the insertion was successful.
     */
    public function storeOtpCode(string $otp): bool
    {
        $sysotpModel = new SysOtpModel();
        $sysOtp      = [
            'user_id'    => session()->get('id'),
            'code'       => $otp,
            'is_used'    => 0,
            'expired_at' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
        ];

        return $sysotpModel->insert($sysOtp);
    }

    /**
     * Checks if the given OTP code is valid for the current user.
     *
     * @param string $otp The OTP code to check.
     * @return bool Whether the given OTP code is valid for the current user.
     */
    public function isValid(string $code, string $ip): bool
    {
        $otp = $this->findByCodeValue($code);
        if ($otp) {
            $this->update($otp['id'], ['is_used' => 1]);
            $userModel = new UserModel();
            $userModel->update(session()->get('id'), [
                'last_login_ip'  => $ip,
            ]);
            return true;
        }

        return false;
    }

    /**
     * Find and return an array of data by OTP code value.
     *
     * @param string $codeValue The value of the code to search for.
     * @return array|null
     */
    private function findByCodeValue(string $codeValue): ?array
    {
        $model = new SysOtpModel();

        return $model->where('user_id', session('id'))
            ->where('code', $codeValue)
            ->where('is_used', 0)
            ->where('expired_at >', date('Y-m-d H:i:s'))
            ->first();
    }

    /**
     * Updates a single sys_otp row in the database.
     *
     * @param int $id The ID of the row to update.
     * @param array<string, mixed> $data The data to update the row with.
     * @return bool Whether the update was successful.
     */
    private function update(int $id, array $data): bool
    {
        $model = new SysOtpModel();

        return $model->update($id, $data);
    }
}
