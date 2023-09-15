<?php

class M_DataRequest extends CI_Model
{

    // Menampilkan Data Request
    public function DataRequest($tahun, $bulan)
    {
        $query   = $this->db->query("SELECT data_purchase_request.id_purchase_request, data_purchase_request.no_purchase_request, data_purchase_request.jumlah_request, data_purchase_request.tanggal,
                                    data_purchase_request.keterangan, data_purchase_request.id_status, data_purchase_request.id_pegawai, data_purchase_request.id_barang, data_pegawai.nama_pegawai, data_namabarang.nama_barang,
                                    data_status.nama_status

                                    FROM data_purchase_request

                                    LEFT JOIN data_status ON data_purchase_request.id_status = data_status.id_status 
                                    LEFT JOIN data_pegawai ON data_purchase_request.id_pegawai = data_pegawai.id_pegawai 
                                    LEFT JOIN data_namabarang ON data_purchase_request.id_barang = data_namabarang.id_barang

                                    WHERE YEAR(data_purchase_request.tanggal) = '$tahun' AND MONTH(data_purchase_request.tanggal) = '$bulan'

                                    ORDER BY data_purchase_request.id_purchase_request DESC");

        return $query->result_array();
    }

    // Check data aktivasi
    public function CheckACCRequest($no_purchase_request, $id_barang)
    {
        $this->db->select('data_purchase_request.id_purchase_request, data_purchase_request.no_purchase_request, data_purchase_request.jumlah_request, data_purchase_request.tanggal,
                       data_purchase_request.keterangan, data_purchase_request.id_status, data_purchase_request.id_pegawai, data_purchase_request.id_barang, data_pegawai.nama_pegawai, data_namabarang.nama_barang,
                       data_status.nama_status');
        $this->db->join('data_status', 'data_purchase_request.id_status = data_status.id_status', 'left');
        $this->db->join('data_pegawai', 'data_purchase_request.id_pegawai = data_pegawai.id_pegawai', 'left');
        $this->db->join('data_namabarang', 'data_purchase_request.id_barang = data_namabarang.id_barang', 'left');
        $this->db->where('data_purchase_request.no_purchase_request', $no_purchase_request);
        $this->db->where('data_purchase_request.id_barang', $id_barang);

        $this->db->limit(1);
        $result = $this->db->get('data_purchase_request');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check data aktivasi
    public function CheckInvoiceRequest($no_purchase_request)
    {
        $this->db->select('data_purchase_request.id_purchase_request, data_purchase_request.no_purchase_request, data_purchase_request.jumlah_request, data_purchase_request.tanggal,
                        data_purchase_request.keterangan, data_purchase_request.id_status, data_purchase_request.id_pegawai, data_purchase_request.id_barang, data_pegawai.nama_pegawai, data_namabarang.nama_barang,
                        data_status.nama_status');
        $this->db->join('data_status', 'data_purchase_request.id_status = data_status.id_status', 'left');
        $this->db->join('data_pegawai', 'data_purchase_request.id_pegawai = data_pegawai.id_pegawai', 'left');
        $this->db->join('data_namabarang', 'data_purchase_request.id_barang = data_namabarang.id_barang', 'left');
        $this->db->where('data_purchase_request.no_purchase_request', $no_purchase_request);

        $this->db->limit(1);
        $result = $this->db->get('data_purchase_request');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check data aktivasi Stock Barang
    public function CheckAktivasiStock($kode_barang)
    {
        $this->db->select('id_aktivasi, kode_barang, id_stockBarang, jumlah_modem, Patch_Core_Hitam_UPC_Outdor, Patch_Core_Kuning_UPC_Biru, Patch_Core_Kuning_APC_Hijau, Adaptor, tanggal, id_status');
        $this->db->where('kode_barang', $kode_barang);

        $this->db->limit(1);
        $result = $this->db->get('data_aktivasi');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Invoice Request
    public function InvoiceRequest()
    {
        $sql = "SELECT MAX(MID(no_purchase_request,8,4)) AS invoiceID 
            FROM data_purchase_request
            WHERE MID(no_purchase_request,4,4) = DATE_FORMAT(CURDATE(), '%y%m')";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $dataRow    = $query->row();
            $dataN      = ((int)$dataRow->invoiceID) + 1;
            $no         = sprintf("%'.04d", $dataN);
        } else {
            $no         = "0001";
        }

        $invoice = "INR" . date('ym') . $no;
        return $invoice;
    }
}
