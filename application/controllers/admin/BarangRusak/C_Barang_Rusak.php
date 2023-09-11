<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Barang_Rusak extends CI_Controller
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
        $this->load->view('template/DataBarang/V_Header_Barang');
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/BarangRusak/V_Barang_Rusak');
        $this->load->view('template/DataBarang/V_Footer_Barang');
    }

    public function GetDataAjax()
    {
        $result = $this->M_StockRincian->StockRincian();

        $no = 0;

        foreach ($result as $dataBarang) {

            $row = array();
            $row[] = ++$no;
            $row[] = $dataBarang['nama_barang'];
            $row[] = $dataBarang['kode_barang'];
            $row[] = $dataBarang['jumlah'];
            $row[] = changeDateFormat('d-m-Y', $dataBarang['tanggal']);
            $row[] =
                '<div class="text-center">
                    <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        Option
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a onclick="DeleteBarangRusak(' . $dataBarang['id_stockRincian'] . ')"class="dropdown-item text-black"><i class="bi bi-trash3-fill"></i> Hapus</a>
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
