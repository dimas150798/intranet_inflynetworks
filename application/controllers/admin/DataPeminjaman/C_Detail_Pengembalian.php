<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Detail_Pengembalian extends CI_Controller
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
        $CheckFoto      = $this->M_DataPeminjaman->CheckFotoKembali($id_bukti_barang_peminjaman);

        $data['NamaPegawai']        = $CheckFoto->nama_pegawai;
        $data['FotoPeminjaman1']    = $CheckFoto->foto_peminjaman1;
        $data['FotoPeminjaman2']    = $CheckFoto->foto_peminjaman2;
        $data['FotoPengembalian1']  = $CheckFoto->foto_pengembalian1;
        $data['FotoPengembalian2']  = $CheckFoto->foto_pengembalian2;
        $data['TanggalPeminjaman']  = $CheckFoto->tanggal_peminjaman;
        $data['TanggalPengembalian']  = $CheckFoto->tanggal_pengembalian;

        $this->load->view('template/DataPeminjaman/V_Header_Peminjaman', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/DataPeminjaman/V_Detail_Pengembalian', $data);
        $this->load->view('template/DataPeminjaman/V_Footer_Peminjaman', $data);
    }
}
