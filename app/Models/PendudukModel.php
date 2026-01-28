<?php

namespace App\Models;

use CodeIgniter\Model;

class PendudukModel extends Model
{
    protected $table = 'penduduk';
    protected $primaryKey = 'id_penduduk';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['nik', 'nama_lengkap', 'alamat', 'no_telp', 'email'];
}
