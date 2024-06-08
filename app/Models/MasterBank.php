<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterBank extends Model
{
    protected $table            = 'm_bank';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [];

    protected bool $allowEmptyInserts = false;
}
