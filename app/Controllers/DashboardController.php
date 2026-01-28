<?php

namespace App\Controllers;

use App\Models\PermohonanModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $model = new PermohonanModel();
        $role_name = session()->get('role_name');
        $id_penduduk = session()->get('id_penduduk');

        $data = [
            'total_pending' => 0,
            'total_disetujui_staff' => 0,
            'total_disahkan' => 0,
        ];

        if ($role_name == 'penduduk') {
            $data['total_pending'] = $model->where(['id_penduduk' => $id_penduduk, 'status' => 'menunggu_staff'])->countAllResults();
            $data['total_disetujui_staff'] = $model->where(['id_penduduk' => $id_penduduk, 'status' => 'disetujui_staff'])->countAllResults();
            $data['total_disahkan'] = $model->where(['id_penduduk' => $id_penduduk, 'status' => 'disahkan_lurah'])->countAllResults();
        } else {
            $data['total_pending'] = $model->where('status', 'menunggu_staff')->countAllResults();
            $data['total_disetujui_staff'] = $model->where('status', 'disetujui_staff')->countAllResults();
            $data['total_disahkan'] = $model->where('status', 'disahkan_lurah')->countAllResults();
        }

        return view('dashboard/index', $data);
    }
}
