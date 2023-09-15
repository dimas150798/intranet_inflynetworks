<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Acc_RequestMore extends CI_Controller
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
        $CheckACC                   = $this->M_DataOrder->CheckACC_Order($this->session->userdata('no_purchase_order'));

        $data['id_purchase_order']  = $CheckACC->id_purchase_order;
        $data['no_purchase_order']  = $CheckACC->no_purchase_order;
        $data['no_purchase_request']  = $CheckACC->no_purchase_request;
        $data['id_stockBarang']     = $CheckACC->id_stockBarang;
        $data['id_barang']          = $CheckACC->id_barang;
        $data['nama_barang']        = $CheckACC->nama_barang;
        $data['tanggal']            = $CheckACC->tanggal;
        $data['nama_supplier']      = $CheckACC->nama_supplier;
        $data['no_pesanan']         = $CheckACC->no_pesanan;

        $this->load->view('template/DataPurchase/V_Header_Purchase', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/DataOrder/V_Acc_RequestMore', $data);
        $this->load->view('template/DataPurchase/V_Footer_Purchase', $data);
    }

    public function AccSave()
    {
        $id_purchase_order      = $this->input->post('id_purchase_order');
        $no_purchase_order      = $this->input->post('no_purchase_order');
        $no_purchase_request    = $this->input->post('no_purchase_request');
        $id_stockBarang         = $this->input->post('id_stockBarang');
        $id_barang              = $this->input->post('id_barang');

        // Step 2 Form
        $id_pegawai_order       = $this->input->post('id_pegawai_order');
        $tanggal_order          = $this->input->post('tanggal_order');
        $nama_supplier          = $this->input->post('nama_supplier');
        $no_pesanan             = $this->input->post('no_pesanan');
        $harga_barang           = $this->input->post('harga_barang');

        // Step 3 Form
        $biaya_ongkir           = $this->input->post('biaya_ongkir');
        $biaya_penanganan       = $this->input->post('biaya_penanganan');
        $biaya_layanan          = $this->input->post('biaya_layanan');
        $biaya_angsuran         = $this->input->post('biaya_angsuran');
        $biaya_lainnya          = $this->input->post('biaya_lainnya');

        // Mengambil data request untuk update id_status
        $CheckACC_Request       = $this->M_DataRequest->CheckACCRequest($no_purchase_request, $id_barang);

        // Check Jumlah Order Barang
        $JumlahOrder            = $this->M_DataOrder->JumlahOrder($no_purchase_order);

        // Check Nama Pegawai Order
        $CheckNamaPegawai       = $this->M_DataPegawai->CheckIDPegawai($id_pegawai_order);

        // Menyimpan Dalam Session
        $this->session->set_userdata('nama_supplier', $nama_supplier);
        $this->session->set_userdata('no_pesanan', $no_pesanan);
        $this->session->set_userdata('no_purchase_order', $no_purchase_order);
        $this->session->set_userdata('id_purchase_order', $id_purchase_order);
        $this->session->set_userdata('id_pegawai_order', $id_pegawai_order);
        $this->session->set_userdata('tanggal_order', $tanggal_order);
        $this->session->set_userdata('nama_pegawai', $CheckNamaPegawai->nama_pegawai);

        // Update Status Request Purchase
        $DataRequest = array(
            'id_status'         => 4
        );
        $IdRequest = array(
            'id_purchase_request ' => $CheckACC_Request->id_purchase_request
        );
        // End Update Status Request Purchase

        // Update Status Order Purchase
        $DataOrder = array(
            'tanggal'           => $tanggal_order,
            'no_pesanan'        => $no_pesanan,
            'nama_supplier'     => $nama_supplier,
            'harga_barang'      => $harga_barang,
            'id_status'         => 4,
            'id_pegawai_order'  => $id_pegawai_order,
            'id_barang'         => $id_barang
        );
        $IdOrder = array(
            'id_purchase_order' => $id_purchase_order
        );
        // End Update Status Order Purchase

        if ($JumlahOrder == 1) {
            $this->M_CRUD->updateData('data_purchase_request', $DataRequest, $IdRequest);
            $this->M_CRUD->updateData('data_purchase_order', $DataOrder, $IdOrder);

            $this->session->set_flashdata('berhasil_icon', 'success');
            $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

            redirect('admin/DataOrder/C_Biaya_Layanan');
        } else {
            $this->M_CRUD->updateData('data_purchase_request', $DataRequest, $IdRequest);
            $this->M_CRUD->updateData('data_purchase_order', $DataOrder, $IdOrder);

            $this->session->set_flashdata('berhasil_icon', 'success');
            $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

            redirect('admin/DataOrder/C_Acc_RequestMore');
        }
    }
}
