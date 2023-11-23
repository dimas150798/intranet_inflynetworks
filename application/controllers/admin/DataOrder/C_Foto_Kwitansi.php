<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Foto_Kwitansi extends CI_Controller
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

    public function ShowKwitansi($id_purchase_order)
    {
        $CheckOrder             = $this->M_DataOrder->CheckOrder($id_purchase_order);

        $no_purchase_order      = $CheckOrder->no_purchase_order;

        // Check Kwitansi Data Array
        $data['DataKwitansi']   = $this->M_DataOrder->CheckKwitansi($no_purchase_order);

        // Check Kwitansi Not Array
        $CheckKwitansiFoto      = $this->M_DataOrder->CheckNota_Kwitansi($no_purchase_order);
        $foto_order             = $CheckKwitansiFoto->foto_order;

        if ($foto_order == NULL && $foto_order == '') {
            $this->session->set_flashdata('gagal_icon', 'warning');
            $this->session->set_flashdata('gagal_title', 'Nota Kwitansi Tidak Ada');

            redirect('admin/DataOrder/C_Data_Order');
        } else {
            $this->load->view('template/DataPurchase/V_Header_Purchase', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataOrder/V_Foto_Kwitansi', $data);
            $this->load->view('template/DataPurchase/V_Footer_Purchase', $data);
        }
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
