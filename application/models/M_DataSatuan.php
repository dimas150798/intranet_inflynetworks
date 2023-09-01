<?php

class M_DataSatuan extends CI_Model
{
    // Menampilkan Data Satuan
    public function DataSatuan()
    {
        $query   = $this->db->query("SELECT id_satuan, nama_satuan FROM data_satuan ORDER BY nama_satuan ASC");

        return $query->result_array();
    }

    //Edit Data Satuan
    public function EditSatuan($id_satuan)
    {
        $query   = $this->db->query("SELECT id_satuan, nama_satuan FROM data_satuan WHERE id_satuan = '$id_satuan' ");

        return $query->result_array();
    }
}
