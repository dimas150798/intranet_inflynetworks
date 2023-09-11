<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Delete_Aktivasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == null) {

            // Notifikasi Login Terlebih Dahulu
            $this->session->set_flashdata('gagal_icon', 'warning');
            $this->session->set_flashdata('gagal_title', 'Masukkan Username & Password Terlebih Dahulu');

            redirect('C_Login');
        }
    }

    public function DeleteDataAktivasi($id_aktivasi)
    {
        date_default_timezone_set("Asia/Jakarta");

        // Mengambil data aktivasi dari database
        $checkAktivasi = $this->M_DataAktivasi->CheckAktivasi($id_aktivasi);

        // Mengambil data dari check aktivasi
        $id_stockBarang = $checkAktivasi->id_stockBarang;
        $id_status = $checkAktivasi->id_status;
        $kode_barang = $checkAktivasi->kode_barang;

        // Mengambil data stock barang dari id_stockBarang
        $checkStockBarang   = $this->M_StockBarang->CheckStocBarang($id_stockBarang);

        // Mengambil jumlah stock barang masuk, mutasi, rusak
        $jumlah_stockBarang = $checkStockBarang->jumlah_stockBarang + 1;
        $jumlah_stockMutasi = $checkStockBarang->jumlah_stockMutasi - 1;

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
            'id_aktivasi'                   => $id_aktivasi
        );

        // Update Data Customer Modem
        $DataCustomerModem = array(
            'kode_barang'                   => NULL,
            'id_status'                     => NULL
        );

        // Update Data Customer STB
        $DataCustomerSTB = array(
            'kode_barang_stb'               => NULL,
            'id_status'                     => NULL
        );

        // Condition Customer
        $WhereCustomer = array(
            'kode_barang'                   => $kode_barang
        );

        if ($checkAktivasi->id_status == 13) {
            if ($id_stockBarang == 97) {
                $this->M_CRUD->updateData('data_stockbarang', $StockBarang, $WhereStockBarang);
                $this->M_CRUD->updateData('data_aktivasi', $DataAktivasi, $WhereAktivasi);
                $this->M_CRUD->updateData('data_customer', $DataCustomerSTB, $WhereCustomer);

                $this->session->set_flashdata('berhasil_icon', 'success');
                $this->session->set_flashdata('berhasil_title', 'Hapus Data Berhasil');
            } else {
                $this->M_CRUD->updateData('data_stockbarang', $StockBarang, $WhereStockBarang);
                $this->M_CRUD->updateData('data_aktivasi', $DataAktivasi, $WhereAktivasi);
                $this->M_CRUD->updateData('data_customer', $DataCustomerModem, $WhereCustomer);

                $this->session->set_flashdata('berhasil_icon', 'success');
                $this->session->set_flashdata('berhasil_title', 'Hapus Data Berhasil');
            }
        } elseif ($checkAktivasi->id_status == 1) {
            if ($id_stockBarang == 97) {
                $this->M_CRUD->updateData('data_stockbarang', $StockBarang, $WhereStockBarang);
                $this->M_CRUD->updateData('data_aktivasi', $DataAktivasi, $WhereAktivasi);
                $this->M_CRUD->updateData('data_customer', $DataCustomerSTB, $WhereCustomer);

                $this->session->set_flashdata('berhasil_icon', 'success');
                $this->session->set_flashdata('berhasil_title', 'Hapus Data Berhasil');
            } else {
                $this->M_CRUD->updateData('data_stockbarang', $StockBarang, $WhereStockBarang);
                $this->M_CRUD->updateData('data_aktivasi', $DataAktivasi, $WhereAktivasi);
                $this->M_CRUD->updateData('data_customer', $DataCustomerModem, $WhereCustomer);

                $this->session->set_flashdata('berhasil_icon', 'success');
                $this->session->set_flashdata('berhasil_title', 'Hapus Data Berhasil');
            }
        } else {
            $this->session->set_flashdata('gagal_icon', 'success');
            $this->session->set_flashdata('gagal_title', 'Status Barang Sudah Stock');
        }

        redirect('admin/DataAktivasi/C_Data_Aktivasi');
    }
}
