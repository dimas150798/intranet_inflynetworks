<?php

class M_NamaBarang extends CI_Model
{

    // Menampilkan Nama Barang
    public function NamaBarang()
    {
        $query   = $this->db->query("SELECT data_namabarang.id_barang, data_namabarang.nama_barang, data_namabarang.id_satuan, data_namabarang.id_peralatan,
                                    data_satuan.nama_satuan, data_peralatan.kategori_peralatan

                                    FROM data_namabarang
                                    
                                    LEFT JOIN data_satuan ON data_namabarang.id_satuan = data_satuan.id_satuan
                                    LEFT JOIN data_peralatan ON data_namabarang.id_peralatan = data_peralatan.id_peralatan
                                    
                                    ORDER BY data_namabarang.nama_barang ASC");

        return $query->result_array();
    }

    //Edit Data Barang
    public function EditBarang($id_barang)
    {
        $query   = $this->db->query("SELECT data_namabarang.id_barang, data_namabarang.nama_barang, data_namabarang.id_satuan, data_namabarang.id_peralatan

                                    FROM data_namabarang
                                    WHERE id_barang= '$id_barang' ");

        return $query->result_array();
    }

    // Check data nama barang
    public function CheckNamaBarang($id_barang)
    {
        $this->db->select('data_namabarang.id_barang, data_namabarang.nama_barang, data_namabarang.id_satuan, data_namabarang.id_peralatan, data_satuan.nama_satuan, data_peralatan.kategori_peralatan');
        $this->db->join('data_satuan', 'data_namabarang.id_satuan = data_satuan.id_satuan', 'left');
        $this->db->join('data_peralatan', 'data_namabarang.id_peralatan = data_peralatan.id_peralatan', 'left');
        $this->db->where('data_namabarang.id_barang', $id_barang);

        $this->db->limit(1);
        $result = $this->db->get('data_namabarang');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}
