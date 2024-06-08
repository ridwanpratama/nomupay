<?php

namespace App\Services;

use App\Models\Recipient;

class RecipientService
{
    public function addRecipient(string $phone)
    {
        $recipientMoodel = new Recipient();
        return $recipientMoodel->insert([
            'user_id' => session('id'),
            'phone' => $phone
        ]);
    }

    public function getRecipientsByUserId(): array
    {
        return (new Recipient())
            ->select('recipient.*, users.name')
            ->join('users', 'users.phone = recipient.phone', 'left')
            ->where('recipient.user_id', session('id'))
            ->findAll();
    }

}
