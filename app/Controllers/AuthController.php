<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/dashboard'));
        }
        return view('auth/login');
    }

    public function login()
    {
        $session = session();
        $model = new LoginModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $model->getLoginData($username);

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);

            if ($authenticatePassword) {
                $ses_data = [
                    'id_login' => $data['id_login'],
                    'id_user' => $data['id_user'] ?? null,
                    'username' => $data['username'],
                    'nama_lengkap' => $data['nama_lengkap'], // From User/Penduduk
                    'role_name' => $data['role_name'], // From User(Roles)/Penduduk
                    'id_penduduk' => $data['id_penduduk'] ?? null,
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to(base_url('/dashboard'));
            } else {
                $session->setFlashdata('msg', 'Password salah.');
                return redirect()->to(base_url('/login'));
            }
        } else {
            $session->setFlashdata('msg', 'Username tidak ditemukan.');
            return redirect()->to(base_url('/login'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/login'));
    }
}
