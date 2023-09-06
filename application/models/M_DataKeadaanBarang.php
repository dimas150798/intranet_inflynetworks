<?php

class M_DataKeadaanBarang extends CI_Model
{
    // Menampilkan Data Keadaan Barang
    public function DataKeadaanBarang()
    {
        $query   = $this->db->query("SELECT id_keadaanbarang, nama_keadaan FROM data_keadaanbarang ORDER BY nama_keadaan ASC");

        return $query->result_array();
    }

    //Edit Data Satuan
    public function EditKeadaanBarang($id_keadaanbarang)
    {
        $query   = $this->db->query("SELECT id_keadaanbarang, nama_keadaan FROM data_keadaanbarang WHERE id_keadaanbarang = '$id_keadaanbarang' ");

        return $query->result_array();
    }
}
