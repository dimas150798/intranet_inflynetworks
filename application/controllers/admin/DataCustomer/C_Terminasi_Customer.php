<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Terminasi_Customer extends CI_Controller
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

    public function TerminasiCustomer($id_customer)
    {
        $data['DataCustomer']   = $this->M_DataCustomer->EditCustomer($id_customer);
        $data['DataPaket']      = $this->M_Paket->DataPaket();
        $data['DataKota']       = $this->M_Kota->DataKota();
        $data['DataKecamatan']  = $this->M_Kecamatan->DataKecamatan();
        $data['DataKelurahan']  = $this->M_Kelurahan->DataKelurahan();

        $this->load->view('template/DataCustomer/V_Header_Customer', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/DataCustomer/V_Terminasi_Customer', $data);
        $this->load->view('template/DataCustomer/V_Footer_Customer', $data);
    }

    public function TerminasiSave()
    {
        // Rules form validation
        $this->form_validation->set_rules('date_terminasi', 'Tanggal Registrasi', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        // mengambil data post pada view
        $id_customer        = $this->input->post('id_customer');
        $date_terminasi     = $this->input->post('date_terminasi');

        $dataCustomer = array(
            'date_terminasi'    => $date_terminasi,
            'kode_barang'       => NULL,
            'kode_barang_stb'   => NULL,
            'id_status'         => 8,
        );

        //update menggunakan id_customer
        $IdCustomer = array(
            'id_customer'       => $id_customer
        );

        $data['DataCustomer']   = $this->M_DataCustomer->EditCustomer($id_customer);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/DataCustomer/V_Header_Customer');
            $this->load->view('template/V_Sidebar_Admin');
            $this->load->view('admin/DataCustomer/V_Terminasi_Customer');
            $this->load->view('template/DataCustomer/V_Footer_Customer');
        } else {
            $this->M_CRUD->updateData('data_customer', $dataCustomer, $IdCustomer);
            $this->session->set_flashdata('berhasil_icon', 'success');
            $this->session->set_flashdata('berhasil_title', 'Edit Data Berhasil');

            redirect('admin/DataCustomer/C_Data_Customer');
        }
    }
}
