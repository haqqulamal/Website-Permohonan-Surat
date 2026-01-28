<?php

namespace App\Models;

use CodeIgniter\Model;

class PermohonanModel extends Model
{
    protected $table = 'permohonan_sk';
    protected $primaryKey = 'id_surat';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['id_penduduk', 'jenis_permohonan', 'keterangan', 'tanggal_permohonan', 'status', 'catatan_staff', 'catatan_lurah'];

    public function getPermohonanWithPenduduk($status = null, $id_penduduk = null)
    {
        $builder = $this->select('permohonan_sk.*, penduduk.nama_lengkap')
            ->join('penduduk', 'permohonan_sk.id_penduduk = penduduk.id_penduduk');

        if ($status) {
            $builder->where('status', $status);
        }

        if ($id_penduduk) {
            $builder->where('permohonan_sk.id_penduduk', $id_penduduk);
        }

        return $builder->findAll();
    }
}
