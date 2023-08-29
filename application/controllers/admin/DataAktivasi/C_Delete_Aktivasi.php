<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Delete_Aktivasi extends CI_Controller
{

    public function DeleteDataAktivasi($id_aktivasi)
    {
        date_default_timezone_set("Asia/Jakarta");

        // Mengambil data aktivasi dari database
        $checkAktivasi = $this->M_DataAktivasi->CheckAktivasi($id_aktivasi);

        // Mengambil data dari check aktivasi
        $id_stockBarang = $checkAktivasi->id_stockBarang;
        $id_status = $checkAktivasi->id_status;

        // Mengambil data stock barang dari id_stockBarang
        $checkStockBarang   = $this->M_StockBarang->CheckStocBarang($id_stockBarang);

        // Mengambil jumlah stock barang masuk, mutasi, rusak
        $jumlah_stockBarang = $checkStockBarang->jumlah_stockBarang + 1;
        $jumlah_stockMutasi = $checkStockBarang->jumlah_stockMutasi - 1;
        $jumlah_stockRusak  = $checkStockBarang->jumlah_stockRusak;

        // Update Data Stock Barang
        $StockBarang = array(
            'jumlah_stockBarang'    => $jumlah_stockBarang,
            'jumlah_stockMutasi'    => $jumlah_stockMutasi
        );

        // Condition Stock Barang
        $WhereStockBarang = array(
            'id_stockBarang'    => $id_stockBarang
        );

        // Update Data Aktivasi
        $DataAktivasi = array(
            'Patch_Core_Hitam_UPC_Outdor'   => NULL,
            'Patch_Core_Kuning_UPC_Biru'    => NULL,
            'Patch_Core_Kuning_APC_Hijau'   => NULL,
            'Adaptor'                       => NULL,
            'tanggal'                       => date('Y-m-d', time()),
            'id_status'                     => 12,
            'id_customer'                   => NULL
        );

        // Condition Aktivasi
        $WhereAktivasi = array(
            'id_aktivasi'   => $id_aktivasi
        );

        if ($id_status == '13') {
            $this->M_CRUD->updateData('data_stockbarang', $StockBarang, $WhereStockBarang);
            $this->M_CRUD->updateData('data_aktivasi', $DataAktivasi, $WhereAktivasi);

            $this->session->set_flashdata('Delete_icon', 'success');
            $this->session->set_flashdata('Delete_title', 'Hapus Data Berhasil');
        } else {
        }

        redirect('admin/DataAktivasi/C_Data_Aktivasi');
    }
}
