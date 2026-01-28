<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('admin/user/index', $data);
    }

    public function add()
    {
        return view('admin/user/add');
    }

    public function save()
    {
        $model = new UserModel();

        $role_name = $this->request->getVar('role');
        $id_role = 0;

        // Mapping simple role names to IDs based on roles table
        $roles_map = [
            'admin' => 1,
            'penduduk' => 2,
            'jagabaya' => 3,
            'ulu-ulu' => 4,
            'lurah' => 5
        ];

        if (isset($roles_map[$role_name])) {
            $id_role = $roles_map[$role_name];
        }

        $data = [
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'email' => $this->request->getVar('email'),
            'role' => $role_name,
            'id_role' => $id_role,
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
        ];

        $model->insert($data);

        return redirect()->to(base_url('admin/user'))->with('success', 'User berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $model = new UserModel();
        if ($id == session()->get('id_user')) {
            return redirect()->to(base_url('admin/user'))->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }
        $model->delete($id);
        return redirect()->to(base_url('admin/user'))->with('success', 'User berhasil dihapus.');
    }
}
