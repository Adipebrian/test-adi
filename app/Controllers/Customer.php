<?php

namespace App\Controllers;

use Config\Database;
use App\Controllers\BaseController;

class Customer extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function index()
    {
        $this->builder = $this->db->table('m_customer');
        $this->builder->select('*');
        $result = $this->builder->get()->getResult();

        $data = [
            'result' => $result,
            'uri' => $this->uri
        ];
        return view('customer/index', $data);
    }
    public function store()
    {
        $nama = $this->mRequest->getVar('nama');
        $kode = $this->mRequest->getVar('kode');
        $telp = $this->mRequest->getVar('telp');

        $data = [
            'nama' => $nama,
            'kode' => $kode,
            'telp' => $telp,
            'created_at' => $this->time,
        ];
        $this->builder = $this->db->table('m_customer');
        $this->builder->select('*');
        $this->builder->insert($data);

        session()->setFlashdata('berhasil', 'Add Customer Success!');
        return redirect()->to('customer');
    }
    public function update()
    {
        $id = $this->mRequest->getVar('id');
        $nama = $this->mRequest->getVar('nama');
        $kode = $this->mRequest->getVar('kode');
        $telp = $this->mRequest->getVar('telp');

        $data = [
            'nama' => $nama,
            'kode' => $kode,
            'telp' => $telp,
            'updated_at' => $this->time,
        ];
        $this->builder = $this->db->table('m_customer');
        $this->builder->select('*');
        $this->builder->where('id', $id);
        $this->builder->update($data);

        session()->setFlashdata('berhasil', 'Update Customer Success!');
        return redirect()->to('customer');
    }
    public function delete()
    {
        $id = $this->mRequest->getVar('id');

        $this->builder = $this->db->table('m_customer');
        $this->builder->select('*');
        $this->builder->where('id', $id);
        $this->builder->delete();

        session()->setFlashdata('berhasil', 'Delete Customer Success!');
        return redirect()->to('customer');
    }
}
