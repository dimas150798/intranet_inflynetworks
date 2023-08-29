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
            $nama_customer      = $this->input->post('nama_customer');
            $pembelian_paket    = $this->input->post('nama_paket');
            $nik_customer       = $this->input->post('nik_customer');
            $tlp_customer       = $this->input->post('tlp_customer');
            $alamat_customer    = $this->input->post('alamat_customer');
            $date               = $this->input->post('date');
            $kode_barang        = $this->input->post('kode_barang');
            $kode_barang_stb    = $this->input->post('kode_barang_stb');


            $dataCustomer = array(
                'nik_customer'       => $nik_customer,
                'nama_customer'      => $nama_customer,
                'pembelian_paket'    => $pembelian_paket,
                'tlp_customer'       => $tlp_customer,
                'alamat_customer'    => $alamat_customer,
                'date'               => $date,
                'kode_barang'        => $kode_barang,
                'kode_barang_stb'    => $kode_barang_stb

            );


            $this->M_CRUD->insertData($dataCustomer, 'data_customer');
            $this->session->set_flashdata('Tambah_icon', 'success');
            $this->session->set_flashdata('Tambah_title', 'Tambah Data Berhasil');

            redirect('admin/DataCustomer/C_Data_Customer');
        }
    }
}
