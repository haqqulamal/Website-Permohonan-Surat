<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['nama_lengkap', 'email', 'role', 'id_role'];

    public function getUserWithRole($id_user)
    {
        return $this->select('user.*, roles.role_name')
            ->join('roles', 'user.id_role = roles.id_role', 'left')
            ->where('id_user', $id_user)
            ->first();
    }
}
