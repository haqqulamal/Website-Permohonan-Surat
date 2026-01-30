<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LoginModel;
use App\Models\PendudukModel; // Added this line

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $pendudukModel = new \App\Models\PendudukModel(); // Added this line

        // Join with login table to get username which is now in a separate table
        $data['users'] = $model->select('user.*, login.username')
            ->join('login', 'login.id_user = user.id_user', 'left')
            ->findAll();

        // OR better: use LoginModel to get all Accounts (which is usually what admin manages)
        // $loginModel = new LoginModel();
        // $data['users'] = $loginModel->select('login.username, user.*')->join('user', 'login.id_user = user.id_user')->findAll();
        // However, the VIEW expects specific fields. Let's start by just updating the CREATE/DELETE logic.
        // The current index view probably uses 'nama_lengkap', 'email', 'role'. 'username' might be missing if we just use UserModel.

        // Get Penduduk list for the dropdown in Modal
        $data['list_penduduk'] = $pendudukModel->findAll(); // Added this line

        return view('admin/user/index', $data);
    }

    public function add()
    {
        return view('admin/user/add');
    }

    public function save()
    {
        $userModel = new UserModel();
        $loginModel = new LoginModel();

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

        // 1. Insert Profile into User Table
        $userData = [
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'email' => $this->request->getVar('email'),
            'role' => $role_name,
            'id_role' => $id_role,
        ];

        $userModel->insert($userData);
        $id_user = $userModel->getInsertID();

        // Handle id_penduduk if role is penduduk
        $id_penduduk = $this->request->getVar('id_penduduk');
        if (empty($id_penduduk)) {
            $id_penduduk = null;
        }

        // 2. Insert Credentials into Login Table
        $loginData = [
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'id_user' => $id_user,
            'id_penduduk' => $id_penduduk // Save the link
        ];

        $loginModel->insert($loginData);

        return redirect()->to(base_url('admin/user'))->with('success', 'User berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $loginModel = new LoginModel();

        if ($id == session()->get('id_user')) {
            return redirect()->to(base_url('admin/user'))->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        // Delete Login data first (FK constraint usually, but here we deleting user)
        // Check if there is a FK constraint in DB. If yes, delete Login first.
        $loginModel->where('id_user', $id)->delete();
        $userModel->delete($id);

        return redirect()->to(base_url('admin/user'))->with('success', 'User berhasil dihapus.');
    }
}
