<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Edit_Aktivasi extends CI_Controller
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

    public function EditAktivasi($id_aktivasi)
    {
        $data['DataAktivasi']   = $this->M_DataAktivasi->EditAktivasi($id_aktivasi);

        $this->load->view('template/DataAktivasi/V_Header_Aktivasi', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/DataAktivasi/V_Edit_Aktivasi', $data);
        $this->load->view('template/DataAktivasi/V_Footer_Aktivasi', $data);
    }

    public function EditSave()
    {
        // Rules form validation
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        // mengambil data post pada view
        $id_aktivasi        = $this->input->post('id_aktivasi');
        $kode_barang        = $this->input->post('kode_barang');

        $dataAktivasi = array(
            'kode_barang'   => $kode_barang,
        );

        //update menggunakan id_aktivasi
        $IdAktivasi = array(
            'id_aktivasi'       => $id_aktivasi
        );

        $data['DataAktivasi']   = $this->M_DataAktivasi->EditAktivasi($id_aktivasi);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/DataCustomer/V_Header_Customer', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataCustomer/V_Edit_Customer', $data);
            $this->load->view('template/DataCustomer/V_Footer_Customer', $data);
        } else {
            $this->M_CRUD->updateData('data_aktivasi', $dataAktivasi, $IdAktivasi);
            $this->session->set_flashdata('berhasil_icon', 'success');
            $this->session->set_flashdata('berhasil_title', 'Edit Data Berhasil');

            redirect('admin/DataAktivasi/C_Data_Aktivasi');
        }
    }
}
