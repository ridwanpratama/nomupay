<?php

namespace App\Models;

use CodeIgniter\Model;

class UserForgotPasswordModel extends Model
{
    protected $table            = 'user_forgot_password';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'user_id',
        'token',
        'expired_at',
        'created_at',
    ];

    protected bool $allowEmptyInserts = false;
}
