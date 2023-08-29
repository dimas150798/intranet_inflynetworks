<?php

class M_DataAktivasi extends CI_Model
{

    // Menampilkan Data Aktivasi
    public function DataAktivasi()
    {
        $query   = $this->db->query("SELECT data_aktivasi.id_aktivasi, data_aktivasi.kode_barang, data_aktivasi.id_stockBarang, data_aktivasi.jumlah_modem,
            data_aktivasi.Patch_Core_Hitam_UPC_Outdor, data_aktivasi.Patch_Core_Kuning_UPC_Biru, data_aktivasi.Patch_Core_Kuning_APC_Hijau, data_aktivasi.Adaptor, data_aktivasi.tanggal,
            data_customer.nama_customer, data_stockbarang.id_barang, data_namabarang.nama_barang, data_status.nama_status

            FROM data_aktivasi
            
            LEFT JOIN data_customer ON data_aktivasi.id_customer = data_customer.id_customer
            LEFT JOIN data_stockbarang ON data_aktivasi.id_stockBarang = data_stockbarang.id_stockBarang
            LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
            LEFT JOIN data_status ON data_aktivasi.id_status = data_status.id_status
            
            ORDER BY data_aktivasi.id_aktivasi DESC");

        return $query->result_array();
    }

    //Edit Data Aktivasi
    public function EditAktivasi($id_aktivasi)
    {
        $query   = $this->db->query("SELECT id_aktivasi, kode_barang, id_stockBarang, jumlah_modem, Patch_Core_Hitam_UPC_Outdor, Patch_Core_Kuning_UPC_Biru,
            Patch_Core_Kuning_APC_Hijau, Adaptor, tanggal, id_status, id_pegawai, id_customer, id_keadaanbarang

        FROM data_aktivasi
        WHERE id_aktivasi = '$id_aktivasi'
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
    public function CheckAktivasi($id_aktivasi)
    {
        $this->db->select('data_aktivasi.id_aktivasi, data_aktivasi.kode_barang, data_aktivasi.id_stockBarang, data_aktivasi.jumlah_modem,
                            data_aktivasi.Patch_Core_Hitam_UPC_Outdor, data_aktivasi.Patch_Core_Kuning_UPC_Biru, data_aktivasi.Patch_Core_Kuning_APC_Hijau, data_aktivasi.Adaptor, 
                            data_aktivasi.tanggal, data_aktivasi.id_status, data_customer.nama_customer, data_stockbarang.id_barang, data_namabarang.nama_barang');
        $this->db->join('data_customer', 'data_aktivasi.id_customer = data_customer.id_customer', 'left');
        $this->db->join('data_stockbarang', 'data_aktivasi.id_stockBarang = data_stockbarang.id_stockBarang', 'left');
        $this->db->join('data_namabarang', 'data_stockbarang.id_barang = data_namabarang.id_barang', 'left');
        $this->db->where('data_aktivasi.id_aktivasi', $id_aktivasi);

        $this->db->limit(1);
        $result = $this->db->get('data_aktivasi');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}
