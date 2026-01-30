<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'login';
    protected $primaryKey = 'id_login';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['username', 'password', 'id_user', 'id_penduduk'];

    // Helper to get full user data (login + profile)
    public function getLoginData($username)
    {
        // Try linking to Admin/Staff User
        $user = $this->select('login.*, user.nama_lengkap, user.role as role_name')
            ->join('user', 'login.id_user = user.id_user', 'left')
            ->where('login.username', $username)
            ->first();

        // If not found or linked to penduduk
        if ($user && empty($user['id_user']) && !empty($user['id_penduduk'])) {
            $user = $this->select('login.*, penduduk.nama_lengkap, "penduduk" as role_name')
                ->join('penduduk', 'login.id_penduduk = penduduk.id_penduduk', 'left')
                ->where('login.username', $username)
                ->first();
        }

        return $user;
    }
}
