<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_AddFoto_Pengembalian extends CI_Controller
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


    public function FotoPengembalian($id_bukti_barang_peminjaman)
    {
        $data['DataPengembalian'] = $this->M_DataPeminjaman->UploadFotoPeminjaman($id_bukti_barang_peminjaman);

        $CheckFoto                = $this->M_DataPeminjaman->CheckFotoKembali($id_bukti_barang_peminjaman);

        if ($CheckFoto->tanggal_pengembalian == NULL) {
            $this->load->view('template/DataPeminjaman/V_Header_Peminjaman', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataPeminjaman/V_AddFoto_Pengembalian', $data);
            $this->load->view('template/DataPeminjaman/V_Footer_Peminjaman', $data);
        } else {
            $this->session->set_flashdata('gagal_icon', 'warning');
            $this->session->set_flashdata('gagal_title', 'Barang Sudah Kembali');

            redirect('admin/DataPeminjaman/C_Foto_Peminjaman');
        }
    }

    public function TambahFotoPeminjaman()
    {
        // mengambil data post pada view
        $id_bukti_barang_peminjaman = $this->input->post('id_bukti_barang_peminjaman');
        $tanggal_pengembalian       = $this->input->post('tanggal_pengembalian');
        $foto_pengembalian1         = $_FILES['foto_pengembalian1']['name'];
        $foto_pengembalian2         = $_FILES['foto_pengembalian2']['name'];

        $config['upload_path']      = './assets/photo_peminjaman';
        $config['allowed_types']    = 'jpg|jpeg|png|tiff';
        $this->load->library('upload', $config);

        if (!empty($foto_pengembalian1) && $this->upload->do_upload('foto_pengembalian1')) {
            $foto_pengembalian1 = $this->upload->data('file_name');
        } else {
            echo "Photo 1 Gagal diupload";
        }

        if (!empty($foto_pengembalian2) && $this->upload->do_upload('foto_pengembalian2')) {
            $foto_pengembalian2 = $this->upload->data('file_name');
        } else {
            echo "Photo 2 Gagal diupload";
        }

        $FotoPeminjaman = array(
            'foto_pengembalian1'    => $foto_pengembalian1,
            'foto_pengembalian2'    => $foto_pengembalian2,
            'tanggal_pengembalian'  => $tanggal_pengembalian
        );

        $IdPengembalian = array(
            'id_bukti_barang_peminjaman'    => $id_bukti_barang_peminjaman
        );

        $this->M_CRUD->updateData('bukti_barang_peminjaman', $FotoPeminjaman, $IdPengembalian);

        $this->session->set_flashdata('berhasil_icon', 'success');
        $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

        redirect('admin/DataPeminjaman/C_Foto_Peminjaman');
    }
}
