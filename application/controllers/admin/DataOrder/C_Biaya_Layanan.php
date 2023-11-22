<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Biaya_Layanan extends CI_Controller
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
        $this->load->view('template/DataPurchase/V_Header_Purchase');
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/DataOrder/V_Biaya_Layanan');
        $this->load->view('template/DataPurchase/V_Footer_Purchase');
    }

    public function AccSave()
    {
        $id_purchase_order      = $this->input->post('id_purchase_order');
        $biaya_ongkir           = $this->input->post('biaya_ongkir');
        $biaya_penanganan       = $this->input->post('biaya_penanganan');
        $biaya_layanan          = $this->input->post('biaya_layanan');
        $biaya_angsuran         = $this->input->post('biaya_angsuran');
        $biaya_lainnya          = $this->input->post('biaya_lainnya');

        // Update Status Order Purchase
        $DataOrder = array(
            'biaya_ongkir'      => $biaya_ongkir,
            'biaya_penanganan'  => $biaya_penanganan,
            'biaya_layanan'     => $biaya_layanan,
            'biaya_angsuran'    => $biaya_angsuran,
            'biaya_lainnya'     => $biaya_lainnya,
        );

        $IdOrder = array(
            'id_purchase_order' => $id_purchase_order
        );
        // End Update Status Order Purchase

        $this->M_CRUD->updateData('data_purchase_order', $DataOrder, $IdOrder);

        $this->session->set_flashdata('berhasil_icon', 'success');
        $this->session->set_flashdata('berhasil_title', 'Tambah Biaya Berhasil');

        redirect('admin/DataOrder/C_Data_Order');
    }

    public function EditBiayaLayanan()
    {
        $data['DataOrder']      = $this->M_DataOrder->JumlahOrderBiayaAdmin($this->session->userdata('no_purchase_order'));

        $this->load->view('template/DataPurchase/V_Header_Purchase', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/DataOrder/V_Edit_BiayaLayanan', $data);
        $this->load->view('template/DataPurchase/V_Footer_Purchase', $data);
    }

    public function SaveBiayaLayanan()
    {
        $data['DataOrder']      = $this->M_DataOrder->JumlahOrderBiayaAdmin($this->session->userdata('no_purchase_order'));

        $id_purchase_order      = $this->input->post('id_purchase_order');
        $biaya_ongkir           = $this->input->post('biaya_ongkir');
        $biaya_penanganan       = $this->input->post('biaya_penanganan');
        $biaya_layanan          = $this->input->post('biaya_layanan');
        $biaya_angsuran         = $this->input->post('biaya_angsuran');
        $biaya_lainnya          = $this->input->post('biaya_lainnya');

        // Update Status Order Purchase
        $DataOrder = array(
            'biaya_ongkir'      => $biaya_ongkir,
            'biaya_penanganan'  => $biaya_penanganan,
            'biaya_layanan'     => $biaya_layanan,
            'biaya_angsuran'    => $biaya_angsuran,
            'biaya_lainnya'     => $biaya_lainnya,
        );

        $IdOrder = array(
            'id_purchase_order' => $id_purchase_order
        );
        // End Update Status Order Purchase

        $this->M_CRUD->updateData('data_purchase_order', $DataOrder, $IdOrder);

        $this->session->set_flashdata('berhasil_icon', 'success');
        $this->session->set_flashdata('berhasil_title', 'Edit Biaya Berhasil');

        redirect('admin/DataOrder/C_Data_Order');
    }
}
