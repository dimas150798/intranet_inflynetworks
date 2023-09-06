<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Data_Aktivasi extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/DataAktivasi/V_Header_Aktivasi');
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/DataAktivasi/V_Data_Aktivasi');
        $this->load->view('template/DataAktivasi/V_Footer_Aktivasi');
    }

    public function GetDataAjax()
    {
        $result = $this->M_DataAktivasi->DataAktivasi();

        $no = 0;

        foreach ($result as $dataAktivasi) {
            $NamaCustomer = $dataAktivasi['nama_customer'] == NULL;

            $row = array();
            $row[] = ++$no;
            $row[] = '<div>' . ($NamaCustomer ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' :  strtoupper($dataAktivasi['nama_customer'])) . '</div>';
            $row[] = $dataAktivasi['nama_barang'];
            $row[] = $dataAktivasi['kode_barang'];
            $row[] = changeDateFormat('d-m-Y', $dataAktivasi['tanggal']);
            $row[] = '<div class="text-center">' . '<span class="badge bg-success text-white">' . $dataAktivasi['nama_status']  . '</span>' . '</div>';

            $row[] =
                '<div class="text-center">
                    <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        Option
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a onclick="LihatAktivasi(' . $dataAktivasi['id_aktivasi'] . ')"class="dropdown-item text-black"><i class="bi bi-eye-fill"></i> Lihat Data</a>
                        <a onclick="EditAktivasi(' . $dataAktivasi['id_aktivasi'] . ')"class="dropdown-item text-black"><i class="bi bi-pencil-square"></i> Edit</a>
                        <a onclick="DeleteAktivasi(' . $dataAktivasi['id_aktivasi'] . ')"class="dropdown-item text-black"><i class="bi bi-trash3-fill"></i> Hapus</a>
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
