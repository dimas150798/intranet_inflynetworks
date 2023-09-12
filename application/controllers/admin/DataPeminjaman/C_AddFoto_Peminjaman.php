<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_AddFoto_Peminjaman extends CI_Controller
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
        $data['StockBarang']    = $this->M_StockBarang->StockBarang();
        $data['DataPegawai']    = $this->M_DataPegawai->DataPegawai();

        $this->load->view('template/DataPeminjaman/V_Header_Peminjaman', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/DataPeminjaman/V_AddFoto_Peminjaman', $data);
        $this->load->view('template/DataPeminjaman/V_Footer_Peminjaman', $data);
    }

    public function TambahFotoPeminjaman()
    {
        // mengambil data post pada view
        $id_pegawai         = $this->input->post('id_pegawai');
        $tanggal_peminjaman = $this->input->post('tanggal_peminjaman');
        $foto_peminjaman1   = $_FILES['foto_peminjaman1']['name'];
        $foto_peminjaman2   = $_FILES['foto_peminjaman2']['name'];

        $config['upload_path'] = './assets/photo_peminjaman';
        $config['allowed_types'] = 'jpg|jpeg|png|tiff';
        $this->load->library('upload', $config);

        if (!empty($foto_peminjaman1) && $this->upload->do_upload('foto_peminjaman1')) {
            $foto_peminjaman1 = $this->upload->data('file_name');
        } else {
            echo "Photo 1 Gagal diupload";
        }

        if (!empty($foto_peminjaman2) && $this->upload->do_upload('foto_peminjaman2')) {
            $foto_peminjaman2 = $this->upload->data('file_name');
        } else {
            echo "Photo 2 Gagal diupload";
        }

        $FotoPeminjaman = array(
            'id_pegawai'            => $id_pegawai,
            'foto_peminjaman1'      => $foto_peminjaman1,
            'foto_peminjaman2'      => $foto_peminjaman2,
            'tanggal_peminjaman'    => $tanggal_peminjaman
        );

        $this->M_CRUD->insertData($FotoPeminjaman, 'bukti_barang_peminjaman');

        $this->session->set_flashdata('berhasil_icon', 'success');
        $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

        redirect('admin/DataPeminjaman/C_Foto_Peminjaman');
    }
}
