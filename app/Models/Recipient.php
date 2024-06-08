<?php

namespace App\Models;

use CodeIgniter\Model;

class Recipient extends Model
{
    protected $table            = 'recipient';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'user_id',
        'phone',
    ];

    protected $uniqueFields = ['user_id', 'phone'];
    protected bool $allowEmptyInserts = false;
}
