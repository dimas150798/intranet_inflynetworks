<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Data_Customer extends CI_Controller
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
        $this->load->view('template/DataCustomer/V_Header_Customer');
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/DataCustomer/V_Data_Customer');
        $this->load->view('template/DataCustomer/V_Footer_Customer');
    }

    public function GetDataAjaxCustomer()
    {
        $result = $this->M_DataCustomer->DataCustomer();

        $no = 0;

        foreach ($result as $dataCustomer) {
            $TanggalRegistrasi = $dataCustomer['date'] == NULL;


            $row = array();
            $row[] = ++$no;
            $row[] = strtoupper($dataCustomer['nama_customer']);
            $row[] = '<div>' . ($TanggalRegistrasi ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' :  changeDateFormat('d-m-Y', $dataCustomer['date'])) . '</div>';
            $row[] = $dataCustomer['pembelian_paket'];
            $row[] = $dataCustomer['tlp_customer'];
            $row[] = strtoupper($dataCustomer['alamat_customer']) . ' ' . $dataCustomer['nama_kota'] . ', Kecamatan ' . $dataCustomer['nama_kecamatan'] . ', Kelurahan ' . $dataCustomer['nama_kelurahan'];
            $row[] =
                '<div class="text-center">
                    <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        Option
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a onclick="EditDataCustomer(' . $dataCustomer['id_customer'] . ')"class="dropdown-item text-black"><i class="bi bi-pencil-square"></i> Edit</a>
                        <a onclick="DeleteCustomer(' . $dataCustomer['id_customer'] . ')"class="dropdown-item text-black"><i class="bi bi-trash3-fill"></i> Hapus</a>
                        <a onclick="TerminasiCustomer(' . $dataCustomer['id_customer'] . ')"class="dropdown-item text-black"><i class="bi bi-wifi-off"></i> Terminasi</a>
                    </div>
                </div>';

            $data[] = $row;
        }

        $ouput = array(
            'data' => $data
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($ouput));
    }
}
