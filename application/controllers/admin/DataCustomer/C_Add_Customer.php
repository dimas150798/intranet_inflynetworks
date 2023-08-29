<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Add_Customer extends CI_Controller
{
    public function index()
    {
        $data['DataPaket']      = $this->M_Paket->DataPaket();

        $this->load->view('template/V_Header_Admin', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/DataCustomer/V_Add_Customer', $data);
        $this->load->view('template/V_Footer_Admin', $data);
    }

    public function TambahCustomer()
    {
        // Rules form validation
        $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
        $this->form_validation->set_rules('nama_paket', 'Paket', 'required');
        $this->form_validation->set_rules('nik_customer', 'NIK Customer', 'required');
        $this->form_validation->set_rules('tlp_customer', 'Telephon', 'required');
        $this->form_validation->set_rules('alamat_customer', 'Alamat', 'required');
        $this->form_validation->set_rules('date', 'Tanggal Registrasi', 'required');
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required');
        $this->form_validation->set_rules('kode_barang_stb', 'Kode Barang STB', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/V_Header_Admin');
            $this->load->view('template/V_Sidebar_Admin');
            $this->load->view('admin/DataCustomer/V_Add_Customer');
            $this->load->view('template/V_Footer_Admin');
        } else {
            // mengambil data post pada view
            $nama_pegawai          = $this->input->post('nama_pegawai');
            $nik                   = $this->input->post('nik');
            $no_telpon             = $this->input->post('no_telpon');
            $alamat_pegawai        = $this->input->post('alamat_pegawai');
            $pendidikan_pegawai    = $this->input->post('pendidikan_pegawai');
            $jabatan               = $this->input->post('jabatan');
            $tanggal_masuk         = $this->input->post('tanggal_masuk');
            $gaji                  = $this->input->post('gaji');
            $photo                 = $_FILES['photo']['name'];

            );


            $this->M_CRUD->insertData($dataCustomer, 'data_customer');
            $this->session->set_flashdata('Tambah_icon', 'success');
            $this->session->set_flashdata('Tambah_title', 'Tambah Data Berhasil');

            redirect('admin/DataCustomer/C_Data_Customer');
        }
    }
}
