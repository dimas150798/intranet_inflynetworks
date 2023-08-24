<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Delete_Pegawai extends CI_Controller
{
    public function DeleteDataPegawai($id_pegawai)
    {
        $where = array('id_pegawai' => $id_pegawai);
        $this->M_DataPegawai->DeletePegawai($where, 'data_pegawai');
        $this->session->set_flashdata('Delete_icon', 'success');
        $this->session->set_flashdata('Delete_title', 'Hapus Data Berhasil');

        redirect('admin/DataPegawai/C_Data_Pegawai');
    }
}
