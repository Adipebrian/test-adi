<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DatabaseMigrate extends Migration
{
    public function up()
    {
        // m_barang
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true,],
            'kode'             => ['type' => 'VARCHAR', 'constraint' => '10'],
            'nama'             => ['type' => 'VARCHAR', 'constraint' => '100'],
            'harga'            => ['type' => 'DECIMAL'],
            'created_at'       => ['type' => 'datetime'],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('m_barang');

        // m_customer
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true,],
            'kode'             => ['type' => 'VARCHAR', 'constraint' => '10'],
            'nama'             => ['type' => 'VARCHAR', 'constraint' => '100'],
            'telp'             => ['type' => 'VARCHAR', 'constraint' => '20'],
            'created_at'       => ['type' => 'datetime'],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('m_customer');

        // t_sales
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true,],
            'kode'             => ['type' => 'VARCHAR', 'constraint' => '15'],
            'tgl'              => ['type' => 'datetime'],
            'cust_id'          => ['type' => 'INT'],
            'subtotal'         => ['type' => 'DECIMAL'],
            'diskon'           => ['type' => 'DECIMAL'],
            'ongkir'           => ['type' => 'DECIMAL'],
            'total_bayar'      => ['type' => 'DECIMAL'],
            'status'           => ['type' => 'INT', 'constraint' => '15'],
            'total_barang'     => ['type' => 'INT', 'constraint' => '255'],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('t_sales');

        // t_sales_det
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'sales_id'         => ['type' => 'INT'],
            'barang_id'        => ['type' => 'INT'],
            'harga_bandrol'    => ['type' => 'DECIMAL'],
            'qty'              => ['type' => 'INT'],
            'diskon_pct'       => ['type' => 'DECIMAL'],
            'diskon_nilai'     => ['type' => 'DECIMAL'],
            'harga_diskon'     => ['type' => 'DECIMAL'],
            'total'            => ['type' => 'DECIMAL'],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('t_sales_det');
    }

    public function down()
    {
        $this->forge->dropTable('m_barang', true);
        $this->forge->dropTable('m_customer', true);
        $this->forge->dropTable('t_sales', true);
        $this->forge->dropTable('t_sales_det', true);
    }
}
