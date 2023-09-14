<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Add_Purchase extends CI_Controller
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

        $data['currentStep'] = $this->getCurrentStep(); // Menggunakan fungsi untuk mendapatkan langkah saat ini

        $this->load->view('template/DataPurchase/V_Header_Purchase', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/DataPurchase/V_Add_Purchase', $data);
        $this->load->view('template/DataPurchase/V_Footer_Purchase', $data);
    }

    private function getCurrentStep()
    {
        // Logic untuk menghitung atau mengambil langkah saat ini
        // Misalnya, Anda bisa menggunakan sesi atau data yang sudah diisi
        return 1; // Gantilah dengan logika Anda
    }

    public function TambahPurchase()
    {
        // mengambil data post pada view

        // Step 1 Form
        $id_pegawai_request     = $this->input->post('id_pegawai_request');
        $id_barang              = $this->input->post('id_barang');
        $tanggal_request        = $this->input->post('tanggal_request');
        $jumlah_request         = $this->input->post('jumlah_request');
        $keterangan             = $this->input->post('keterangan');

        // Step 2 Form
        $id_pegawai_order       = $this->input->post('id_pegawai_order');
        $tanggal_order          = $this->input->post('tanggal_order');
        $foto_order             = $_FILES['foto_order']['name'];
        $nama_supplier          = $this->input->post('nama_supplier');
        $no_pesanan             = $this->input->post('no_pesanan');
        $harga_barang           = $this->input->post('harga_barang');

        // Step 3 Form
        $biaya_ongkir           = $this->input->post('biaya_ongkir');
        $biaya_penanganan       = $this->input->post('biaya_penanganan');
        $biaya_layanan          = $this->input->post('biaya_layanan');
        $biaya_angsuran         = $this->input->post('biaya_angsuran');
        $biaya_lainnya          = $this->input->post('biaya_lainnya');

        $config['upload_path'] = './assets/photo_purchase';
        $config['allowed_types'] = 'jpg|jpeg|png|tiff';
        $this->load->library('upload', $config);

        if (!empty($foto_order) && $this->upload->do_upload('foto_order')) {
            $foto_order = $this->upload->data('file_name');
        } else {
            echo "Photo 1 Gagal diupload";
        }

        $DataRequest = array(
            'jumlah_request'    => $jumlah_request,
            'tanggal'           => $tanggal_request,
            'keterangan'        => $keterangan,
            'id_status'         => 4,
            'id_pegawai'        => $id_pegawai_request,
            'id_barang'         => $id_barang
        );

        $DataOrder = array(
            'jumlah_order'      => $jumlah_request,
            'tanggal'           => $tanggal_order,
            'no_pesanan'        => $no_pesanan,
            'nama_supplier'     => $nama_supplier,
            'harga_barang'      => $harga_barang,
            'keterangan'        => $keterangan,
            'foto_order'        => $foto_order,
            'biaya_ongkir'      => $biaya_ongkir,
            'biaya_penanganan'  => $biaya_penanganan,
            'biaya_layanan'     => $biaya_layanan,
            'biaya_angsuran'    => $biaya_angsuran,
            'biaya_lainnya'     => $biaya_lainnya,
            'id_status'         => 4,
            'id_pegawai_order'  => $id_pegawai_order,
            'id_barang'         => $id_barang
        );

        $this->M_CRUD->insertData($DataRequest, 'data_purchase_request');
        $this->M_CRUD->insertData($DataOrder, 'data_purchase_order');

        $this->session->set_flashdata('berhasil_icon', 'success');
        $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

        redirect('admin/DataRequest/C_Data_Request');
    }
}
