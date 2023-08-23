<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Add_Pegawai extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/V_Header_Admin');
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/DataPelanggan/V_Add_Pegawai');
        $this->load->view('template/V_Footer_Admin');
    }

    public function TambahPegawai()
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



        if ($this->form_validation->run() == false) {
            $this->load->view('template/V_Header_Admin');
            $this->load->view('template/V_Sidebar_Admin');
            $this->load->view('admin/DataPelanggan/V_Add_Pegawai');
            $this->load->view('template/V_Footer_Admin');
        } else {
            // mengambil data post pada view
            $nama_pegawai          = $this->input->post('nama_pegawai');
            $nik                   = $this->input->post('nik');
            $no_telpon             = $this->input->post('no_telpon');
            $alamat_pegawai        = $this->input->post('alamat_pegawai');
            $pendidikan_pegawai    = $this->input->post('pendidikan_pegawai');
            $jabatan               = $this->input->post('jabatan');
            $tanggal_masuk         = $this->input->post('tanggal_masuk');
            $gaji                  = $this->input->post('gaji');
            $photo                  = $_FILES['photo']['name'];

            $dataPegawai = array(
                'NIK'                   => $nik,
                'nama_pegawai'          => $nama_pegawai,
                'no_telpon'             => $no_telpon,
                'alamat_pegawai'        => $alamat_pegawai,
                'pendidikan_pegawai'    => $pendidikan_pegawai,
                'jabatan'               => $jabatan,
                'tanggal_masuk'         => $tanggal_masuk,
                'gaji'                  => $gaji,
                'photo'                 => $photo
            );

            if ($photo = '') {
            } else {
                $config['upload_path']    = './assets/photo';
                $config['allowed_types']   = 'jpg|jpeg|png|tiff';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo')) {
                    echo "Photo Gagal diupload";
                } else {
                    $photo = $this->upload->data('file_name');
                }
            }

            $this->M_CRUD->insertData($dataPegawai, 'data_pegawai');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>UPDATE DATA BERHASIL</strong>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>');
            redirect('admin/DataPegawai/C_Data_Pegawai');
        }
    }
}
