<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Delete_Customer extends CI_Controller
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

    public function DeleteDataCustomer($id_Customer)
    {
        $where = array('id_Customer' => $id_Customer);

        $this->M_CRUD->deleteData($where, 'data_customer');

        $this->session->set_flashdata('berhasil_icon', 'success');
        $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

        redirect('admin/DataCustomer/C_Data_Customer');
    }
}
