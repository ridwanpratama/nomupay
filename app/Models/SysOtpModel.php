<?php

namespace App\Models;

use CodeIgniter\Model;

class SysOtpModel extends Model
{
    protected $table            = 'sys_otp';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'user_id',
        'code',
        'is_used',
        'expired_at',
    ];

    protected bool $allowEmptyInserts = false;
}
