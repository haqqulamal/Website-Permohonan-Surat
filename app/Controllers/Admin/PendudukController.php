<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PendudukModel;

class PendudukController extends BaseController
{
    public function index()
    {
        $model = new PendudukModel();
        $data['penduduk'] = $model->findAll();
        return view('admin/penduduk/index', $data);
    }

    public function add()
    {
        return view('admin/penduduk/add');
    }

    public function save()
    {
        $model = new PendudukModel();

        $data = [
            'nik' => $this->request->getVar('nik'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp'),
            'email' => $this->request->getVar('email'),
        ];

        $model->insert($data);

        return redirect()->to(base_url('admin/penduduk'))->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $model = new PendudukModel();
        $data['penduduk'] = $model->find($id);

        if (!$data['penduduk']) {
            return redirect()->to(base_url('admin/penduduk'))->with('error', 'Data tidak ditemukan.');
        }

        return view('admin/penduduk/edit', $data);
    }

    public function update()
    {
        $model = new PendudukModel();
        $id = $this->request->getVar('id_penduduk');

        $data = [
            'nik' => $this->request->getVar('nik'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp'),
            'email' => $this->request->getVar('email'),
        ];

        $model->update($id, $data);

        return redirect()->to(base_url('admin/penduduk'))->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new PendudukModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/penduduk'))->with('success', 'Data penduduk berhasil dihapus.');
    }
}
