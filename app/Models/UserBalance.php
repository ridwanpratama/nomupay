<?php

namespace App\Models;

use CodeIgniter\Model;

class UserBalance extends Model
{
    protected $table            = 'user_balance';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'user_id',
        'balance'
    ];

    protected bool $allowEmptyInserts = false;
}
