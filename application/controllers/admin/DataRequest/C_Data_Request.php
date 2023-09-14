<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Data_Request extends CI_Controller
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
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulanGET                   = $_GET['bulan'];
            $tahunGET                   = $_GET['tahun'];

            // Menyimpan Dalam Session
            $this->session->set_userdata('bulanGET', $bulanGET);
            $this->session->set_userdata('tahunGET', $tahunGET);

            $data['DataRequest']        = $this->M_DataRequest->DataRequest($tahunGET, $bulanGET);

            // Menyimpan query di dalam data
            $data['bulanGET']           = $bulanGET;
            $data['tahunGET']           = $tahunGET;

            $this->load->view('template/DataPurchase/V_Header_Purchase', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataRequest/V_Data_Request', $data);
            $this->load->view('template/DataPurchase/V_Footer_Purchase', $data);
        } else {
            date_default_timezone_set("Asia/Jakarta");
            $bulan                      = date("m");
            $tahun                      = date("Y");

            // Menyimpan Dalam Session
            $this->session->set_userdata('bulan', $bulan);
            $this->session->set_userdata('tahun', $tahun);

            $data['DataRequest']        = $this->M_DataRequest->DataRequest($tahun, $bulan);

            // Menyimpan query di dalam data
            $data['bulan']           = $bulan;
            $data['tahun']           = $tahun;

            $this->load->view('template/DataPurchase/V_Header_Purchase', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataRequest/V_Data_Request', $data);
            $this->load->view('template/DataPurchase/V_Footer_Purchase', $data);
        }
    }

    public function GetDataAjax()
    {
        if ($this->session->userdata('tahunGET') != NULL && $this->session->userdata('bulanGET') != NULL) {
            $result        = $this->M_DataRequest->DataRequest($this->session->userdata('tahunGET'), $this->session->userdata('bulanGET'));

            $no = 0;

            foreach ($result as $dataRequest) {

                $row = array();
                $row[] = ++$no;
                $row[] = $dataRequest['nama_pegawai'];
                $row[] = $dataRequest['nama_barang'];
                $row[] = $dataRequest['tanggal'];
                $row[] = $dataRequest['jumlah_request'];
                $row[] = $dataRequest['keterangan'];
                $row[] = $dataRequest['id_status'];
                // $row[] =
                //     '<div class="text-center">
                //         <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                //             Option
                //         </a>
                //         <div class="dropdown-menu dropdown-menu-right">
                //             <a onclick="EditdataRequest(' . $dataRequest['id_purchase_request'] . ')"class="dropdown-item text-black"><i class="bi bi-pencil-square"></i> Edit</a>
                //             <a onclick="DeletedataRequest(' . $dataRequest['id_purchase_request'] . ')"class="dropdown-item text-black"><i class="bi bi-trash3-fill"></i> Hapus</a>
                //         </div>
                //     </div>';

                $data[] = $row;
            }

            $ouput = array(
                'data' => $data
            );

            $this->output->set_content_type('application/json')->set_output(json_encode($ouput));
        } else {
            $result        = $this->M_DataRequest->DataRequest($this->session->userdata('tahun'), $this->session->userdata('bulan'));

            $no = 0;

            foreach ($result as $dataRequest) {

                $row = array();
                $row[] = ++$no;
                $row[] = $dataRequest['nama_pegawai'];
                $row[] = $dataRequest['nama_barang'];
                $row[] = $dataRequest['tanggal'];
                $row[] = $dataRequest['jumlah_request'];
                $row[] = $dataRequest['keterangan'];
                $row[] = $dataRequest['id_status'];
                // $row[] =
                //     '<div class="text-center">
                //         <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                //             Option
                //         </a>
                //         <div class="dropdown-menu dropdown-menu-right">
                //             <a onclick="EditdataRequest(' . $dataRequest['id_purchase_request'] . ')"class="dropdown-item text-black"><i class="bi bi-pencil-square"></i> Edit</a>
                //             <a onclick="DeletedataRequest(' . $dataRequest['id_purchase_request'] . ')"class="dropdown-item text-black"><i class="bi bi-trash3-fill"></i> Hapus</a>
                //         </div>
                //     </div>';

                $data[] = $row;
            }

            $ouput = array(
                'data' => $data
            );

            $this->output->set_content_type('application/json')->set_output(json_encode($ouput));
        }
    }
}
