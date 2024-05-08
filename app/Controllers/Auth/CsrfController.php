<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class CsrfController extends BaseController
{
    public function getToken()
    {
        $csrfToken = csrf_hash();
        return $this->response->setJSON(['csrfToken' => $csrfToken]);
    }
}
