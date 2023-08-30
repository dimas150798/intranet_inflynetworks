<?php

class M_Kota extends CI_Model
{
    // Menampilkan Data Kota
    public function DataKota()
    {
        $query   = $this->db->query("SELECT id_kota, nama_kota FROM data_kota ORDER BY nama_kota ASC ");

        return $query->result_array();
    }
}
