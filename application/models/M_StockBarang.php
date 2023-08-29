<?php

class M_StockBarang extends CI_Model
{

    // Menampilkan Data Stock Barang
    public function StockBarang()
    {
        $query   = $this->db->query("SELECT data_stockbarang.id_stockBarang, data_stockbarang.id_barang, data_stockbarang.jumlah_stockBarang, data_stockbarang.jumlah_stockMutasi, 
            data_stockbarang.jumlah_stockRusak, data_stockbarang.tanggal_restock, data_stockbarang.tanggal_mutasi, data_namabarang.nama_barang

            FROM data_stockbarang
            
            LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
            
            ORDER BY data_namabarang.nama_barang DESC");

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

    // Check data aktivasi
    public function CheckStocBarang($id_stockBarang)
    {
        $this->db->select('data_stockbarang.id_stockBarang, data_stockbarang.id_barang, data_stockbarang.jumlah_stockBarang, data_stockbarang.jumlah_stockMutasi, 
                        data_stockbarang.jumlah_stockRusak, data_stockbarang.tanggal_restock, data_stockbarang.tanggal_mutasi, data_namabarang.nama_barang');
        $this->db->join('data_namabarang', 'data_stockbarang.id_barang = data_namabarang.id_barang', 'left');
        $this->db->where('data_stockbarang.id_stockBarang', $id_stockBarang);

        $this->db->limit(1);
        $result = $this->db->get('data_stockbarang');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}
