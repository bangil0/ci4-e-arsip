<?php

namespace App\Controllers;

use App\Models\Model_dep;

class Dep extends BaseController
{
    public function __construct()
    {
        $this->dep = new Model_dep();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Departemen',
            'dep' => $this->dep->all_data()
        ];
        return view('v_dep', $data);
    }

    public function tambah()
    {
        $data = [
            'nama_dep' => $this->request->getPost('nama_dep')
        ];
        $this->dep->tambah($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');
        return redirect()->to(base_url('dep'));
    }

    public function edit($id_dep)
    {
        $data = [
            'id_dep' => $id_dep,
            'nama_dep' => $this->request->getPost('nama_dep')
        ];
        $this->dep->edit($data);
        session()->setFlashdata('pesan', 'Data berhasil diupdate!');
        return redirect()->to(base_url('dep'));
    }

    public function delete($id_dep)
    {
        $data = [
            'id_dep' => $id_dep,
        ];
        $this->dep->hapus($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to(base_url('dep'));
    }
}
