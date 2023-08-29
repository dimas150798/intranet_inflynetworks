<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Lihat_Aktivasi extends CI_Controller
{
    public function LihatAktivasi($id_aktivasi)
    {
        $data['DataAktivasi'] = $this->M_DataAktivasi->CheckAktivasi($id_aktivasi);

        // Mengambil data aktivasi
        $CheckAktivasi = $this->M_DataAktivasi->CheckAktivasi($id_aktivasi);

        // Nama Barang
        $data['NamaCustomer']       = $CheckAktivasi->nama_customer;
        $data['NamaBarang']         = $CheckAktivasi->nama_barang;
        $data['Hitam_UPC_Outdoor']  = $CheckAktivasi->Patch_Core_Hitam_UPC_Outdor;
        $data['Kuning_APC_Hijau']   = $CheckAktivasi->Patch_Core_Hitam_UPC_Outdor;

        $this->load->view('template/V_Header_Admin', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/DataAktivasi/V_Lihat_Aktivasi', $data);
        $this->load->view('template/V_Footer_Admin', $data);
    }

    public function EditPegawaiSave()
    {
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
            'tanggal_masuk'         => date('Y-m-d'),
            'gaji'                  => $gaji,
            // 'photo'                 => $photo
        );
        //update menggunakan id_pegawai
        $id_pegawai = array(
            'id_pegawai'    => $id_pegawai
        );

        $data['DataPegawai'] = $this->M_DataPegawai->EditPegawai($id_pegawai);

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

        if ($this->form_validation->run() == false) {
            $this->load->view('template/V_Header_Admin');
            $this->load->view('template/V_Sidebar_Admin');
            $this->load->view('admin/DataPegawai/V_Edit_Pegawai');
            $this->load->view('template/V_Footer_Admin');
        } else {
            $this->M_CRUD->updateData('data_pegawai', $dataPegawai, $id_pegawai);
            $this->session->set_flashdata('Edit_icon', 'success');
            $this->session->set_flashdata('Edit_title', 'Tambah Data Berhasil');

            redirect('admin/DataPegawai/C_Data_Pegawai');
        }
    }
}
