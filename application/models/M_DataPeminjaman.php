<?php

class M_DataPeminjaman extends CI_Model
{

    // Menampilkan Data Peminjaman
    public function DataPeminjaman($tanggal)
    {
        $query   = $this->db->query("SELECT data_peminjaman_barang.id_peminjaman_barang, data_peminjaman_barang.id_stockBarang, data_peminjaman_barang.kode_barang, data_peminjaman_barang.id_pegawai,
                                    data_peminjaman_barang.kode_peminjaman_barang, data_peminjaman_barang.tanggal, data_peminjaman_barang.jumlah, data_peminjaman_barang.id_status, data_peminjaman_barang.keterangan,
                                    data_namabarang.nama_barang, data_pegawai.nama_pegawai, data_status.nama_status

                                    FROM data_peminjaman_barang

                                    LEFT JOIN data_stockbarang ON data_peminjaman_barang.id_stockBarang = data_stockbarang.id_stockBarang
                                    LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
                                    LEFT JOIN data_status ON data_peminjaman_barang.id_status = data_status.id_status
                                    LEFT JOIN data_pegawai ON data_peminjaman_barang.id_pegawai = data_pegawai.id_pegawai

                                    WHERE data_peminjaman_barang.tanggal = '$tanggal'

                                    ORDER BY data_peminjaman_barang.tanggal DESC");

        return $query->result_array();
    }

    // Menampilkan Data Foto Peminjaman
    public function FotoPeminjaman($tanggal)
    {
        $query   = $this->db->query("SELECT bukti_barang_peminjaman.id_bukti_barang_peminjaman, bukti_barang_peminjaman.id_pegawai, bukti_barang_peminjaman.foto_peminjaman1,
                                    bukti_barang_peminjaman.foto_peminjaman2, bukti_barang_peminjaman.foto_pengembalian1, bukti_barang_peminjaman.foto_pengembalian2, bukti_barang_peminjaman.tanggal_peminjaman, bukti_barang_peminjaman.tanggal_pengembalian,
                                    data_pegawai.nama_pegawai
        
                                    FROM bukti_barang_peminjaman

                                    LEFT JOIN data_pegawai ON bukti_barang_peminjaman.id_pegawai = data_pegawai.id_pegawai 

                                    WHERE bukti_barang_peminjaman.tanggal_peminjaman = '$tanggal'

                                    ORDER BY bukti_barang_peminjaman.tanggal_peminjaman DESC");

        return $query->result_array();
    }

    // Menampilkan Data Foto Peminjaman
    public function UploadFotoPeminjaman($id_bukti_barang_peminjaman)
    {
        $query   = $this->db->query("SELECT bukti_barang_peminjaman.id_bukti_barang_peminjaman, bukti_barang_peminjaman.id_pegawai, bukti_barang_peminjaman.foto_peminjaman1,
                                        bukti_barang_peminjaman.foto_peminjaman2, bukti_barang_peminjaman.foto_pengembalian1, bukti_barang_peminjaman.foto_pengembalian2, bukti_barang_peminjaman.tanggal_peminjaman, bukti_barang_peminjaman.tanggal_pengembalian,
                                        data_pegawai.nama_pegawai
            
                                        FROM bukti_barang_peminjaman
    
                                        LEFT JOIN data_pegawai ON bukti_barang_peminjaman.id_pegawai = data_pegawai.id_pegawai 
    
                                        WHERE bukti_barang_peminjaman.id_bukti_barang_peminjaman = '$id_bukti_barang_peminjaman'
    
                                        ORDER BY bukti_barang_peminjaman.tanggal_peminjaman DESC");

        return $query->result_array();
    }

    //Edit Data Peminjaman
    public function EditPeminjaman($id_peminjaman_barang)
    {
        $query   = $this->db->query("SELECT data_peminjaman_barang.id_peminjaman_barang, data_peminjaman_barang.id_stockBarang, data_peminjaman_barang.kode_barang, data_peminjaman_barang.id_pegawai,
                                    data_peminjaman_barang.kode_peminjaman_barang, data_peminjaman_barang.tanggal, data_peminjaman_barang.jumlah, data_peminjaman_barang.id_status, data_peminjaman_barang.keterangan,
                                    data_namabarang.nama_barang, data_stockbarang.jumlah_stockBarang, data_stockbarang.jumlah_stockMutasi

                                    FROM data_peminjaman_barang

                                    LEFT JOIN data_stockbarang ON data_peminjaman_barang.id_stockBarang = data_stockbarang.id_stockBarang
                                    LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
                                    LEFT JOIN data_status ON data_peminjaman_barang.id_status = data_status.id_status

                                    WHERE id_peminjaman_barang = '$id_peminjaman_barang'

        ORDER BY data_peminjaman_barang.tanggal DESC");

        return $query->result_array();
    }

    // Check Data Kembali
    public function CheckDataKembali($id_peminjaman_barang)
    {
        $this->db->select('data_peminjaman_barang.id_peminjaman_barang, data_peminjaman_barang.id_stockBarang, data_peminjaman_barang.kode_barang, data_peminjaman_barang.id_pegawai,
                        data_peminjaman_barang.kode_peminjaman_barang, data_peminjaman_barang.tanggal, data_peminjaman_barang.jumlah, data_peminjaman_barang.id_status, data_peminjaman_barang.keterangan,
                        data_namabarang.nama_barang, data_stockbarang.jumlah_stockBarang, data_stockbarang.jumlah_stockMutasi');
        $this->db->join('data_stockbarang', 'data_peminjaman_barang.id_stockBarang = data_stockbarang.id_stockBarang', 'left');
        $this->db->join('data_namabarang', 'data_stockbarang.id_barang = data_namabarang.id_barang', 'left');
        $this->db->join('data_status', 'data_peminjaman_barang.id_status = data_status.id_status', 'left');

        $this->db->where('id_peminjaman_barang', $id_peminjaman_barang);

        $this->db->limit(1);
        $result = $this->db->get('data_peminjaman_barang');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check Data Kembali
    public function CheckFotoKembali($id_bukti_barang_peminjaman)
    {
        $this->db->select('bukti_barang_peminjaman.id_bukti_barang_peminjaman, bukti_barang_peminjaman.id_pegawai, bukti_barang_peminjaman.foto_peminjaman1,
                            bukti_barang_peminjaman.foto_peminjaman2, bukti_barang_peminjaman.foto_pengembalian1, bukti_barang_peminjaman.foto_pengembalian2, bukti_barang_peminjaman.tanggal_peminjaman, bukti_barang_peminjaman.tanggal_pengembalian,
                            data_pegawai.nama_pegawai');
        $this->db->join('data_pegawai', 'bukti_barang_peminjaman.id_pegawai = data_pegawai.id_pegawai', 'left');

        $this->db->where('id_bukti_barang_peminjaman', $id_bukti_barang_peminjaman);

        $this->db->limit(1);
        $result = $this->db->get('bukti_barang_peminjaman');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}
