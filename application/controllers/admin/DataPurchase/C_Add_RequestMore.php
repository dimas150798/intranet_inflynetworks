<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Add_RequestMore extends CI_Controller
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
        $data['DataBarang']     = $this->M_NamaBarang->NamaBarang();


        $this->load->view('template/DataPurchase/V_Header_Purchase', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/DataPurchase/V_Add_RequestMore', $data);
        $this->load->view('template/DataPurchase/V_Footer_Purchase', $data);
    }

    public function TambahRequest()
    {
        // mengambil data post pada view
        // Step 1 Form
        $id_pegawai_request     = $this->input->post('id_pegawai_request');
        $no_purchase_request    = $this->input->post('no_purchase_request');
        $no_purchase_order      = $this->input->post('no_purchase_order');
        $id_barang              = $this->input->post('id_barang');
        $tanggal_request        = $this->input->post('tanggal_request');
        $jumlah_request         = $this->input->post('jumlah_request');
        $keterangan             = $this->input->post('keterangan');

        $CheckNoRequest         = $this->M_DataRequest->CheckInvoiceRequest($no_purchase_request);

        $DataRequest = array(
            'no_purchase_request'   => $no_purchase_request,
            'jumlah_request'    => $jumlah_request,
            'tanggal'           => $tanggal_request,
            'keterangan'        => $keterangan,
            'id_status'         => 3,
            'id_pegawai'        => $id_pegawai_request,
            'id_barang'         => $id_barang
        );

        $DataRequestDuplicate = array(
            'no_purchase_request'   => $this->M_DataRequest->InvoiceRequest(),
            'jumlah_request'    => $jumlah_request,
            'tanggal'           => $tanggal_request,
            'keterangan'        => $keterangan,
            'id_status'         => 3,
            'id_pegawai'        => $id_pegawai_request,
            'id_barang'         => $id_barang
        );

        $DataOrder = array(
            'no_purchase_request'   => $no_purchase_request,
            'no_purchase_order'   => $no_purchase_order,
            'jumlah_order'      => $jumlah_request,
            'tanggal'           => $tanggal_request,
            'keterangan'        => $keterangan,
            'id_status'         => 3,
            'id_pegawai_order'  => $id_pegawai_request,
            'id_barang'         => $id_barang
        );

        $DataOrderDuplicate = array(
            'no_purchase_request'   => $this->M_DataRequest->InvoiceRequest(),
            'no_purchase_order'   => $this->M_DataOrder->InvoiceOrder(),
            'jumlah_order'      => $jumlah_request,
            'tanggal'           => $tanggal_request,
            'keterangan'        => $keterangan,
            'id_status'         => 3,
            'id_pegawai_order'  => $id_pegawai_request,
            'id_barang'         => $id_barang
        );

        $this->M_CRUD->insertData($DataRequest, 'data_purchase_request');
        $this->M_CRUD->insertData($DataOrder, 'data_purchase_order');

        $this->session->set_flashdata('berhasil_icon', 'success');
        $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

        redirect('admin/DataPurchase/C_Add_RequestMore');

        // if ($CheckNoRequest == NULL) {
        //     $this->M_CRUD->insertData($DataRequest, 'data_purchase_request');
        //     $this->M_CRUD->insertData($DataOrder, 'data_purchase_order');

        //     $this->session->set_flashdata('berhasil_icon', 'success');
        //     $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

        //     redirect('admin/DataPurchase/C_Add_RequestMore');
        // } else {
        //     $this->M_CRUD->insertData($DataRequestDuplicate, 'data_purchase_request');
        //     $this->M_CRUD->insertData($DataOrderDuplicate, 'data_purchase_order');

        //     $this->session->set_flashdata('berhasil_icon', 'success');
        //     $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

        //     redirect('admin/DataPurchase/C_Add_RequestMore');
        // }
    }
}
