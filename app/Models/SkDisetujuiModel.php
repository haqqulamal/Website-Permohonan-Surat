<?php

namespace App\Models;

use CodeIgniter\Model;

class SkDisetujuiModel extends Model
{
    protected $table = 'sk_disetujui';
    protected $primaryKey = 'id_sk';
    protected $allowedFields = ['id_surat', 'nomor_sk', 'tanggal_sk', 'created_at_disetujui'];
    protected $useTimestamps = false;
}
