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
        $data['Kuning_APC_Hijau']   = $CheckAktivasi->Patch_Core_Kuning_APC_Hijau;
        $data['Kuning_UPC_Biru']    = $CheckAktivasi->Patch_Core_Kuning_UPC_Biru;
        $data['KodeBarang']         = $CheckAktivasi->kode_barang;
        $data['TanggalAktivasi']    = $CheckAktivasi->tanggal;

        if ($CheckAktivasi->nama_customer == NULL or $CheckAktivasi->id_status != 13) {
            $this->session->set_flashdata('gagal_icon', 'success');
            $this->session->set_flashdata('gagal_title', 'Data Tidak Bisa Dilihat');

            redirect('admin/DataAktivasi/C_Data_Aktivasi');
        } else {
            $this->load->view('template/V_Header_Admin', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataAktivasi/V_Lihat_Aktivasi', $data);
            $this->load->view('template/V_Footer_Admin', $data);
        }
    }
}
