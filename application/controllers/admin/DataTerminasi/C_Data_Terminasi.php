<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Data_Terminasi extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/DataCustomer/V_Header_Customer');
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/DataTerminasi/V_Data_Terminasi');
        $this->load->view('template/DataCustomer/V_Footer_Customer');
    }

    public function GetDataAjax()
    {
        $result = $this->M_DataCustomer->DataCustomerTerminasi();

        $no = 0;

        foreach ($result as $dataCustomer) {
            $TanggalTerminasi = $dataCustomer['date_terminasi'] == NULL;

            $row = array();
            $row[] = ++$no;
            $row[] = strtoupper($dataCustomer['nama_customer']);
            $row[] = '<div>' . ($TanggalTerminasi ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' :  changeDateFormat('d-m-Y', $dataCustomer['date_terminasi'])) . '</div>';
            $row[] = $dataCustomer['pembelian_paket'];
            $row[] = $dataCustomer['tlp_customer'];
            $row[] = strtoupper($dataCustomer['alamat_customer']) . ' ' . $dataCustomer['nama_kota'] . ', Kecamatan ' . $dataCustomer['nama_kecamatan'] . ', Kelurahan ' . $dataCustomer['nama_kelurahan'];
            $row[] =
                '<div class="text-center">
                    <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        Option
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a onclick="EditTerminasi(' . $dataCustomer['id_customer'] . ')"class="dropdown-item text-black"><i class="bi bi-pencil-square"></i> Edit</a>
                        <a onclick="DeleteTerminasi(' . $dataCustomer['id_customer'] . ')"class="dropdown-item text-black"><i class="bi bi-trash3-fill"></i> Hapus</a>
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
