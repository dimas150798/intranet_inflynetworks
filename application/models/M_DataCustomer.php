<?php

class M_DataCustomer extends CI_Model
{
    // Menampilkan Data Customer
    public function DataCustomer()
    {
        $query   = $this->db->query("SELECT id_customer, pembelian_paket, nama_customer, nik_customer, alamat_customer, tlp_customer, date, kode_barang, kode_barang_stb
             FROM data_customer");

        return $query->result_array();
    }
}
