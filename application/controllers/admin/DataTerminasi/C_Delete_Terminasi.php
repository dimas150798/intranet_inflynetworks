<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Delete_Terminasi extends CI_Controller
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

    public function DeleteTerminasi($id_Customer)
    {
        $dataCustomer = array(
            'date'              => date('Y-m-d'),
            'date_terminasi'    => NULL,
            'id_status'         => NULL
        );

        $IdCustomer = array('id_Customer' => $id_Customer);

        $this->M_CRUD->updateData('data_customer', $dataCustomer, $IdCustomer);

        $this->session->set_flashdata('berhasil_icon', 'success');
        $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

        redirect('admin/DataTerminasi/C_Data_Terminasi');
    }
}
