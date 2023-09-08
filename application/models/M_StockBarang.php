<?php

class M_StockBarang extends CI_Model
{

    // Menampilkan Data Stock Barang
    public function StockBarang()
    {
        $query   = $this->db->query("SELECT data_stockbarang.id_stockBarang, data_stockbarang.id_barang, data_stockbarang.jumlah_stockBarang, data_stockbarang.jumlah_stockMutasi, 
            data_stockbarang.jumlah_stockRusak, data_stockbarang.tanggal_restock, data_stockbarang.tanggal_mutasi, data_namabarang.nama_barang, data_peralatan.kategori_peralatan

            FROM data_stockbarang
            
            LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
            LEFT JOIN data_peralatan ON data_namabarang.id_peralatan = data_peralatan.id_peralatan
            
            ORDER BY data_namabarang.nama_barang ASC");

        return $query->result_array();
    }

    // Menampilkan Data Stock Barang Adapter
    public function StockBarangAdapter()
    {
        $query   = $this->db->query("SELECT data_stockbarang.id_stockBarang, data_stockbarang.id_barang, data_stockbarang.jumlah_stockBarang, data_stockbarang.jumlah_stockMutasi, 
                data_stockbarang.jumlah_stockRusak, data_stockbarang.tanggal_restock, data_stockbarang.tanggal_mutasi, data_namabarang.nama_barang, data_peralatan.kategori_peralatan
    
                FROM data_stockbarang
                
                LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
                LEFT JOIN data_peralatan ON data_namabarang.id_peralatan = data_peralatan.id_peralatan

                WHERE data_stockbarang.id_barang BETWEEN 34 AND 36
                
                ORDER BY data_namabarang.nama_barang ASC");

        return $query->result_array();
    }

    // Menampilkan Data Stock Barang Aktivasi
    public function StockBarangAktivasi()
    {
        $query   = $this->db->query("SELECT data_stockbarang.id_stockBarang, data_stockbarang.id_barang, data_stockbarang.jumlah_stockBarang, data_stockbarang.jumlah_stockMutasi, 
                data_stockbarang.jumlah_stockRusak, data_stockbarang.tanggal_restock, data_stockbarang.tanggal_mutasi, data_namabarang.nama_barang, data_peralatan.kategori_peralatan
    
                FROM data_stockbarang
                
                LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
                LEFT JOIN data_peralatan ON data_namabarang.id_peralatan = data_peralatan.id_peralatan

                WHERE data_peralatan.id_peralatan = 3 OR data_peralatan.id_peralatan = 7
                
                ORDER BY data_namabarang.nama_barang ASC");

        return $query->result_array();
    }

    //Edit Data Stock Barang
    public function EditStockBarang($id_stockBarang)
    {
        $query   = $this->db->query("SELECT data_stockbarang.id_stockBarang, data_stockbarang.id_barang, data_stockbarang.jumlah_stockBarang, data_stockbarang.jumlah_stockMutasi, 
                                data_stockbarang.jumlah_stockRusak, data_stockbarang.tanggal_restock, data_stockbarang.tanggal_mutasi, data_namabarang.nama_barang, data_peralatan.kategori_peralatan

                                FROM data_stockbarang
                                
                                LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
                                LEFT JOIN data_peralatan ON data_namabarang.id_peralatan = data_peralatan.id_peralatan

                                WHERE data_stockbarang.id_stockBarang = '$id_stockBarang'
                                
                                ORDER BY data_namabarang.nama_barang ASC ");

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
