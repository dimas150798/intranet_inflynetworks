<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Detail_Aktivasi extends CI_Controller
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

    // Detail Barang Aktivasi
    public function DetailBarangAktivasi($id_stockBarang)
    {
        // Check Barang
        $CheckBarang            = $this->M_StockBarang->CheckStocBarang($id_stockBarang);

        $StockBarang            = $CheckBarang->jumlah_stockBarang;
        $MutasiBarang           = $CheckBarang->jumlah_stockMutasi;

        $TotalSM_Barang         = $StockBarang + $MutasiBarang;

        // Check Jumlah Barang
        $CheckBarangAktivasi    = $this->M_DataAktivasi->JumlahBarangAktivasi($id_stockBarang);

        $data['DataStock']      = $this->M_StockBarang->EditStockBarang($id_stockBarang);
        $data['KeadaanBarang']  = $this->M_DataKeadaanBarang->DataKeadaanBarang();

        if ($CheckBarang->id_barang == 34 or $CheckBarang->id_barang == 35 or $CheckBarang->id_barang == 36) {
            $this->session->set_flashdata('gagal_icon', 'warning');
            $this->session->set_flashdata('gagal_title', 'Detail Barang Tidak Perlu');

            redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
        } else {
            if ($TotalSM_Barang == $CheckBarangAktivasi) {
                $this->session->set_flashdata('gagal_icon', 'warning');
                $this->session->set_flashdata('gagal_title', 'Detail Barang Melebihi Jumlah Stock');

                redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
            } else {
                $this->load->view('template/DataBarang/V_Header_Barang', $data);
                $this->load->view('template/V_Sidebar_Admin', $data);
                $this->load->view('admin/StockBarangAktivasi/V_Detail_Aktivasi', $data);
                $this->load->view('template/DataBarang/V_Footer_Barang', $data);
            }
        }
    }
    // End Detail Barang Aktivasi

    // Tambah Barang Aktivasi
    public function TambahBarangAktivasi()
    {
        // Rules form validation
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal Input', 'required');
        $this->form_validation->set_rules('id_keadaanbarang', 'ID Keadaan', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        // mengambil data post pada view
        $id_stockBarang         = $this->input->post('id_stockBarang');
        $id_keadaanbarang       = $this->input->post('id_keadaanbarang');
        $kode_barang            = $this->input->post('kode_barang');
        $tanggal                = $this->input->post('tanggal');

        // Check Data Aktivasi
        $CheckBarangAktivasi    = $this->M_DataAktivasi->CheckAktivasiStock($kode_barang);

        $DataBarangAktivasi = array(
            'kode_barang'       => $kode_barang,
            'id_stockBarang'    => $id_stockBarang,
            'jumlah_modem'      => 1,
            'tanggal'           => $tanggal,
            'id_status'         => 12,
            'id_keadaanbarang'  => $id_keadaanbarang
        );

        $data['DataStock']      = $this->M_StockBarang->EditStockBarang($id_stockBarang);
        $data['KeadaanBarang']  = $this->M_DataKeadaanBarang->DataKeadaanBarang();

        if ($this->form_validation->run() == false) {
            $this->load->view('template/DataBarang/V_Header_Barang', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/StockBarangAktivasi/V_Detail_Aktivasi', $data);
            $this->load->view('template/DataBarang/V_Footer_Barang', $data);
        } else {
            if ($CheckBarangAktivasi->kode_barang == NULL) {
                $this->M_CRUD->insertData($DataBarangAktivasi, 'data_aktivasi');

                $this->session->set_flashdata('berhasil_icon', 'success');
                $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

                redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
            } else {
                $this->session->set_flashdata('gagal_icon', 'warning');
                $this->session->set_flashdata('gagal_title', 'SN Modem Sudah Terpakai');

                redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
            }
        }
    }
    // End Tambah Barang Aktivasi
}
