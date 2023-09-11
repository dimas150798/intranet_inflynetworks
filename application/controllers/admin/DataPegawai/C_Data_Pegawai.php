<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Data_Pegawai extends CI_Controller
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
        $this->load->view('template/DataPegawai/V_Header_Pegawai');
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/DataPegawai/V_Data_Pegawai');
        $this->load->view('template/DataPegawai/V_Footer_Pegawai');
    }

    public function GetDataAjax()
    {
        $result = $this->M_DataPegawai->DataPegawai();

        $no = 0;

        foreach ($result as $dataPegawai) {

            $row = array();
            $row[] = ++$no;
            $row[] = $dataPegawai['nama_pegawai'];
            $row[] = $dataPegawai['NIK'];
            $row[] = $dataPegawai['no_telpon'];
            $row[] = $dataPegawai['jabatan'];
            $row[] =
                '<div class="text-center">
                    <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        Option
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a onclick="EditDataPegawai(' . $dataPegawai['id_pegawai'] . ')"class="dropdown-item text-black"><i class="bi bi-pencil-square"></i> Edit</a>
                        <a onclick="DeleteDataPegawai(' . $dataPegawai['id_pegawai'] . ')"class="dropdown-item text-black"><i class="bi bi-trash3-fill"></i> Hapus</a>
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
