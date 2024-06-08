<?php

namespace App\Services;

use App\Models\MasterBank;
use App\Models\Recipient;
use App\Models\UserProfile;

class BankService
{
    public function getBanks(): array
    {
        return (new MasterBank())->asArray()->findAll();
    }

    public function updateUserBankAccount($bankId, $bankNumber)
    {
        $userProfile = new UserProfile();
        $userProfile->where('user_id', session()->get('id'))
            ->set(['bank_id' => $bankId, 'bank_number' => $bankNumber])
            ->update();
    }
}
