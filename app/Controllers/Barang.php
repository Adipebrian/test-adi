<?php

namespace App\Controllers;

use Config\Database;
use App\Controllers\BaseController;

class Barang extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function index()
    {
        $this->builder = $this->db->table('m_barang');
        $this->builder->select('*');
        $result = $this->builder->get()->getResult();

        $data = [
            'result' => $result,
            'uri' => $this->uri
        ];
        return view('barang/index', $data);
    }
    public function store()
    {
        $nama = $this->mRequest->getVar('nama');
        $kode = $this->mRequest->getVar('kode');
        $harga = $this->mRequest->getVar('harga');

        $data = [
            'nama' => $nama,
            'kode' => $kode,
            'harga' => $harga,
            'created_at' => $this->time,
        ];
        $this->builder = $this->db->table('m_barang');
        $this->builder->select('*');
        $this->builder->insert($data);

        session()->setFlashdata('berhasil', 'Add Barang Success!');
        return redirect()->to('barang');
    }
    public function update()
    {
        $id = $this->mRequest->getVar('id');
        $nama = $this->mRequest->getVar('nama');
        $kode = $this->mRequest->getVar('kode');
        $harga = $this->mRequest->getVar('harga');

        $data = [
            'nama' => $nama,
            'kode' => $kode,
            'harga' => $harga,
            'updated_at' => $this->time,
        ];
        $this->builder = $this->db->table('m_barang');
        $this->builder->select('*');
        $this->builder->where('id', $id);
        $this->builder->update($data);

        session()->setFlashdata('berhasil', 'Update Barang Success!');
        return redirect()->to('barang');
    }
    public function delete()
    {
        $id = $this->mRequest->getVar('id');

        $this->builder = $this->db->table('m_barang');
        $this->builder->select('*');
        $this->builder->where('id', $id);
        $this->builder->delete();

        session()->setFlashdata('berhasil', 'Delete Barang Success!');
        return redirect()->to('barang');
    }
}
