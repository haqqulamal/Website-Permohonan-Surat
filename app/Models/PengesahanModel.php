<?php

namespace App\Models;

use CodeIgniter\Model;

class PengesahanModel extends Model
{
    protected $table = 'pengesahan_sk';
    protected $primaryKey = 'id_pengesahan';
    protected $allowedFields = ['id_sk', 'tanggal_pengesahan', 'created_at_pengesahan', 'upload_sk'];
    protected $useTimestamps = false;
}
