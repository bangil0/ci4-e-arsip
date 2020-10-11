<?php

namespace App\Controllers;

use App\Models\Model_arsip;
use App\Models\Model_kategori;
use Config\Services;

class Arsip extends BaseController
{

    public function __construct()
    {
        $this->Model_arsip = new Model_arsip();
        $this->Model_kategori = new Model_kategori();
        helper(['form', 'text']);
    }

    public function index()
    {

        $data = [
            'title' => 'Arsip',
            'arsip' => $this->Model_arsip->all_data()
        ];
        return view('arsip/v_index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Arsip',
            'kategori' => $this->Model_kategori->all_data(),
            'no_arsip' => date('ymds') . '-' . random_string('alnum', 4)
        ];
        return view('arsip/v_add', $data);
    }

    public function tambah()
    {
        if ($this->validate([
            'nama_arsip' => [
                'label'  => 'Nama Arsip',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'deskripsi' => [
                'label'  => 'Deskripsi',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'id_kategori' => [
                'label'  => 'Kategori',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'file_arsip' => [
                'label'  => 'File Arsip',
                'rules'  => 'uploaded[file_arsip]|max_size[file_arsip,2048]|ext_in[file_arsip,pdf]',
                'errors' => [
                    'uploaded' => '{field} wajib diisi!',
                    'max_size' => '{field} max 2048 KB!',
                    'ext_in' => '{field} format tidak valid!',
                ]
            ],
        ])) {
            // MENGAMBIL FILE PDF YG DIUPLOAD
            $file_arsip = $this->request->getFile('file_arsip');
            //RANDOM NAME PDF
            $nama_file = $file_arsip->getRandomName();
            // MENGAMBIL UKURAN FILE
            $ukuran_file = $file_arsip->getSize('kb');
            //JIKA VALID
            $data = [
                'id_kategori' => $this->request->getPost('id_kategori'),
                'no_arsip' => $this->request->getPost('no_arsip'),
                'nama_arsip' => $this->request->getPost('nama_arsip'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'tgl_upload' => date('Y-m-d'),
                'tgl_update' => date('Y-m-d'),
                'id_dep' => session()->get('id_dep'),
                'id_user' => session()->get('id_user'),
                'file_arsip' => $nama_file,
                'ukuran_file' => $ukuran_file
            ];

            $file_arsip->move('file_arsip', $nama_file); //DIRECTORY UPLOAD FILE
            $this->Model_arsip->tambah($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambah!');
            return redirect()->to(base_url('arsip'));
        } else {
            //TIDAL VALID
            session()->setFlashdata('errors', Services::validation()->getErrors());
            return redirect()->to(base_url('arsip/add'));
        }
    }

    public function edit($id_arsip)
    {
        $data = [
            'title' => 'Arsip',
            'kategori' => $this->Model_kategori->all_data(),
            'arsip' => $this->Model_arsip->detail($id_arsip)
        ];
        return view('arsip/v_edit', $data);
    }

    public function update($id_arsip)
    {
        if ($this->validate([
            'nama_arsip' => [
                'label'  => 'Nama Arsip',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'deskripsi' => [
                'label'  => 'Deskripsi',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'id_kategori' => [
                'label'  => 'Kategori',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'file_arsip' => [
                'label'  => 'File Arsip',
                'rules'  => 'max_size[file_arsip,2048]|ext_in[file_arsip,pdf]',
                'errors' => [
                    'max_size' => '{field} max 2048 KB!',
                    'ext_in' => '{field} format tidak valid!',
                ]
            ],
        ])) {
            // MENGAMBIL FILE FOTO YG DIUPLOAD
            $file_arsip = $this->request->getFile('file_arsip');
            // RANDOM NAME FOTO
            $nama_file = $file_arsip->getRandomName();
            // MENGAMBIL UKURAN FILE
            $ukuran_file = $file_arsip->getSize('kb');
            if ($file_arsip->getError() == 4) {
                //JIKA TIDAK ADA FOTO
                $data = [
                    'id_arsip' => $id_arsip,
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'no_arsip' => $this->request->getPost('no_arsip'),
                    'nama_arsip' => $this->request->getPost('nama_arsip'),
                    'deskripsi' => $this->request->getPost('deskripsi'),
                    'tgl_update' => date('Y-m-d'),
                    'id_dep' => session()->get('id_dep'),
                    'id_user' => session()->get('id_user'),
                ];
                $this->Model_arsip->edit($data);
            } else {
                //MENGHAPUS FOTO LAMA
                $arsip = $this->Model_arsip->detail($id_arsip);
                if ($arsip['file_arsip'] != "") {
                    unlink('file_arsip/' . $arsip['file_arsip']);
                }
                //JIKA TIDAK ADA FOTO
                $data = [
                    'id_arsip' => $id_arsip,
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'no_arsip' => $this->request->getPost('no_arsip'),
                    'nama_arsip' => $this->request->getPost('nama_arsip'),
                    'deskripsi' => $this->request->getPost('deskripsi'),
                    'tgl_upload' => date('Y-m-d'),
                    'tgl_update' => date('Y-m-d'),
                    'id_dep' => session()->get('id_dep'),
                    'id_user' => session()->get('id_user'),
                    'file_arsip' => $nama_file,
                    'ukuran_file' => $ukuran_file
                ];
                $file_arsip->move('file_arsip', $nama_file); //DIRECTORY UPLOAD FILE
                $this->Model_arsip->edit($data);
            }
            session()->setFlashdata('pesan', 'Data berhasil diupdate!');
            return redirect()->to(base_url('arsip'));
        } else {
            //TIDAL VALID
            session()->setFlashdata('errors', Services::validation()->getErrors());
            return redirect()->to(base_url('arsip/edit/' . $id_arsip));
        }
    }

    public function delete($id_arsip)
    {
        //MENGHAPUS FOTO JUGA
        $arsip = $this->Model_arsip->detail($id_arsip);
        if ($arsip['file_arsip'] != "") {
            unlink('file_arsip/' . $arsip['file_arsip']);
        }
        $data = [
            'id_arsip' => $id_arsip,
        ];
        $this->Model_arsip->hapus($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to(base_url('arsip'));
    }

    public function viewpdf($id_arsip)
    {
        $data = [
            'title' => 'View Arsip',
            'arsip' => $this->Model_arsip->detail($id_arsip)
        ];
        return view('arsip/v_viewpdf', $data);
    }

    //--------------------------------------------------------------------

}
