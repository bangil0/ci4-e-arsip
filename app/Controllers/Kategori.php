<?php

namespace App\Controllers;

use App\Models\Model_kategori;

class Kategori extends BaseController
{
    public function __construct()
    {
        $this->kategori = new Model_kategori();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Kategori',
            'kategori' => $this->kategori->all_data()
        ];
        return view('v_kategori', $data);
    }

    public function tambah()
    {
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ];
        $this->kategori->tambah($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');
        return redirect()->to(base_url('kategori'));
    }

    public function edit($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori,
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ];
        $this->kategori->edit($data);
        session()->setFlashdata('pesan', 'Data berhasil diupdate!');
        return redirect()->to(base_url('kategori'));
    }

    public function delete($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori,
        ];
        $this->kategori->hapus($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to(base_url('kategori'));
    }
}
