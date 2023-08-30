<?php

class M_Kelurahan extends CI_Model
{
    // Menampilkan Data Kelurahan
    public function DataKelurahan()
    {
        $query   = $this->db->query("SELECT id_kelurahan, nama_kelurahan, id_kecamatan FROM data_kelurahan ORDER BY nama_kelurahan ASC ");

        return $query->result_array();
    }

    public function ListKelurahan($id_kecamatan)
    {
        $query   = $this->db->query("SELECT id_kelurahan, nama_kelurahan, id_kecamatan FROM data_kelurahan WHERE id_kecamatan = '$id_kecamatan' ");

        return $query->result_array();
    }
}
