<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Delete_CUSTOMER extends CI_Controller
{
    public function DeleteDataCustomer($id_Customer)
    {
        $where = array('id_Customer' => $id_Customer);
        $this->M_DataCustomer->DeleteCustomer($where, 'data_Customer');
        $this->session->set_flashdata('Delete_icon', 'success');
        $this->session->set_flashdata('Delete_title', 'Hapus Data Berhasil');

        redirect('admin/DataCustomer/C_Data_Customer');
    }
}
