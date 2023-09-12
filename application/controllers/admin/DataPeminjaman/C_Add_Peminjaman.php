<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Add_Peminjaman extends CI_Controller
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

    public function index()
    {
        $data['StockBarang']    = $this->M_StockBarang->StockBarang();
        $data['DataPegawai']    = $this->M_DataPegawai->DataPegawai();

        $this->load->view('template/DataPeminjaman/V_Header_Peminjaman', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/DataPeminjaman/V_Add_Peminjaman', $data);
        $this->load->view('template/DataPeminjaman/V_Footer_Peminjaman', $data);
    }

    public function TambahPeminjaman()
    {
        // Rules form validation
        $this->form_validation->set_rules('tanggal', 'Tanggal Peminjaman', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah Peminjaman', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan Peminjaman', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        // mengambil data post pada view
        $id_pegawai         = $this->input->post('id_pegawai');
        $id_stockBarang     = $this->input->post('id_stockBarang');
        $tanggal            = $this->input->post('tanggal');
        $jumlah             = $this->input->post('jumlah');
        $keterangan         = $this->input->post('keterangan');

        $CheckStockBarang   = $this->M_StockBarang->CheckStocBarang($id_stockBarang);

        $PenguranganStock   = $CheckStockBarang->jumlah_stockBarang - $jumlah;
        $PenambahanMutasi   = $CheckStockBarang->jumlah_stockMutasi + $jumlah;

        $dataPeminjaman = array(
            'id_stockBarang'        => $id_stockBarang,
            'id_pegawai'            => $id_pegawai,
            'tanggal'               => $tanggal,
            'jumlah'                => $jumlah,
            'id_status'             => 1,
            'keterangan'            => $keterangan
        );

        $dataStockBarang = array(
            'jumlah_stockBarang'    => $PenguranganStock,
            'jumlah_stockMutasi'    => $PenambahanMutasi
        );

        // WHERE CONDITION ID BARANG
        $IdStockBarang              = array(
            'id_stockBarang'        => $id_stockBarang
        );

        $data['StockBarang']    = $this->M_StockBarang->StockBarang();
        $data['DataPegawai']    = $this->M_DataPegawai->DataPegawai();

        if ($this->form_validation->run() == false) {
            $this->load->view('template/DataPeminjaman/V_Header_Peminjaman', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataPeminjaman/V_Add_Peminjaman', $data);
            $this->load->view('template/DataPeminjaman/V_Footer_Peminjaman', $data);
        } else {
            if ($CheckStockBarang->jumlah_stockBarang == 0) {
                $this->session->set_flashdata('gagal_icon', 'warning');
                $this->session->set_flashdata('gagal_title', 'Stock Barang Kosong');
                redirect('admin/DataPeminjaman/C_Data_Peminjaman');
            } elseif ($jumlah > $CheckStockBarang->jumlah_stockBarang) {
                $this->session->set_flashdata('gagal_icon', 'warning');
                $this->session->set_flashdata('gagal_title', 'Stock Barang Kurang');
                redirect('admin/DataPeminjaman/C_Data_Peminjaman');
            } else {
                $this->M_CRUD->updateData('data_stockbarang', $dataStockBarang, $IdStockBarang);
                $this->M_CRUD->insertData($dataPeminjaman, 'data_peminjaman_barang');

                $this->session->set_flashdata('berhasil_icon', 'success');
                $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

                redirect('admin/DataPeminjaman/C_Data_Peminjaman');
            }
        }
    }
}
