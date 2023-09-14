<?php

class M_DataStatus extends CI_Model
{
    // Menampilkan Data Status
    public function DataStatusOrder()
    {
        $query   = $this->db->query("SELECT id_status, nama_status FROM data_status 
        WHERE id_status = 18 OR id_status = 19 ORDER BY nama_status ASC");

        return $query->result_array();
    }

    //Edit Data Satuan
    public function EditSatuan($id_satuan)
    {
        $query   = $this->db->query("SELECT id_satuan, nama_satuan FROM data_satuan WHERE id_satuan = '$id_satuan' ");

        return $query->result_array();
    }
}
