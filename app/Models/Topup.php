<?php

namespace App\Models;

use CodeIgniter\Model;

class Topup extends Model
{
    protected $table            = 'topup';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['id', 'user_id', 'amount', 'payment_method', 'status'];

    protected bool $allowEmptyInserts = false;
}
