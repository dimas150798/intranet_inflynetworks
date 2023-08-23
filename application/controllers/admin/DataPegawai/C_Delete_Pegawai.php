<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Delete_Pegawai extends CI_Controller
{
    public function DeleteDataPegawai($id_pegawai)
    {
        $where = array('id_pegawai' => $id_pegawai);
        $this->M_DataPegawai->DeletePegawai($where, 'data_pegawai');
        $this->session->set_flashdata('pesan', '<div class="alert alert-susses alert-dismissible fade show" role="alert">
        
        <strong>Data Berhasil Dihapus</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        redirect('admin/DataPegawai/C_Data_Pegawai');
    }
}
