<?php

class M_DataAktivasi extends CI_Model
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
    //Delete Data Pegawai
    public function DeletePegawai($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    // Edit Data Login
    public function EditLogin($id_login)
    {
        $query   = $this->db->query("SELECT data_login.id_login, data_login.email_login, data_login.password_login, 
        data_login.id_akses, data_akses.nama_akses
        FROM data_login

        LEFT JOIN data_akses ON data_login.id_akses = data_akses.id_akses

        WHERE id_login = '$id_login'
        ORDER BY data_login.id_login ASC");

        return $query->result_array();
    }

    // Check akses login
    public function CheckLogin($username_login, $password_login)
    {
        $this->db->select('nama_pegawai, username, password');
        $this->db->where('username', $username_login);
        $this->db->where('password', $password_login);

        $this->db->limit(1);
        $result = $this->db->get('data_login');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}
