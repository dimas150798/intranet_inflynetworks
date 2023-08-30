<?php

class M_DataPegawai extends CI_Model
{

    // Menampilkan Data Pegawai
    public function DataPegawai()
    {
        $query   = $this->db->query("SELECT id_pegawai, NIK, nama_pegawai, no_telpon, alamat_pegawai, pendidikan_pegawai, jabatan, tanggal_masuk, gaji, photo
            FROM data_pegawai");

        return $query->result_array();
    }

    //Edit Data Pegawai
    public function EditPegawai($id_pegawai)
    {
        $query   = $this->db->query("SELECT id_pegawai, NIK, nama_pegawai, no_telpon, alamat_pegawai, pendidikan_pegawai, jabatan, tanggal_masuk, gaji, photo
        FROM data_pegawai
        WHERE id_pegawai = '$id_pegawai'
        ");

        return $query->result_array();
    }

    // Check Data Pegawai
    public function CheckDataPegawai($nama_pegawai)
    {
        $this->db->select('id_pegawai, NIK, nama_pegawai, no_telpon, alamat_pegawai, pendidikan_pegawai, jabatan, tanggal_masuk, gaji, photo');
        $this->db->where('nama_pegawai', $nama_pegawai);

        $this->db->limit(1);
        $result = $this->db->get('data_pegawai');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}
