<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Barang_Keluar extends CI_Controller
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

    // Data Barang Keluar
    public function DataBarangKeluar($id_stockBarang)
    {
        $data['DataStock']      = $this->M_StockBarang->EditStockBarang($id_stockBarang);
        $data['DataPegawai']    = $this->M_DataPegawai->DataPegawai();
        $data['CustomerModem']  = $this->M_DataCustomer->CustomerAktivasi_Modem();
        $data['CustomerSTB']    = $this->M_DataCustomer->CustomerAktivasi_STB();
        $data['DataAktivasi']   = $this->M_DataAktivasi->DataAktivasiStock($id_stockBarang);
        $data['DataAdaptor']    = $this->M_StockBarang->StockBarangAdapter();
        $data['DataKabel']      = $this->M_StockBarang->StockBarangKabelInstalasi();

        // Check Jumlah Data Barang Patch Core
        $CheckStock             = $this->M_StockBarang->CheckStocBarang($id_stockBarang);

        $JumlahStock            = $CheckStock->jumlah_stockBarang;
        $data['StockBarang']    = $CheckStock->jumlah_stockBarang;

        $Hitam_UPC               = $this->M_StockBarang->CheckStocBarang('49');
        $Kuning_APC              = $this->M_StockBarang->CheckStocBarang('50');
        $Biru_UPC                = $this->M_StockBarang->CheckStocBarang('51');

        $data['Hitam_UPC']      = $Hitam_UPC->jumlah_stockBarang;
        $data['Kuning_APC']     = $Kuning_APC->jumlah_stockBarang;
        $data['Biru_UPC']       = $Biru_UPC->jumlah_stockBarang;

        if ($JumlahStock != 0) {
            $this->load->view('template/DataBarang/V_Header_Barang', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/StockBarangDistribusi/V_Barang_Keluar', $data);
            $this->load->view('template/DataBarang/V_Footer_Barang', $data);
        } else {
            $this->session->set_flashdata('gagal_icon', 'warning');
            $this->session->set_flashdata('gagal_title', 'Stock Barang Tidak Ada');
            redirect('admin/StockBarangDistribusi/C_Barang_Distribusi');
        }
    }
    // End Data Barang Keluar

    // Tambah Barang Keluar 
    public function TambahBarangKeluar()
    {
        // mengambil data post pada view
        $id_stockBarang     = $this->input->post('id_stockBarang');
        $jumlah             = $this->input->post('jumlah');
        $tanggal            = $this->input->post('tanggal');
        $id_pegawai         = $this->input->post('id_pegawai');
        $keterangan         = $this->input->post('keterangan');

        // DATA BARANG NON MODEM
        $CheckStock         = $this->M_StockBarang->CheckStocBarang($id_stockBarang);

        // MENGURANGI DAN MENAMBAH STOCK, MUTASI 
        $JumlahStockBarang  = $CheckStock->jumlah_stockBarang - $jumlah;
        $JumlahMutasiBarang = $CheckStock->jumlah_stockMutasi + $jumlah;

        $DataBarang = array(
            'jumlah_stockBarang'    => $JumlahStockBarang,
            'jumlah_stockMutasi'    => $JumlahMutasiBarang,
            'tanggal_mutasi'        => $tanggal
        );

        // WHERE CONDITION ID BARANG
        $IdBarang                   = array(
            'id_stockBarang'        => $id_stockBarang
        );

        // LAPORAN BARANG KELUAR STB
        $LaporanBarang_Keluar       = array(
            'id_stockBarang'        => $id_stockBarang,
            'jumlah'                => $jumlah,
            'tanggal'               => $tanggal,
            'id_pegawai'            => $id_pegawai,
            'id_status'             => 13,
            'keterangan'            => $keterangan
        );

        $this->M_CRUD->updateData('data_stockbarang', $DataBarang, $IdBarang);
        $this->M_CRUD->insertData($LaporanBarang_Keluar, 'data_stockkeluar');

        $this->session->set_flashdata('berhasil_icon', 'success');
        $this->session->set_flashdata('berhasil_title', 'Keluar Barang Berhasil');

        redirect('admin/StockBarangDistribusi/C_Barang_Distribusi');
    }
}
