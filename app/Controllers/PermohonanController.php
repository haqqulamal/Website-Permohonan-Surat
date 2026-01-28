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
        $model = new PermohonanModel();
        $id_surat = $this->request->getVar('id_surat');
        $status_persetujuan = $this->request->getVar('status_persetujuan');
        $catatan = $this->request->getVar('catatan');

        $final_status = ($status_persetujuan == 'disetujui') ? 'disetujui_staff' : 'ditolak_staff';

        $model->update($id_surat, [
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
        $model = new PermohonanModel();
        $id_surat = $this->request->getVar('id_surat');
        $status_pengesahan = $this->request->getVar('status_pengesahan');
        $catatan = $this->request->getVar('catatan');

        $final_status = ($status_pengesahan == 'Sahkan') ? 'disahkan_lurah' : 'ditolak_lurah';

        $model->update($id_surat, [
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
        // Fetch all disahkan permohonan for everyone (filtered by controller if needed, but usually visible to all users to see public letters)
        // For security, penduduk should only see their own even in arsip? No, arsip usually implies "Letters that have been issued".
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

        $data = [
            'id_penduduk' => $id_penduduk,
            'jenis_permohonan' => $this->request->getVar('jenis_permohonan'),
            'keterangan' => $this->request->getVar('keterangan'),
            'tanggal_permohonan' => date('Y-m-d'),
            'status' => 'menunggu_staff'
        ];

        $model->insert($data);

        return redirect()->to(base_url('/pelayanan/riwayat'))->with('success', 'Permohonan berhasil dikirim.');
    }
}
