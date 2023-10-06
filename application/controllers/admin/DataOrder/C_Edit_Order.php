<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Edit_Order extends CI_Controller
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

    public function EditOrder($id_purchase_order)
    {
        $data['DoneOrder']      = $this->M_DataOrder->DoneOrder($id_purchase_order);
        $data['DataPegawai']    = $this->M_DataPegawai->DataPegawai();

        $CheckACC               = $this->M_DataOrder->CheckOrder($id_purchase_order);

        if ($CheckACC->id_status == 4) {
            $this->load->view('template/DataPurchase/V_Header_Purchase', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataOrder/V_Edit_Order', $data);
            $this->load->view('template/DataPurchase/V_Footer_Purchase', $data);
        } else {
            $this->session->set_flashdata('gagal_icon', 'warning');
            $this->session->set_flashdata('gagal_title', 'Data Yang Sudah Diorder Yang Bisa Diedit');

            redirect('admin/DataOrder/C_Data_Order');
        }
    }

    public function OrderSave()
    {
        $id_purchase_order      = $this->input->post('id_purchase_order');
        $no_purchase_order      = $this->input->post('no_purchase_order');
        $no_purchase_request    = $this->input->post('no_purchase_request');
        $id_stockBarang         = $this->input->post('id_stockBarang');
        $id_barang              = $this->input->post('id_barang');

        // Step 2 Form
        $no_pesanan             = $this->input->post('no_pesanan');
        $nama_supplier          = $this->input->post('nama_supplier');
        $tanggal_order          = $this->input->post('tanggal_order');
        $harga_barang           = $this->input->post('harga_barang');
        $keterangan             = $this->input->post('keterangan');

        // Menyimpan Dalam Session
        $this->session->set_userdata('no_pesanan', $no_pesanan);
        $this->session->set_userdata('nama_supplier', $nama_supplier);
        $this->session->set_userdata('tanggal_order', $tanggal_order);
        $this->session->set_userdata('harga_barang', $harga_barang);
        $this->session->set_userdata('keterangan', $keterangan);

        // Update Status Request Purchase
        $DataRequest = array(
            'keterangan'        => $keterangan
        );

        $IdRequest = array(
            'no_purchase_request' => $no_purchase_request
        );
        // End Update Status Request Purchase

        // Update Status Order Purchase
        $OrderWithPurchaseOrder = array(
            'no_pesanan'        => $no_pesanan,
            'nama_supplier'     => $nama_supplier,
            'tanggal'           => $tanggal_order,
            'keterangan'        => $keterangan
        );

        $NoPurchaseOrder = array(
            'no_purchase_order' => $no_purchase_order
        );

        $DataOrder = array(
            'harga_barang'      => $harga_barang
        );

        $IdOrder = array(
            'id_purchase_order' => $id_purchase_order
        );
        // End Update Status Order Purchase

        $this->M_CRUD->updateData('data_purchase_request', $DataRequest, $IdRequest);
        $this->M_CRUD->updateData('data_purchase_order', $DataOrder, $IdOrder);
        $this->M_CRUD->updateData('data_purchase_order', $OrderWithPurchaseOrder, $NoPurchaseOrder);

        redirect('admin/DataOrder/C_Data_Order');
    }
}
