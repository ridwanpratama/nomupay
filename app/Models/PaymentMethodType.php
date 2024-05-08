<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentMethodType extends Model
{
    protected $table            = 'm_payment_method_type';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [];

    protected bool $allowEmptyInserts = false;
}
