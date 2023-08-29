<?php

class M_Kecamatan extends CI_Model
{
    // Menampilkan Data Customer
    public function DataCustomer()
    {
        $query   = $this->db->query("SELECT data_customer.id_customer, data_customer.pembelian_paket, data_customer.nama_customer, data_customer.nik_customer, data_customer.alamat_customer, data_customer.tlp_customer, data_customer.date, data_customer.kode_barang, data_customer.kode_barang_stb

        FROM data_customer
             LEFT JOIN data_paket ON data_customer.pembelian_paket = data_paket.id_paket
             ");

        return $query->result_array();
    }
    //Edit Data Customer
    public function EditCustomer($id_customer)
    {
        $query   = $this->db->query("SELECT data_customer.id_customer, data_customer.pembelian_paket, data_customer.nama_customer, data_customer.nik_customer, data_customer.alamat_customer, data_customer.tlp_customer, data_customer.date, data_customer.kode_barang, data_customer.kode_barang_stb
    FROM data_customer
    WHERE id_customer = '$id_customer'
    ");

        return $query->result_array();
    }

    // Hapus Data Custmer
    public function DeleteCustomer($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);

        return ($this->db->affected_rows() > 0) ? true : false;
    }
}
