<?php

namespace App\Controllers;

use Config\Database;
use App\Controllers\BaseController;

class Data extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function index()
    {
        $this->builder = $this->db->table('t_sales');
        $this->builder->select('t_sales.kode as kodesales,tgl,nama,total_barang,subtotal,total_bayar,ongkir,diskon');
        $this->builder->join('m_customer', 'm_customer.id = t_sales.cust_id');
        $this->builder->where('status', 1);
        $result = $this->builder->get()->getResult();

        $data = [
            'result' => $result,
            'uri' => $this->uri
        ];
        return view('data/index', $data);
    }
    public function add_post()
    {
        $this->builder = $this->db->table('t_sales');
        $this->builder->select('*');
        $this->builder->groupBy('kode', 'DESC');
        $result = $this->builder->get()->getRow();
        if ($result) {
            $kode = $result->kode + 1;
        } else {
            $kode = 2021010001;
        }

        $data = [
            'kode' => $kode,
            'tgl' => '',
            'cust_id' => '',
            'subtotal' => '',
            'diskon' => '',
            'ongkir' => '',
            'total_bayar' => '',
            'status' => 0,
            'total_barang' => 0,
        ];
        $this->builder = $this->db->table('t_sales');
        $this->builder->select('*');
        $this->builder->insert($data);
        return redirect()->to('data/add_sales/' . $kode);
    }
    public function delete_sales()
    {
        $id = $this->mRequest->getVar('id');

        $this->builder = $this->db->table('t_sales');
        $this->builder->select('*');
        $this->builder->where('id', $id);
        $this->builder->delete();

        session()->setFlashdata('berhasil', 'Delete Barang Success!');
        return redirect()->to('/data/add');
    }
    public function add_sales($kode)
    {
        $this->builder = $this->db->table('m_barang');
        $this->builder->select('*');
        $barang = $this->builder->get()->getResult();

        $this->builder = $this->db->table('m_customer');
        $this->builder->select('*');
        $customer = $this->builder->get()->getResult();


        $this->builder = $this->db->table('t_sales');
        $this->builder->select('*');
        $this->builder->where('kode', $kode);
        $sales = $this->builder->get()->getRow();

        $this->builder = $this->db->table('m_customer');
        $this->builder->select('*');
        $this->builder->where('id', $sales->cust_id);
        $customer_data = $this->builder->get()->getRow();

        $this->builder = $this->db->table('t_sales_det');
        $this->builder->select('*');
        $this->builder->join('t_sales', 't_sales.id = t_sales_det.sales_id');
        $this->builder->join('m_barang', 'm_barang.id = t_sales_det.barang_id');
        $this->builder->where('t_sales.id', $sales->id);
        $result = $this->builder->get()->getResult();

        $this->builder = $this->db->table('t_sales_det');
        $this->builder->select('*');
        $this->builder->where('sales_id', $sales->id);
        $total_barang = $this->builder->countAllResults();

        $data = [
            'customer_data' => $customer_data,
            'sales' => $sales,
            'total_barang' => $total_barang,
            'customer' => $customer,
            'barang' => $barang,
            'result' => $result,
            'uri' => $this->uri,
            'time' => $this->time
        ];
        return view('data/store', $data);
    }
    public function add_cust()
    {
        $id = $this->mRequest->getVar('cust_id');
        $kode = $this->mRequest->getVar('kode');
        $data = [
            'cust_id' => $id
        ];
        $this->builder = $this->db->table('t_sales');
        $this->builder->select('*');
        $this->builder->where('kode', $kode);
        $this->builder->update($data);

        session()->setFlashdata('berhasil', 'Add Customer Success!');
        return redirect()->to('data/add_sales/' . $kode);
    }
    public function add_diskon()
    {
        $diskon = $this->mRequest->getVar('diskon');
        $kode = $this->mRequest->getVar('kode');
        $data = [
            'diskon' => $diskon
        ];
        $this->builder = $this->db->table('t_sales');
        $this->builder->select('*');
        $this->builder->where('kode', $kode);
        $this->builder->update($data);

        session()->setFlashdata('berhasil', 'Add Diskon Success!');
        return redirect()->to('data/add_sales/' . $kode);
    }
    public function add_ongkir()
    {
        $ongkir = $this->mRequest->getVar('ongkir');
        $kode = $this->mRequest->getVar('kode');
        $data = [
            'ongkir' => $ongkir
        ];
        $this->builder = $this->db->table('t_sales');
        $this->builder->select('*');
        $this->builder->where('kode', $kode);
        $this->builder->update($data);

        session()->setFlashdata('berhasil', 'Add Ongkir Success!');
        return redirect()->to('data/add_sales/' . $kode);
    }
    public function add()
    {
        $this->builder = $this->db->table('m_barang');
        $this->builder->select('*');
        $barang = $this->builder->get()->getResult();

        $this->builder = $this->db->table('t_sales');
        $this->builder->select('*');
        $this->builder->where('status', 0);
        $result = $this->builder->get()->getResult();

        $data = [
            'result' => $result,
            'uri' => $this->uri
        ];
        return view('data/add', $data);
    }
    public function barang_store()
    {
        $kode_sales = $this->mRequest->getVar('kode_sales');
        $sales_id = $this->mRequest->getVar('sales_id');
        $barang_id = $this->mRequest->getVar('barang_id');
        $qty = $this->mRequest->getVar('qty');
        $diskon_pct = $this->mRequest->getVar('diskon_pct');


        $this->builder = $this->db->table('m_barang');
        $this->builder->select('*');
        $this->builder->where('id', $barang_id);
        $barang = $this->builder->get()->getRow();
        $harga_bandrol = $barang->harga;

        $diskon_nilai = ($harga_bandrol * $diskon_pct) / 100;
        $harga_diskon = $harga_bandrol - $diskon_nilai;

        $total = $harga_diskon * $qty;

        $data = [
            'sales_id' => $sales_id,
            'barang_id' => $barang_id,
            'harga_bandrol' => $harga_bandrol,
            'qty' => $qty,
            'diskon_pct' => $diskon_pct,
            'diskon_nilai' => $diskon_nilai,
            'harga_diskon' => $harga_diskon,
            'total' => $total,
        ];
        $this->builder = $this->db->table('t_sales_det');
        $this->builder->select('*');
        $this->builder->insert($data);

        session()->setFlashdata('berhasil', 'Add Barang Success!');
        return redirect()->to('data/add_sales/' . $kode_sales);
    }
    public function barang_update()
    {
        $id = $this->mRequest->getVar('id');
        $kode_sales = $this->mRequest->getVar('kode_sales');
        $sales_id = $this->mRequest->getVar('sales_id');
        $barang_id = $this->mRequest->getVar('barang_id');
        $qty = $this->mRequest->getVar('qty');
        $diskon_pct = $this->mRequest->getVar('diskon_pct');


        $this->builder = $this->db->table('m_barang');
        $this->builder->select('*');
        $this->builder->where('id', $barang_id);
        $barang = $this->builder->get()->getRow();
        $harga_bandrol = $barang->harga;

        $diskon_nilai = ($harga_bandrol * $diskon_pct) / 100;
        $harga_diskon = $harga_bandrol - $diskon_nilai;

        $total = $harga_diskon * $qty;

        $data = [
            'sales_id' => $sales_id,
            'barang_id' => $barang_id,
            'harga_bandrol' => $harga_bandrol,
            'qty' => $qty,
            'diskon_pct' => $diskon_pct,
            'diskon_nilai' => $diskon_nilai,
            'harga_diskon' => $harga_diskon,
            'total' => $total,
        ];
        $this->builder = $this->db->table('t_sales_det');
        $this->builder->select('*');
        $this->builder->where('id', $id);
        $this->builder->update($data);

        session()->setFlashdata('berhasil', 'Update Barang Success!');
        return redirect()->to('data/add_sales/' . $kode_sales);
    }
    public function update()
    {
        $kode_sales = $this->mRequest->getVar('no_kode_sales');
        $cust_id = $this->mRequest->getVar('cust_id');
        $tgl = $this->mRequest->getVar('tgl');
        $subtotal = $this->mRequest->getVar('subtotal');
        $total_bayar = $this->mRequest->getVar('total_bayar');
        $total_barang = $this->mRequest->getVar('total_barang');
        if ($cust_id) {
            if ($tgl) {
                $data = [
                    'tgl' => $tgl,
                    'total_bayar' => $total_bayar,
                    'subtotal' => $subtotal,
                    'status' => 1,
                    'total_barang' => $total_barang,
                ];
                $this->builder = $this->db->table('t_sales');
                $this->builder->select('*');
                $this->builder->where('kode', $kode_sales);
                $this->builder->update($data);

                session()->setFlashdata('berhasil', 'Add Data Transaksi Success!');
                return redirect()->to('data/add');
            } else {
                session()->setFlashdata('gagal', 'Isi tanggal terlebih dahulu!');
                return redirect()->to('data/add_sales/' . $kode_sales);
            }
        } else {
            session()->setFlashdata('gagal', 'Update Customer terlebih dahulu!');
            return redirect()->to('data/add_sales/' . $kode_sales);
        }
    }
}
