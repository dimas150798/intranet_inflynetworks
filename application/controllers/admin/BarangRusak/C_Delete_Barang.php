<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Delete_Barang extends CI_Controller
{

    public function DeleteBarangRusak($id_stockRincian)
    {
        date_default_timezone_set("Asia/Jakarta");

        // Mengambil data stock rincian dari database
        $checkStockRincian  = $this->M_StockRincian->CheckStockRincian($id_stockRincian);

        // Mengambil data dari check stock rincian
        $id_stockBarang     = $checkStockRincian->id_stockBarang;
        $jumlah             = $checkStockRincian->jumlah;

        // Mengambil data stock barang dari id_stockBarang
        $checkStockBarang   = $this->M_StockBarang->CheckStocBarang($id_stockBarang);

        // Mengambil jumlah stock barang masuk, mutasi, rusak
        $jumlah_stockBarang = $checkStockBarang->jumlah_stockBarang + $jumlah;
        $jumlah_stockRusak  = $checkStockBarang->jumlah_stockRusak - $jumlah;

        // Update Data Stock Barang
        $StockBarang = array(
            'jumlah_stockBarang'    => $jumlah_stockBarang,
            'jumlah_stockRusak'     => $jumlah_stockRusak
        );

        // Condition Stock Barang
        $WhereStockBarang = array(
            'id_stockBarang'        => $id_stockBarang
        );

        // Condition Stock Rincian
        $WhereStockRincian = array(
            'id_stockRincian' => $id_stockRincian
        );

        $this->M_CRUD->updateData('data_stockbarang', $StockBarang, $WhereStockBarang);

        $this->M_CRUD->deleteData($WhereStockRincian, 'data_stockrincian');

        $this->session->set_flashdata('berhasil_icon', 'success');
        $this->session->set_flashdata('berhasil_title', 'Hapus Data Berhasil');

        redirect('admin/BarangRusak/C_Barang_Rusak');
    }
}
