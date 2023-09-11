<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Add_Customer extends CI_Controller
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
        $data['DataPaket']      = $this->M_Paket->DataPaket();
        $data['DataKota']       = $this->M_Kota->DataKota();
        $data['DataKecamatan']  = $this->M_Kecamatan->DataKecamatan();

        $this->load->view('template/DataCustomer/V_Header_Customer', $data);
        $this->load->view('template/V_Sidebar_Admin', $data);
        $this->load->view('admin/DataCustomer/V_Add_Customer', $data);
        $this->load->view('template/DataCustomer/V_Footer_Customer', $data);
    }

    // menampilkan data kecamatan
    public function getKecamatan()
    {
        $id_kota = $this->input->post('id_kota');
        $kecamatan = $this->M_Kecamatan->ListKecamatan($id_kota);

        if (count($kecamatan) > 0) {
            $pro_select_box = '';
            $pro_select_box .= '<option value="" disabled selected>Pilih Kecamatan</option>';

            foreach ($kecamatan as $dataKecamatan) {
                $pro_select_box .= '<option value="' . $dataKecamatan['id_kecamatan'] . '">' . $dataKecamatan['nama_kecamatan'] . '</option>';
            }
            echo json_encode($pro_select_box);
        }
    }

    // menampilkan data kelurahan
    public function getKelurahan()
    {
        $id_kecamatan = $this->input->post('id_kecamatan');
        $kelurahan = $this->M_Kelurahan->ListKelurahan($id_kecamatan);

        if (count($kelurahan) > 0) {
            $pro_select_box = '';
            $pro_select_box .= '<option value="" disabled selected>Pilih Kelurahan</option>';

            foreach ($kelurahan as $dataKelurahan) {
                $pro_select_box .= '<option value="' . $dataKelurahan['id_kelurahan'] . '">' . $dataKelurahan['nama_kelurahan'] . '</option>';
            }
            echo json_encode($pro_select_box);
        }
    }

    public function TambahCustomer()
    {
        // Rules form validation
        $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
        $this->form_validation->set_rules('nik_customer', 'NIK Customer', 'required');
        $this->form_validation->set_rules('tlp_customer', 'Telephon', 'required');
        $this->form_validation->set_rules('alamat_customer', 'Alamat', 'required');
        $this->form_validation->set_rules('date', 'Tanggal Registrasi', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        // mengambil data post pada view
        $nama_customer      = $this->input->post('nama_customer');
        $pembelian_paket    = $this->input->post('pembelian_paket');
        $nik_customer       = $this->input->post('nik_customer');
        $tlp_customer       = $this->input->post('tlp_customer');
        $alamat_customer    = $this->input->post('alamat_customer');
        $kota               = $this->input->post('kota');
        $kecamatan          = $this->input->post('kecamatan');
        $kelurahan          = $this->input->post('kelurahan');
        $date               = $this->input->post('date');

        $dataCustomer = array(
            'pembelian_paket'   => $pembelian_paket,
            'nama_customer'     => $nama_customer,
            'nik_customer'      => $nik_customer,
            'alamat_customer'   => $alamat_customer,
            'date'              => $date,
            'tlp_customer'      => $tlp_customer,
            'id_kota'           => $kota,
            'id_kecamatan'      => $kecamatan,
            'id_kelurahan'      => $kelurahan,
            'tlp_customer'      => $tlp_customer
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('template/DataCustomer/V_Header_Customer');
            $this->load->view('template/V_Sidebar_Admin');
            $this->load->view('admin/DataCustomer/V_Add_Customer');
            $this->load->view('template/DataCustomer/V_Footer_Customer');
        } else {
            $this->M_CRUD->insertData($dataCustomer, 'data_customer');

            $this->session->set_flashdata('berhasil_icon', 'success');
            $this->session->set_flashdata('berhasil_title', 'Tambah Data Berhasil');

            redirect('admin/DataCustomer/C_Data_Customer');
        }
    }
}
