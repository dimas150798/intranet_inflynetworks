<?php

class M_StockRincian extends CI_Model
{

    // Menampilkan Data Stock Rincian
    public function StockRincian()
    {
        $query   = $this->db->query("SELECT data_stockrincian.id_stockRincian, data_stockrincian.kode_barang, data_stockrincian.id_stockBarang,
                    data_stockrincian.jumlah, data_stockrincian.tanggal, data_status.nama_status, data_keadaanbarang.nama_keadaan, data_namabarang.nama_barang

                    FROM data_stockrincian
                    
                    LEFT JOIN data_status ON data_stockrincian.id_status = data_status.id_status
                    LEFT JOIN data_keadaanbarang ON data_stockrincian.id_keadaanbarang = data_keadaanbarang.id_keadaanbarang
                    LEFT JOIN data_stockbarang ON data_stockrincian.id_stockBarang = data_stockbarang.id_stockBarang
                    LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
                    
                    ORDER BY data_stockrincian.tanggal DESC");

        return $query->result_array();
    }

    //Edit Data Stock Rincian
    public function EditStockRincian($id_stockRincian)
    {
        $query   = $this->db->query("SELECT data_stockrincian.id_stockRincian, data_stockrincian.kode_barang, data_stockrincian.id_stockBarang,
                                    data_stockrincian.jumlah, data_stockrincian.tanggal, data_status.nama_status, data_keadaanbarang.nama_keadaan

                                    FROM data_stockrincian
                                    
                                    LEFT JOIN data_status ON data_stockrincian.id_status = data_status.id_status
                                    LEFT JOIN data_keadaanbarang ON data_stockrincian.id_keadaanbarang = data_keadaanbarang.id_keadaanbarang
                                    
                                    WHERE id_stockRincian = '$id_stockRincian'

                                    ORDER BY data_stockrincian.tanggal DESC ");

        return $query->result_array();
    }

    // Check data stock rincian
    public function CheckStockRincian($id_stockRincian)
    {
        $this->db->select('data_stockrincian.id_stockRincian, data_stockrincian.kode_barang, data_stockrincian.id_stockBarang,
                        data_stockrincian.jumlah, data_stockrincian.tanggal, data_status.nama_status, data_keadaanbarang.nama_keadaan, data_namabarang.nama_barang');
        $this->db->join('data_status', 'data_stockrincian.id_status = data_status.id_status', 'left');
        $this->db->join('data_keadaanbarang', 'data_stockrincian.id_keadaanbarang = data_keadaanbarang.id_keadaanbarang', 'left');
        $this->db->join('data_stockbarang', 'data_stockrincian.id_stockBarang = data_stockbarang.id_stockBarang', 'left');
        $this->db->join('data_namabarang', 'data_stockbarang.id_barang = data_namabarang.id_barang', 'left');
        $this->db->where('data_stockrincian.id_stockRincian', $id_stockRincian);

        $this->db->limit(1);
        $result = $this->db->get('data_stockrincian');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}
