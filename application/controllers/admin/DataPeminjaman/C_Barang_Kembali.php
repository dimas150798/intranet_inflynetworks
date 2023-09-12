<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Barang_Kembali extends CI_Controller
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

    public function BarangKembali($id_peminjaman_barang)
    {
        $CheckPeminjaman    = $this->M_DataPeminjaman->CheckDataKembali($id_peminjaman_barang);

        $id_stockBarang     = $CheckPeminjaman->id_stockBarang;
        $JumlahPeminjaman   = $CheckPeminjaman->jumlah;
        $JumlahStockBarang  = $CheckPeminjaman->jumlah_stockBarang;
        $JumlahMutasiBarang = $CheckPeminjaman->jumlah_stockMutasi;

        $PenambahanStock   = $JumlahStockBarang + $JumlahPeminjaman;
        $PenguranganMutasi = $JumlahMutasiBarang - $JumlahPeminjaman;

        $DataPeminjaman = array(
            'id_status' => 2
        );

        $IdPeminjaman = array(
            'id_peminjaman_barang'  => $id_peminjaman_barang
        );

        $DataStockBarang = array(
            'jumlah_stockBarang'    => $PenambahanStock,
            'jumlah_stockMutasi'    => $PenguranganMutasi
        );

        $IdStock = array(
            'id_stockBarang'    => $id_stockBarang
        );


        if ($CheckPeminjaman->id_status == 2) {
            $this->session->set_flashdata('gagal_icon', 'warning');
            $this->session->set_flashdata('gagal_title', 'Barang Sudah Dikembalikan');

            redirect('admin/DataPeminjaman/C_Data_Peminjaman');
        } else {
            $this->M_CRUD->updateData('data_peminjaman_barang', $DataPeminjaman, $IdPeminjaman);
            $this->M_CRUD->updateData('data_stockbarang', $DataStockBarang, $IdStock);

            $this->session->set_flashdata('berhasil_icon', 'success');
            $this->session->set_flashdata('berhasil_title', 'Pengembalian Barang Berhasil');

            redirect('admin/DataPeminjaman/C_Data_Peminjaman');
        }
    }
}
