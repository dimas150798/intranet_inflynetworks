<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Bonus_Pembelian extends CI_Controller
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

    // Data Bonus Pembelian
    public function DataBonusPembelian($id_stockBarang)
    {
        $data['DataStock']      = $this->M_StockBarang->EditStockBarang($id_stockBarang);
        $data['DataPegawai']    = $this->M_DataPegawai->DataPegawai();

        $this->load->view('template/DataBarang/V_Header_Barang', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/StockBarangAktivasi/V_AddBonus_Pembelian', $data);
        $this->load->view('template/DataBarang/V_Footer_Barang', $data);
    }
    // End Data Bonus Pembelian

    // Tambah Data Bonus Pembelian 
    public function TambahBonusPembelian()
    {
        // Rules form validation
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal Input', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah Barang', 'required');
        $this->form_validation->set_rules('id_pegawai', 'ID Pegawai', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        // mengambil data post pada view
        $id_stockBarang         = $this->input->post('id_stockBarang');
        $id_keadaanbarang       = $this->input->post('id_keadaanbarang');
        $nama_barang            = $this->input->post('nama_barang');
        $kode_barang            = $this->input->post('kode_barang');
        $tanggal                = $this->input->post('tanggal');
        $jumlah                 = $this->input->post('jumlah');
        $id_pegawai             = $this->input->post('id_pegawai');
        $keterangan             = $this->input->post('keterangan');

        // Check Barang
        $CheckBarang            = $this->M_StockBarang->CheckStocBarang($id_stockBarang);
        $StockBarang            = $CheckBarang->jumlah_stockBarang + $jumlah;

        // Data Stock Barang
        $StockBarang            = array(
            'jumlah_stockBarang' => $StockBarang,
            'tanggal_restock'   => $tanggal
        );

        //update menggunakan id_stockBarang
        $IdStockBarang          = array(
            'id_stockBarang'    => $id_stockBarang
        );

        // Stock Barang Masuk
        $StockBarangMasuk       = array(
            'nama_barang'       => $nama_barang,
            'kode_barang'       => $kode_barang,
            'jumlah'            => $jumlah,
            'tanggal'           => $tanggal,
            'id_pegawai'        => $id_pegawai,
            'id_status'         => 16,
            'keterangan'        => $keterangan
        );

        $data['DataStock']      = $this->M_StockBarang->EditStockBarang($id_stockBarang);
        $data['DataPegawai']    = $this->M_DataPegawai->DataPegawai();

        if ($this->form_validation->run() == false) {
            $this->load->view('template/DataBarang/V_Header_Barang', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/StockBarangAktivasi/V_AddBonus_Pembelian', $data);
            $this->load->view('template/DataBarang/V_Footer_Barang', $data);
        } else {
            $this->M_CRUD->updateData('data_stockbarang', $StockBarang, $IdStockBarang);
            $this->M_CRUD->insertData($StockBarangMasuk, 'data_stockmasuk');

            $this->session->set_flashdata('berhasil_icon', 'success');
            $this->session->set_flashdata('berhasil_title', 'Tambah Barang Berhasil');

            redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
        }
    }
    // End Tambah Data Bonus Pembelian 


}
