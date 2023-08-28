<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Data_Customer extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/V_Header_Admin');
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/DataCustomer/V_Data_Customer');
        $this->load->view('template/V_Footer_Admin');
    }

    public function GetDataAjaxCustomer()
    {
        $result = $this->M_DataCustomer->DataCustomer();

        $no = 0;

        foreach ($result as $dataCustomer) {

            $row = array();
            $row[] = ++$no;
            $row[] = $dataCustomer['nama_customer'];
            $row[] = $dataCustomer['alamat_customer'];
            $row[] = $dataCustomer['pembelian_paket'];
            $row[] = $dataCustomer['tlp_customer'];
            $row[] =
                '<div class="text-center">
                    <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        Option
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a onclick="EditDataCustomer(' . $dataCustomer['id_customer'] . ')"class="dropdown-item text-black"><i class="bi bi-pencil-square"></i> Edit</a>
                        <a onclick="DeleteDataCustomer(' . $dataCustomer['id_customer'] . ')"class="dropdown-item text-black"><i class="bi bi-trash3-fill"></i> Hapus</a>
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
