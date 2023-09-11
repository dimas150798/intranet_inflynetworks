<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Edit_Barang extends CI_Controller
{
    public function EditBarang($id_barang)
    {
        $data['DataBarang']     = $this->M_NamaBarang->EditBarang($id_barang);
        $data['DataSatuan']      = $this->M_DataSatuan->DataSatuan();
        $data['DataPeralatan']   = $this->M_DataPeralatan->DataPeralatan();

        $this->load->view('template/DataBarang/V_Header_Barang', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/NamaBarang/V_Edit_Barang', $data);
        $this->load->view('template/DataBarang/V_Footer_Barang', $data);
    }

    public function EditSave()
    {
        // Rules form validation
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        // mengambil data post pada view
        $id_barang          = $this->input->post('id_barang');
        $nama_barang        = $this->input->post('nama_barang');
        $id_satuan          = $this->input->post('id_satuan');
        $id_peralatan       = $this->input->post('id_peralatan');

        $DataNamaBarang = array(
            'nama_barang'       => $nama_barang,
            'id_satuan'         => $id_satuan,
            'id_peralatan'      => $id_peralatan
        );

        //update menggunakan id_barang
        $IdBarang = array(
            'id_barang'       => $id_barang
        );

        $data['DataBarang']     = $this->M_NamaBarang->EditBarang($id_barang);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/DataBarang/V_Header_Barang');
            $this->load->view('template/V_Sidebar_Admin');
            $this->load->view('admin/NamaBarang/V_Add_Barang');
            $this->load->view('template/DataBarang/V_Footer_Barang');
        } else {
            $this->M_CRUD->updateData('data_namabarang', $DataNamaBarang, $IdBarang);
            $this->session->set_flashdata('berhasil_icon', 'success');
            $this->session->set_flashdata('berhasil_title', 'Edit Data Berhasil');

            redirect('admin/NamaBarang/C_Nama_Barang');
        }
    }
}