<?php

namespace App\Controllers;

use App\Models\PermohonanModel;
use App\Models\PendudukModel;

class PermohonanController extends BaseController
{
    public function persetujuan()
    {
        $model = new PermohonanModel();
        // Fetch only pending permohonan for staff
        $data['permohonan'] = $model->getPermohonanWithPenduduk('menunggu_staff');
        return view('permohonan/persetujuan', $data);
    }

    public function aksiStaff()
    {
        $permohonanModel = new PermohonanModel();
        $persetujuanModel = new \App\Models\PersetujuanModel();
        $skDisetujuiModel = new \App\Models\SkDisetujuiModel();

        $id_surat = $this->request->getVar('id_surat');
        $status_persetujuan = $this->request->getVar('status_persetujuan');
        $catatan = $this->request->getVar('catatan');
        $id_user = session()->get('id_user') ?? 1; // Default to admin if id_user missing

        $final_status = ($status_persetujuan == 'disetujui') ? 'disetujui_staff' : 'ditolak_staff';

        // 1. Insert into persetujuan_permohonan (New Table)
        $persetujuanModel->insert([
            'id_surat' => $id_surat,
            'id_user' => $id_user,
            'tanggal_approval' => date('Y-m-d'),
            'status' => $final_status,
            'catatan' => $catatan
        ]);

        // 2. If Approved, create Draft SK in sk_disetujui (New Table)
        if ($final_status == 'disetujui_staff') {
            $skDisetujuiModel->insert([
                'id_surat' => $id_surat,
                'nomor_sk' => '470/' . $id_surat . '/SK/' . date('Y'), // Simple generator
                'tanggal_sk' => date('Y-m-d')
            ]);
        }

        // 3. Update Status in Main Table (For View Compatibility)
        $permohonanModel->update($id_surat, [
            'status' => $final_status,
            'catatan_staff' => $catatan
        ]);

        return redirect()->to(base_url('/permohonan/persetujuan'))->with('success', 'Keputusan staff berhasil disimpan.');
    }

    public function pengesahan()
    {
        $model = new PermohonanModel();
        // Fetch only approved by staff for lurah
        $data['permohonan'] = $model->getPermohonanWithPenduduk('disetujui_staff');
        return view('permohonan/pengesahan', $data);
    }

    public function pengesahanAdd($id_surat)
    {
        $model = new PermohonanModel();
        $data['permohonan'] = $model->select('permohonan_sk.*, penduduk.nama_lengkap')
            ->join('penduduk', 'permohonan_sk.id_penduduk = penduduk.id_penduduk')
            ->find($id_surat);
        return view('permohonan/pengesahan_add', $data);
    }

    public function aksiLurah()
    {
        $permohonanModel = new PermohonanModel();
        $pengesahanModel = new \App\Models\PengesahanModel();
        $skDisahkanModel = new \App\Models\SkDisahkanModel();
        $skDisetujuiModel = new \App\Models\SkDisetujuiModel();

        $id_surat = $this->request->getVar('id_surat');
        $status_pengesahan = $this->request->getVar('status_pengesahan');
        $catatan = $this->request->getVar('catatan');

        // Find id_sk first
        $skDraft = $skDisetujuiModel->where('id_surat', $id_surat)->first();
        $id_sk = $skDraft['id_sk'] ?? 0;

        $final_status = ($status_pengesahan == 'Sahkan') ? 'disahkan_lurah' : 'ditolak_lurah';

        // 1. Insert into pengesahan_sk (New Table)
        $pengesahanModel->insert([
            'id_sk' => $id_sk,
            'tanggal_pengesahan' => date('Y-m-d'),
            'upload_sk' => null // Draft
        ]);
        $id_pengesahan = $pengesahanModel->getInsertID();

        // 2. If Approved, Finalize in sk_disahkan (New Table)
        if ($final_status == 'disahkan_lurah') {
            $skDisahkanModel->insert([
                'id_pengesahan' => $id_pengesahan,
                'tanggal_disahkan' => date('Y-m-d'),
                'upload_sk_disahkan' => 'Surat_Final_Generated.pdf' // Placeholer or link to PDF controller
            ]);
        }

        // 3. Update Status in Main Table (For View Compatibility)
        $permohonanModel->update($id_surat, [
            'status' => $final_status,
            'catatan_lurah' => $catatan
        ]);

        return redirect()->to(base_url('/pengesahan'))->with('success', 'Pengesahan lurah berhasil disimpan.');
    }

    public function riwayat()
    {
        $model = new PermohonanModel();
        $id_penduduk = session()->get('id_penduduk');
        $data['permohonan'] = $model->getPermohonanWithPenduduk(null, $id_penduduk);
        return view('permohonan/riwayat', $data);
    }

    public function arsip()
    {
        $model = new PermohonanModel();
        $data['permohonan'] = $model->getPermohonanWithPenduduk('disahkan_lurah');
        return view('permohonan/arsip', $data);
    }

    public function tambah()
    {
        return view('permohonan/tambah');
    }

    public function simpan()
    {
        $model = new PermohonanModel();
        $id_penduduk = session()->get('id_penduduk');

        // Logic: jenis_permohonan form input saved to 'keterangan' column DB
        $data = [
            'id_penduduk' => $id_penduduk,
            'keterangan' => $this->request->getVar('jenis_permohonan'), // MAPPING HERE
            'tanggal_permohonan' => date('Y-m-d'),
            'status' => 'menunggu_staff'
        ];

        $model->insert($data);

        return redirect()->to(base_url('/pelayanan/riwayat'))->with('success', 'Permohonan berhasil dikirim.');
    }
}
