<?php

namespace App\Models;

use CodeIgniter\Model;

class UserProfile extends Model
{
    protected $table            = 'user_profile';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'user_id',
        'address',
        'city',
        'postal_code',
        'image'
    ];

    protected bool $allowEmptyInserts = false;
}
