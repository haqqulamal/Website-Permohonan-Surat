<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['nama_lengkap', 'email', 'role'];

    public function getUserWithRole($id_user)
    {
        return $this->where('id_user', $id_user)->first();
    }
}
