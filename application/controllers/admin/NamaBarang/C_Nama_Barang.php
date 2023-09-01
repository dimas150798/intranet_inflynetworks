<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Nama_Barang extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/DataBarang/V_Header_Barang');
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/NamaBarang/V_Nama_Barang');
        $this->load->view('template/DataBarang/V_Footer_Barang');
    }

    public function GetDataAjax()
    {
        $result = $this->M_NamaBarang->NamaBarang();

        $no = 0;

        foreach ($result as $dataBarang) {

            $row = array();
            $row[] = ++$no;
            $row[] = strtoupper($dataBarang['nama_barang']);
            $row[] = $dataBarang['kategori_peralatan'];
            $row[] = strtoupper($dataBarang['nama_satuan']);
            $row[] =
                '<div class="text-center">
                    <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        Option
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a onclick="EditNamaBarang(' . $dataBarang['id_barang'] . ')"class="dropdown-item text-black"><i class="bi bi-pencil-square"></i> Edit</a>
                        <a onclick="DeleteNamaBarang(' . $dataBarang['id_barang'] . ')"class="dropdown-item text-black"><i class="bi bi-trash3-fill"></i> Hapus</a>
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
