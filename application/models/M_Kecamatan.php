<?php

class M_Kecamatan extends CI_Model
{
    // Menampilkan Data Kecamatan
    public function DataKecamatan()
    {
        $query   = $this->db->query("SELECT id_kecamatan, nama_kecamatan, id_kota FROM data_kecamatan ORDER BY nama_kecamatan ASC ");

        return $query->result_array();
    }

    public function ListKecamatan($id_kota)
    {
        $query   = $this->db->query("SELECT id_kecamatan, nama_kecamatan, id_kota FROM data_kecamatan WHERE id_kota = '$id_kota' ");

        return $query->result_array();
    }
}
