<?php

class M_DataOrder extends CI_Model
{

    // Menampilkan Data Request
    public function DataOrder($tahun, $bulan)
    {
        $query   = $this->db->query("SELECT data_purchase_order.id_purchase_order, data_purchase_order.no_purchase_order, data_purchase_order.jumlah_order, data_purchase_order.tanggal, data_purchase_order.tanggal_diterima,
                                    data_purchase_order.no_pesanan, data_purchase_order.nama_supplier, data_purchase_order.harga_barang, data_purchase_order.keterangan, data_purchase_order.foto_order, data_purchase_order.biaya_ongkir,
                                    data_purchase_order.biaya_penanganan, data_purchase_order.biaya_layanan, data_purchase_order.biaya_angsuran, data_purchase_order.biaya_lainnya, data_purchase_order.id_status,
                                    data_purchase_order.id_pegawai_order, data_purchase_order.id_pegawai_terima, data_purchase_order.id_barang, data_pegawai.nama_pegawai, data_namabarang.nama_barang, data_status.nama_status

                                    FROM data_purchase_order

                                    LEFT JOIN data_status ON data_purchase_order.id_status = data_status.id_status 
                                    LEFT JOIN data_pegawai ON data_purchase_order.id_pegawai_order = data_pegawai.id_pegawai 
                                    LEFT JOIN data_namabarang ON data_purchase_order.id_barang = data_namabarang.id_barang

                                    WHERE YEAR(data_purchase_order.tanggal) = '$tahun' AND MONTH(data_purchase_order.tanggal) = '$bulan'

                                    ORDER BY data_purchase_order.id_purchase_order DESC");

        return $query->result_array();
    }

    // Menampilkan Data Order Purchase Yang Ingin Diterima
    public function DoneOrder($id_purchase_order)
    {
        $query   = $this->db->query("SELECT data_purchase_order.id_purchase_order, data_purchase_order.no_purchase_order, data_purchase_order.no_purchase_request, data_purchase_order.jumlah_order, data_purchase_order.tanggal, data_purchase_order.tanggal_diterima,
                                    data_purchase_order.no_pesanan, data_purchase_order.nama_supplier, data_purchase_order.harga_barang, data_purchase_order.keterangan, data_purchase_order.foto_order, data_purchase_order.biaya_ongkir,
                                    data_purchase_order.biaya_penanganan, data_purchase_order.biaya_layanan, data_purchase_order.biaya_angsuran, data_purchase_order.biaya_lainnya, data_purchase_order.id_status,
                                    data_purchase_order.id_pegawai_order, data_purchase_order.id_pegawai_terima, data_purchase_order.id_barang, data_pegawai.nama_pegawai, data_namabarang.nama_barang, 
                                    data_status.nama_status, data_stockbarang.id_stockBarang

                                    FROM data_purchase_order

                                    LEFT JOIN data_status ON data_purchase_order.id_status = data_status.id_status 
                                    LEFT JOIN data_pegawai ON data_purchase_order.id_pegawai_order = data_pegawai.id_pegawai 
                                    LEFT JOIN data_namabarang ON data_purchase_order.id_barang = data_namabarang.id_barang
                                    LEFT JOIN data_stockbarang ON data_namabarang.id_barang = data_stockbarang.id_barang

                                    WHERE data_purchase_order.id_purchase_order = '$id_purchase_order'

                                    ORDER BY data_purchase_order.id_purchase_order DESC");

        return $query->result_array();
    }

    // Menampilkan Data Order Purchase Yang Ingin Diterima
    public function JumlahOrder($no_purchase_order)
    {
        $query   = $this->db->query("SELECT data_purchase_order.id_purchase_order, data_purchase_order.no_purchase_order,  data_purchase_order.jumlah_order, data_purchase_order.tanggal, data_purchase_order.tanggal_diterima,
                                        data_purchase_order.no_pesanan, data_purchase_order.nama_supplier, data_purchase_order.harga_barang, data_purchase_order.keterangan, data_purchase_order.foto_order, data_purchase_order.biaya_ongkir,
                                        data_purchase_order.biaya_penanganan, data_purchase_order.biaya_layanan, data_purchase_order.biaya_angsuran, data_purchase_order.biaya_lainnya, data_purchase_order.id_status,
                                        data_purchase_order.id_pegawai_order, data_purchase_order.id_pegawai_terima, data_purchase_order.id_barang, data_pegawai.nama_pegawai, data_namabarang.nama_barang, 
                                        data_status.nama_status, data_stockbarang.id_stockBarang
    
                                        FROM data_purchase_order
    
                                        LEFT JOIN data_status ON data_purchase_order.id_status = data_status.id_status 
                                        LEFT JOIN data_pegawai ON data_purchase_order.id_pegawai_order = data_pegawai.id_pegawai 
                                        LEFT JOIN data_namabarang ON data_purchase_order.id_barang = data_namabarang.id_barang
                                        LEFT JOIN data_stockbarang ON data_namabarang.id_barang = data_stockbarang.id_barang
    
                                        WHERE data_purchase_order.no_purchase_order = '$no_purchase_order' AND data_purchase_order.id_status = 3
    
                                        ORDER BY data_purchase_order.id_purchase_order DESC");

        return $query->num_rows();
    }


    // Check data order
    public function CheckOrder($id_purchase_order)
    {
        $this->db->select('data_purchase_order.id_purchase_order, data_purchase_order.jumlah_order, data_purchase_order.tanggal, data_purchase_order.tanggal_diterima,
                        data_purchase_order.no_pesanan, data_purchase_order.nama_supplier, data_purchase_order.harga_barang, data_purchase_order.keterangan, data_purchase_order.foto_order, data_purchase_order.biaya_ongkir,
                        data_purchase_order.biaya_penanganan, data_purchase_order.biaya_layanan, data_purchase_order.biaya_angsuran, data_purchase_order.biaya_lainnya, data_purchase_order.id_status,
                        data_purchase_order.id_pegawai_order, data_purchase_order.id_pegawai_terima, data_purchase_order.id_barang, data_pegawai.nama_pegawai, data_namabarang.nama_barang, 
                        data_status.nama_status, data_stockbarang.id_stockBarang');
        $this->db->join('data_status', 'data_purchase_order.id_status = data_status.id_status', 'left');
        $this->db->join('data_pegawai', 'data_purchase_order.id_pegawai_order = data_pegawai.id_pegawai', 'left');
        $this->db->join('data_namabarang', 'data_purchase_order.id_barang = data_namabarang.id_barang', 'left');
        $this->db->join('data_stockbarang', 'data_namabarang.id_barang = data_stockbarang.id_barang', 'left');
        $this->db->where('data_purchase_order.id_purchase_order', $id_purchase_order);

        $this->db->limit(1);
        $result = $this->db->get('data_purchase_order');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check data order
    public function CheckACC_Order($no_purchase_order)
    {
        $this->db->select('data_purchase_order.id_purchase_order, data_purchase_order.no_purchase_order, data_purchase_order.no_purchase_request, data_purchase_order.jumlah_order, data_purchase_order.tanggal, data_purchase_order.tanggal_diterima,
        data_purchase_order.no_pesanan, data_purchase_order.nama_supplier, data_purchase_order.harga_barang, data_purchase_order.keterangan, data_purchase_order.foto_order, data_purchase_order.biaya_ongkir,
        data_purchase_order.biaya_penanganan, data_purchase_order.biaya_layanan, data_purchase_order.biaya_angsuran, data_purchase_order.biaya_lainnya, data_purchase_order.id_status,
        data_purchase_order.id_pegawai_order, data_purchase_order.id_pegawai_terima, data_purchase_order.id_barang, data_pegawai.nama_pegawai, data_namabarang.nama_barang, 
        data_status.nama_status, data_stockbarang.id_stockBarang');
        $this->db->join('data_status', 'data_purchase_order.id_status = data_status.id_status', 'left');
        $this->db->join('data_pegawai', 'data_purchase_order.id_pegawai_order = data_pegawai.id_pegawai', 'left');
        $this->db->join('data_namabarang', 'data_purchase_order.id_barang = data_namabarang.id_barang', 'left');
        $this->db->join('data_stockbarang', 'data_namabarang.id_barang = data_stockbarang.id_barang', 'left');
        $this->db->where('data_purchase_order.no_purchase_order', $no_purchase_order);
        $this->db->where('data_purchase_order.id_status =', 3);

        $this->db->limit(1);
        $result = $this->db->get('data_purchase_order');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Invoice Order
    public function InvoiceOrder()
    {
        $sql = "SELECT MAX(MID(no_purchase_order,8,4)) AS invoiceID 
                FROM data_purchase_order
                WHERE MID(no_purchase_order,4,4) = DATE_FORMAT(CURDATE(), '%y%m')";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $dataRow    = $query->row();
            $dataN      = ((int)$dataRow->invoiceID) + 1;
            $no         = sprintf("%'.04d", $dataN);
        } else {
            $no         = "0001";
        }

        $invoice = "INO" . date('ym') . $no;
        return $invoice;
    }
}
