<?php

class M_DataPeralatan extends CI_Model
{
    // Menampilkan Data Peralatan
    public function DataPeralatan()
    {
        $query   = $this->db->query("SELECT id_peralatan, kategori_peralatan FROM data_peralatan ORDER BY kategori_peralatan ASC");

        return $query->result_array();
    }

    //Edit Data Peralatan
    public function EditPeralatan($id_peralatan)
    {
        $query   = $this->db->query("SELECT id_peralatan, kategori_peralatan FROM data_peralatan WHERE id_peralatan = '$id_peralatan' ");

        return $query->result_array();
    }
}
