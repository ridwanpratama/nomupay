<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'phone',
        'email',
        'password',
        'last_login_ip',
    ];

    protected bool $allowEmptyInserts = false;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [
        'hashPassword',
    ];

    protected function hashPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            unset($data['data']['password_confirmation']);
        }

        return $data;
    }
}
