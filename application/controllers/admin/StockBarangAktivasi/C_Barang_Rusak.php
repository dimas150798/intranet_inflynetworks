<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Barang_Rusak extends CI_Controller
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

    // Data Barang Rusak
    public function Barang_Rusak($id_stockBarang)
    {
        $data['DataStock']      = $this->M_StockBarang->EditStockBarang($id_stockBarang);
        $data['DataAktivasi']   = $this->M_DataAktivasi->DataAktivasiStock($id_stockBarang);

        $data['DataPegawai']    = $this->M_DataPegawai->DataPegawai();

        // Check Jumlah Data Barang Stock
        $StockBarang            = $this->M_StockBarang->CheckStocBarang($id_stockBarang);
        $data['JumlahStock']    = $StockBarang->jumlah_stockBarang;

        // Check Jumlah Data Barang Patch Core
        $CheckStock             = $this->M_StockBarang->CheckStocBarang($id_stockBarang);
        $JumlahStock            = $CheckStock->jumlah_stockBarang;

        if ($id_stockBarang == 49 or $id_stockBarang == 50 or $id_stockBarang == 51 or $id_stockBarang == 30 or $id_stockBarang == 29 or $id_stockBarang == 31) {
            if ($JumlahStock != 0) {
                $this->load->view('template/DataBarang/V_Header_Barang', $data);
                $this->load->view('template/V_Sidebar_Admin', $data);
                $this->load->view('admin/StockBarangAktivasi/V_Barang_Rusak', $data);
                $this->load->view('template/DataBarang/V_Footer_Barang', $data);
            } else {
                $this->session->set_flashdata('gagal_icon', 'warning');
                $this->session->set_flashdata('gagal_title', 'Stock Barang Tidak Ada');
                redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
            }
        } else {
            if ($JumlahStock != 0) {
                $this->load->view('template/DataBarang/V_Header_Barang', $data);
                $this->load->view('template/V_Sidebar_Admin', $data);
                $this->load->view('admin/StockBarangAktivasi/V_Barang_RusakModem', $data);
                $this->load->view('template/DataBarang/V_Footer_Barang', $data);
            } else {
                $this->session->set_flashdata('gagal_icon', 'warning');
                $this->session->set_flashdata('gagal_title', 'Stock Barang Tidak Ada');
                redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
            }
        }
    }
    // End Data Barang Rusak

    // Tambah Data Barang Rusak Aktivasi
    public function Tambah_BarangRusak()
    {
        // mengambil data post pada view
        $id_stockBarang         = $this->input->post('id_stockBarang');
        $jumlah                 = $this->input->post('jumlah');
        $id_pegawai             = $this->input->post('id_pegawai');
        $tanggal                = $this->input->post('tanggal');
        $keterangan             = $this->input->post('keterangan');
        $kode_barang            = $this->input->post('kode_barang');

        // CHECK STOCK BARANG
        $StockBarang            = $this->M_StockBarang->CheckStocBarang($id_stockBarang);

        // MENAMBAH DAN MENGURANGI STOCK DAN MUTASI 
        $JumlahStock            = $StockBarang->jumlah_stockBarang - $jumlah;
        $JumlahRusak            = $StockBarang->jumlah_stockRusak + $jumlah;

        // DATA STOCK BARANG
        $DataStockBarang = array(
            'jumlah_stockBarang'    => $JumlahStock,
            'jumlah_stockRusak'     => $JumlahRusak
        );

        //UPDATE DATA STOCK BARANG CONDITION ID STOCK BARANG
        $IdStockBarang = array(
            'id_stockBarang'        => $id_stockBarang
        );

        // DATA BARANG RUSAK
        $DataStockRincian = array(
            'kode_barang'           => $kode_barang,
            'id_stockBarang'        => $id_stockBarang,
            'jumlah'                => $jumlah,
            'tanggal'               => $tanggal,
            'id_status'             => 12,
            'id_pegawai'            => $id_pegawai,
            'id_keadaanbarang'      => 1,
            'keterangan'            => $keterangan
        );

        // DATA AKTIVASI
        $DataAktivasi = array(
            'Patch_Core_Hitam_UPC_Outdor'   => NULL,
            'Patch_Core_Kuning_UPC_Biru'    => NULL,
            'Patch_Core_Kuning_APC_Hijau'   => NULL,
            'id_keadaanbarang'              => 1
        );

        //UPDATE DATA AKTIVASI CONDITION ID KODE BARANG
        $IdAktivasi = array(
            'kode_barang'           => $kode_barang
        );

        $this->M_CRUD->updateData('data_stockbarang', $DataStockBarang, $IdStockBarang);
        $this->M_CRUD->updateData('data_aktivasi', $DataAktivasi, $IdAktivasi);
        $this->M_CRUD->insertData($DataStockRincian, 'data_stockrincian');

        $this->session->set_flashdata('berhasil_icon', 'success');
        $this->session->set_flashdata('berhasil_title', 'Tambah Barang Rusak Berhasil');

        redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
    }
    // End Tambah Data Barang Rusak Aktivasi


}
