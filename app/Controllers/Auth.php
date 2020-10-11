<?php

namespace App\Controllers;

use App\Models\Model_auth;

class Auth extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->Model_auth = new Model_auth();
    }

    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('v_login', $data);
    }

    public function login()
    {
        if ($this->validate([
            'email' => [
                'label'  => 'E-Mail',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'min_length' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            // Jika valid
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $cek = $this->Model_auth->login($email, $password);
            if ($cek) {
                // jika data cocok
                session()->set('log', true);
                session()->set('nama_user', $cek['nama_user']);
                session()->set('email', $cek['email']);
                session()->set('level', $cek['level']);
                session()->set('foto', $cek['foto']);
                session()->set('id_dep', $cek['id_dep']);
                session()->set('id_user', $cek['id_user']);
                return redirect()->to(base_url('home'));
            } else {
                session()->setFlashdata('pesan', 'Login gagal, Username atau password salah!!!');
                return redirect()->to(base_url('auth/index'));
            }
        } else {
            // jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/index'));
        }
    }

    public function logout()
    {
        session()->remove('log');
        session()->remove('name_user');
        session()->remove('email');
        session()->remove('level');
        session()->remove('foto');
        session()->remove('id_dep');

        session()->setFlashdata('pesan', 'Anda berhasil keluar!!!');
        return redirect()->to(base_url('auth'));
    }
}
