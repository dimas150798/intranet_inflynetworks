<?php

class M_LaporanKeluar extends CI_Model
{

    // Menampilkan Data Laporan Keluar
    public function LaporanKeluar()
    {
        $query   = $this->db->query("SELECT data_stockkeluar.id_stockKeluar, data_stockkeluar.id_stockBarang, data_stockkeluar.kode_barang, data_stockkeluar.jumlah,
                    data_stockkeluar.tanggal, data_stockkeluar.id_pegawai, data_stockkeluar.id_status, data_stockkeluar.id_customer, data_stockkeluar.keterangan, data_stockkeluar.non_modem,
                    data_pegawai.nama_pegawai, data_customer.nama_customer, data_namabarang.nama_barang
                    
                    FROM data_stockkeluar
                    
                    LEFT JOIN data_pegawai ON data_stockkeluar.id_pegawai = data_pegawai.id_pegawai
                    LEFT JOIN data_status ON data_stockkeluar.id_status = data_status.id_status
                    LEFT JOIN data_customer ON data_stockkeluar.id_customer = data_customer.id_customer
                    LEFT JOIN data_stockbarang ON data_stockkeluar.id_stockBarang = data_stockbarang.id_stockBarang
                    LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
                    
                    ORDER BY data_stockkeluar.tanggal DESC");

        return $query->result_array();
    }

    // Menampilkan Data Laporan Keluar Pencarian
    public function LaporanKeluarPencarian($bulan, $tahun)
    {
        $query   = $this->db->query("SELECT data_stockkeluar.id_stockKeluar, data_stockkeluar.id_stockBarang, data_stockkeluar.kode_barang, data_stockkeluar.jumlah,
                        data_stockkeluar.tanggal, data_stockkeluar.id_pegawai, data_stockkeluar.id_status, data_stockkeluar.id_customer, data_stockkeluar.keterangan, data_stockkeluar.non_modem,
                        data_pegawai.nama_pegawai, data_customer.nama_customer, data_namabarang.nama_barang
                        
                        FROM data_stockkeluar
                        
                        LEFT JOIN data_pegawai ON data_stockkeluar.id_pegawai = data_pegawai.id_pegawai
                        LEFT JOIN data_status ON data_stockkeluar.id_status = data_status.id_status
                        LEFT JOIN data_customer ON data_stockkeluar.id_customer = data_customer.id_customer
                        LEFT JOIN data_stockbarang ON data_stockkeluar.id_stockBarang = data_stockbarang.id_stockBarang
                        LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
                        
                        WHERE MONTH(data_stockkeluar.tanggal) = '$bulan' AND YEAR(data_stockkeluar.tanggal) = '$tahun'

                        ORDER BY data_stockkeluar.id_stockKeluar DESC");

        return $query->result_array();
    }
}
