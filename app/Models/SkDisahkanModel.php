<?php

namespace App\Models;

use CodeIgniter\Model;

class SkDisahkanModel extends Model
{
    protected $table = 'sk_disahkan';
    protected $primaryKey = 'id_sk_disahkan';
    protected $allowedFields = ['id_pengesahan', 'tanggal_disahkan', 'upload_sk_disahkan', 'created_at_disahkan'];
    protected $useTimestamps = false;
}
