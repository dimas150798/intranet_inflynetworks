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


    //Edit Data Peminjaman
    public function EditPeminjaman($id_peminjaman_barang)
    {
        $query   = $this->db->query("SELECT data_peminjaman_barang.id_peminjaman_barang, data_peminjaman_barang.id_stockBarang, data_peminjaman_barang.kode_barang, data_peminjaman_barang.id_pegawai,
                                    data_peminjaman_barang.kode_peminjaman_barang, data_peminjaman_barang.tanggal, data_peminjaman_barang.jumlah, data_peminjaman_barang.id_status, data_peminjaman_barang.keterangan,
                                    data_namabarang.nama_barang

                                    FROM data_peminjaman_barang

                                    LEFT JOIN data_stockbarang ON data_peminjaman_barang.id_stockBarang = data_stockbarang.id_stockBarang
                                    LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
                                    LEFT JOIN data_status ON data_peminjaman_barang.id_status = data_status.id_status

                                    WHERE id_peminjaman_barang = '$id_peminjaman_barang'

        ORDER BY data_peminjaman_barang.tanggal DESC");

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
