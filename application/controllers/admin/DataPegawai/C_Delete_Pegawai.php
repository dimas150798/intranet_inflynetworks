<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Delete_Pegawai extends CI_Controller
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

    public function DeleteDataPegawai($id_pegawai)
    {
        $where = array('id_pegawai' => $id_pegawai);

        $this->M_CRUD->deleteData($where, 'data_pegawai');

        $this->session->set_flashdata('berhasil_icon', 'success');
        $this->session->set_flashdata('berhasil_title', 'Hapus Data Berhasil');

        redirect('admin/DataPegawai/C_Data_Pegawai');
    }
}
