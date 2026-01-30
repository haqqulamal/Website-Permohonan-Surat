<?php

namespace App\Models;

use CodeIgniter\Model;

class PersetujuanModel extends Model
{
    protected $table = 'persetujuan_permohonan';
    protected $primaryKey = 'id_persetujuan';
    protected $allowedFields = ['id_surat', 'id_user', 'tanggal_approval', 'status', 'catatan', 'create_at'];
    protected $useTimestamps = false;
}
