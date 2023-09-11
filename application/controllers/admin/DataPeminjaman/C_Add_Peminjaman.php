<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Add_Peminjaman extends CI_Controller
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

    public function index()
    {
        $this->load->view('template/DataPeminjaman/V_Header_Peminjaman');
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/DataPeminjaman/V_Add_Peminjaman');
        $this->load->view('template/DataPeminjaman/V_Footer_Peminjaman');
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

        // mengambil data post pada view
        $nama_pegawai          = $this->input->post('nama_pegawai');
        $nik                   = $this->input->post('nik');
        $no_telpon             = $this->input->post('no_telpon');
        $alamat_pegawai        = $this->input->post('alamat_pegawai');
        $pendidikan_pegawai    = $this->input->post('pendidikan_pegawai');
        $jabatan               = $this->input->post('jabatan');
        $tanggal_masuk         = $this->input->post('tanggal_masuk');
        $gaji                  = $this->input->post('gaji');
        $photo                 = $_FILES['photo']['name'];

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

        // Check Data Pegawai
        $CheckDataPegawai = $this->M_DataPegawai->CheckDataPegawai($nama_pegawai);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/DataPegawai/V_Header_Admin');
            $this->load->view('template/V_Sidebar_Admin');
            $this->load->view('admin/DataPegawai/V_Add_Pegawai');
            $this->load->view('template/DataPegawai/V_Footer_Admin');
        } else {
            if ($nama_pegawai == $CheckDataPegawai->nama_pegawai) {
                $this->session->set_flashdata('gagal_icon', 'warning');
                $this->session->set_flashdata('gagal_title', 'Nama Pegawai Sudah Ada');
                redirect('admin/DataPegawai/C_Add_Pegawai');
            } else {
                $this->M_CRUD->insertData($dataPegawai, 'data_pegawai');

                $this->session->set_flashdata('berhasil_icon', 'success');
                $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

                redirect('admin/DataPegawai/C_Data_Pegawai');
            }
        }
    }
}
