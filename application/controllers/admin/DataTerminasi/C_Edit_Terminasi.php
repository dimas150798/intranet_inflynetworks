<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Edit_Terminasi extends CI_Controller
{
    public function EditTerminasi($id_customer)
    {
        $data['DataCustomer']   = $this->M_DataCustomer->EditCustomer($id_customer);
        $data['DataPaket']      = $this->M_Paket->DataPaket();
        $data['DataKota']       = $this->M_Kota->DataKota();
        $data['DataKecamatan']  = $this->M_Kecamatan->DataKecamatan();
        $data['DataKelurahan']  = $this->M_Kelurahan->DataKelurahan();

        $this->load->view('template/DataCustomer/V_Header_Customer', $data);
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/DataTerminasi/V_Edit_Terminasi', $data);
        $this->load->view('template/DataCustomer/V_Footer_Customer', $data);
    }

    public function EditSave()
    {
        // Rules form validation
        $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
        $this->form_validation->set_rules('nik_customer', 'NIK Customer', 'required');
        $this->form_validation->set_rules('tlp_customer', 'Telephon', 'required');
        $this->form_validation->set_rules('alamat_customer', 'Alamat', 'required');
        $this->form_validation->set_rules('date', 'Tanggal Registrasi', 'required');
        $this->form_validation->set_rules('date_terminasi', 'Tanggal Terminasi', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        // mengambil data post pada view
        $id_customer        = $this->input->post('id_customer');
        $nama_customer      = $this->input->post('nama_customer');
        $pembelian_paket    = $this->input->post('pembelian_paket');
        $nik_customer       = $this->input->post('nik_customer');
        $tlp_customer       = $this->input->post('tlp_customer');
        $alamat_customer    = $this->input->post('alamat_customer');
        $kota               = $this->input->post('kota');
        $kecamatan          = $this->input->post('kecamatan');
        $kelurahan          = $this->input->post('kelurahan');
        $date               = $this->input->post('date');
        $date_terminasi     = $this->input->post('date_terminasi');

        $dataCustomer = array(
            'pembelian_paket'   => $pembelian_paket,
            'nama_customer'     => $nama_customer,
            'nik_customer'      => $nik_customer,
            'alamat_customer'   => $alamat_customer,
            'date'              => $date,
            'date_terminasi'    => $date_terminasi,
            'tlp_customer'      => $tlp_customer,
            'id_kota'           => $kota,
            'id_kecamatan'      => $kecamatan,
            'id_kelurahan'      => $kelurahan,
            'tlp_customer'      => $tlp_customer
        );

        //update menggunakan id_customer
        $IdCustomer = array(
            'id_customer'       => $id_customer
        );

        $data['DataCustomer']   = $this->M_DataCustomer->EditCustomer($id_customer);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/DataCustomer/V_Header_Customer');
            $this->load->view('template/V_Sidebar_Admin');
            $this->load->view('admin/DataTerminasi/V_Edit_Terminasi');
            $this->load->view('template/DataCustomer/V_Footer_Customer');
        } else {
            $this->M_CRUD->updateData('data_customer', $dataCustomer, $IdCustomer);
            $this->session->set_flashdata('berhasil_icon', 'success');
            $this->session->set_flashdata('berhasil_title', 'Edit Data Berhasil');

            redirect('admin/DataTerminasi/C_Data_Terminasi');
        }
    }
}
