<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Add_Barang extends CI_Controller
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
        $data['DataSatuan']      = $this->M_DataSatuan->DataSatuan();
        $data['DataPeralatan']   = $this->M_DataPeralatan->DataPeralatan();

        $this->load->view('template/DataBarang/V_Header_Barang', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/NamaBarang/V_Add_Barang', $data);
        $this->load->view('template/DataBarang/V_Footer_Barang', $data);
    }


    public function TambahBarang()
    {
        // Rules form validation
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        // mengambil data post pada view
        $nama_barang        = $this->input->post('nama_barang');
        $id_satuan          = $this->input->post('id_satuan');
        $id_peralatan       = $this->input->post('id_peralatan');

        $DataNamaBarang = array(
            'nama_barang'       => $nama_barang,
            'id_satuan'         => $id_satuan,
            'id_peralatan'      => $id_peralatan
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('template/DataBarang/V_Header_Barang');
            $this->load->view('template/V_Sidebar_Admin');
            $this->load->view('admin/NamaBarang/V_Add_Barang');
            $this->load->view('template/DataBarang/V_Footer_Barang');
        } else {
            $this->M_CRUD->insertData($DataNamaBarang, 'data_namabarang');

            $this->session->set_flashdata('berhasil_icon', 'success');
            $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

            redirect('admin/NamaBarang/C_Nama_Barang');
        }
    }
}
