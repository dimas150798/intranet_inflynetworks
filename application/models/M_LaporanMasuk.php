<?php

class M_LaporanMasuk extends CI_Model
{

    // Menampilkan Data Laporan Masuk
    public function LaporanMasuk()
    {
        $query   = $this->db->query("SELECT data_stockmasuk.id_stockMasuk, data_stockmasuk.nama_barang, data_stockmasuk.kode_barang, data_stockmasuk.jumlah,
                    data_stockmasuk.tanggal, data_stockmasuk.id_pegawai, data_stockmasuk.id_status, data_stockmasuk.keterangan, 
                    data_pegawai.nama_pegawai
                    
                    FROM data_stockmasuk
                    
                    LEFT JOIN data_pegawai ON data_stockmasuk.id_pegawai = data_pegawai.id_pegawai
                    
                    ORDER BY data_stockmasuk.tanggal DESC");

        return $query->result_array();
    }

    // Menampilkan Data Laporan Masuk Pencarian
    public function LaporanMasukPencarian($bulan, $tahun)
    {
        $query   = $this->db->query("SELECT data_stockmasuk.id_stockMasuk, data_stockmasuk.nama_barang, data_stockmasuk.kode_barang, data_stockmasuk.jumlah,
                        data_stockmasuk.tanggal, data_stockmasuk.id_pegawai, data_stockmasuk.id_status,  data_stockmasuk.keterangan, 
                        data_pegawai.nama_pegawai
                        
                        FROM data_stockmasuk
                        
                        LEFT JOIN data_pegawai ON data_stockmasuk.id_pegawai = data_pegawai.id_pegawai
                        
                        WHERE MONTH(data_stockmasuk.tanggal) = '$bulan' AND YEAR(data_stockmasuk.tanggal) = '$tahun'

                        ORDER BY data_stockmasuk.id_stockMasuk DESC");

        return $query->result_array();
    }
}
