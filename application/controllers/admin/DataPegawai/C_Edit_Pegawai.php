<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Edit_Pegawai extends CI_Controller
{
    public function EditPegawai($id_pegawai)
    {
        $data['DataPegawai'] = $this->M_DataPegawai->EditPegawai($id_pegawai);

        $this->load->view('template/DataPegawai/V_Header_Pegawai', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/DataPegawai/V_Edit_Pegawai', $data);
        $this->load->view('template/DataPegawai/V_Footer_Pegawai', $data);
    }

    public function EditPegawaiSave()
    {
        // Rules form validation
        $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('no_telpon', 'Telephone', 'required');
        $this->form_validation->set_rules('alamat_pegawai', 'Alamat', 'required');
        $this->form_validation->set_rules('pendidikan_pegawai', 'Pendidikan', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('gaji', 'Gaji', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        //mengambil data post pada view
        $id_pegawai            = $this->input->post('id_pegawai');
        $nama_pegawai          = $this->input->post('nama_pegawai');
        $nik                   = $this->input->post('nik');
        $no_telpon             = $this->input->post('no_telpon');
        $alamat_pegawai        = $this->input->post('alamat_pegawai');
        $pendidikan_pegawai    = $this->input->post('pendidikan_pegawai');
        $jabatan               = $this->input->post('jabatan');
        $tanggal_masuk         = $this->input->post('tanggal_masuk');
        $gaji                  = $this->input->post('gaji');
        // $photo                 = $_FILES['photo']['name'];

        //menyimpan data pegawai ke dalam array
        $dataPegawai = array(
            'NIK'                   => $nik,
            'nama_pegawai'          => $nama_pegawai,
            'no_telpon'             => $no_telpon,
            'alamat_pegawai'        => $alamat_pegawai,
            'pendidikan_pegawai'    => $pendidikan_pegawai,
            'jabatan'               => $jabatan,
            'tanggal_masuk'         => $tanggal_masuk,
            'gaji'                  => $gaji,
        );

        //update menggunakan id_pegawai
        $id_pegawai = array(
            'id_pegawai'    => $id_pegawai
        );

        $data['DataPegawai'] = $this->M_DataPegawai->EditPegawai($id_pegawai);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/DataPegawai/V_Header_Pegawai');
            $this->load->view('template/DataPegawai/V_Sidebar_Pegawai');
            $this->load->view('admin/DataPegawai/V_Edit_Pegawai');
            $this->load->view('template/DataPegawai/V_Footer_Pegawai');
        } else {
            $this->M_CRUD->updateData('data_pegawai', $dataPegawai, $id_pegawai);
            $this->session->set_flashdata('berhasil_icon', 'success');
            $this->session->set_flashdata('berhasil_title', 'Edit Data Berhasil');

            redirect('admin/DataPegawai/C_Data_Pegawai');
        }
    }
}
