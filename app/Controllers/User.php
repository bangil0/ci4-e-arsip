<?php

namespace App\Controllers;

use App\Models\Model_dep;
use App\Models\Model_user;
use Config\Services;

class User extends BaseController
{
    public function __construct()
    {
        $this->Model_user = new Model_user();
        $this->Model_dep = new Model_dep();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'user' => $this->Model_user->all_data()
        ];
        return view('user/v_index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'User',
            'dep' => $this->Model_dep->all_data()
        ];
        return view('user/v_add', $data);
    }

    public function tambah()
    {
        if ($this->validate([
            'nama_user' => [
                'label'  => 'Nama User',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'email' => [
                'label'  => 'Email',
                'rules'  => 'required|is_unique[tbl_user.email]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} sudah ada!'
                ]
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'level' => [
                'label'  => 'Level',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'id_dep' => [
                'label'  => 'Departemen',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'foto' => [
                'label'  => 'Foto',
                'rules'  => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/jpeg,image/gif,]',
                'errors' => [
                    'uploaded' => '{field} wajib diisi!',
                    'max_size' => '{field} max 1024 KB!',
                    'mime_in' => '{field} format tidak valid!',
                ]
            ],
        ])) {
            // MENGAMBIL FILE FOTO YG DIUPLOAD
            $foto = $this->request->getFile('foto');
            //RANDOM NAME FOTO
            $nama_file = $foto->getRandomName();
            //JIKA VALID
            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'level' => $this->request->getPost('level'),
                'id_dep' => $this->request->getPost('id_dep'),
                'foto' => $nama_file
            ];

            $foto->move('foto', $nama_file); //DIRECTORY UPLOAD FILE
            $this->Model_user->tambah($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambah!');
            return redirect()->to(base_url('user'));
        } else {
            //TIDAL VALID
            session()->setFlashdata('errors', Services::validation()->getErrors());
            return redirect()->to(base_url('user/add'));
        }
    }

    public function edit($id_user)
    {
        $data = [
            'title' => 'User',
            'dep' => $this->Model_dep->all_data(),
            'user' => $this->Model_user->detail($id_user)
        ];
        return view('user/v_edit', $data);
    }

    public function update($id_user)
    {
        if ($this->validate([
            'nama_user' => [
                'label'  => 'Nama User',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'level' => [
                'label'  => 'Level',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'id_dep' => [
                'label'  => 'Departemen',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'foto' => [
                'label'  => 'Foto',
                'rules'  => 'max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/jpeg,image/gif,]',
                'errors' => [
                    'max_size' => '{field} max 1024 KB!',
                    'mime_in' => '{field} format tidak valid!',
                ]
            ],
        ])) {
            // MENGAMBIL FILE FOTO YG DIUPLOAD
            $foto = $this->request->getFile('foto');
            // RANDOM NAME FOTO
            $nama_file = $foto->getRandomName();
            if ($foto->getError() == 4) {
                //JIKA TIDAK ADA FOTO
                $data = [
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'password' => $this->request->getPost('password'),
                    'level' => $this->request->getPost('level'),
                    'id_dep' => $this->request->getPost('id_dep'),
                    // 'foto' => $nama_file
                ];
                $this->Model_user->edit($data);
            } else {
                //MENGHAPUS FOTO LAMA
                $user = $this->Model_user->detail($id_user);
                if ($user['foto'] != "") {
                    unlink('foto/' . $user['foto']);
                }
                //JIKA TIDAK ADA FOTO
                $data = [
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'password' => $this->request->getPost('password'),
                    'level' => $this->request->getPost('level'),
                    'id_dep' => $this->request->getPost('id_dep'),
                    'foto' => $nama_file
                ];
                $foto->move('foto', $nama_file); //DIRECTORY UPLOAD FILE
                $this->Model_user->edit($data);
            }
            session()->setFlashdata('pesan', 'Data berhasil diupdate!');
            return redirect()->to(base_url('user'));
        } else {
            //TIDAL VALID
            session()->setFlashdata('errors', Services::validation()->getErrors());
            return redirect()->to(base_url('user/edit/' . $id_user));
        }
    }

    public function delete($id_user)
    {
        //MENGHAPUS FOTO JUGA
        $user = $this->Model_user->detail($id_user);
        if ($user['foto'] != "") {
            unlink('foto/' . $user['foto']);
        }
        $data = [
            'id_user' => $id_user,
        ];
        $this->Model_user->hapus($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to(base_url('user'));
    }

    //--------------------------------------------------------------------

}
