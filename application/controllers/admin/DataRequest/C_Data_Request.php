<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

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
                $KeteranganSelesai1 = ['DITERIMA WEREHOUSE'];
                $KeteranganSelesai2 = ['DITERIMA PURCHASE'];
                $KeteranganLama1 = ['DITERIMA'];
                $KeteranganLama2 = ['PURCHASE'];
                $KeteranganRequest = ['REQUEST'];
                $StatusRequest = $dataRequest['nama_status'];
                $row = array();

                $row[] = ++$no;

                if (in_array($StatusRequest, $KeteranganLama1)) {
                    $row[] = '<div><span class="badge bg-success text-white">' . 'DITERIMA' . '<br>' . 'WEREHOUSE' . '</span></div>';
                } elseif (in_array($StatusRequest, $KeteranganLama2)) {
                    $row[] = '<div><span class="badge bg-info text-white">' . 'DITERIMA' . '<br>' . 'PURCHASE' . '</span></div>';
                } elseif (in_array($StatusRequest, $KeteranganSelesai1)) {
                    $row[] = '<div><span class="badge bg-success text-white">' . 'DITERIMA' . '<br>' . 'WEREHOUSE' . '</span></div>';
                } elseif (in_array($StatusRequest, $KeteranganSelesai2)) {
                    $row[] = '<div><span class="badge bg-info text-white">' . 'DITERIMA' . '<br>' . 'PURCHASE' . '</span></div>';
                } elseif (in_array($StatusRequest, $KeteranganRequest)) {
                    $row[] = '<div><span class="badge bg-warning text-white">' . 'REQUEST' . '</span></div>';
                } else {
                    $row[] = '<div><span class="badge bg-danger text-white">' . 'ORDER' . '</span></div>';
                }

                $row[] = '<div>' . 'Invoice : ' . $dataRequest['no_purchase_request'] . '</div>';
                $row[] = $dataRequest['nama_pegawai'];
                $row[] = $dataRequest['nama_barang'];
                $row[] = changeDateFormat('d-m-Y', $dataRequest['tanggal']);
                $row[] = $dataRequest['jumlah_request'];
                $row[] = $dataRequest['keterangan'];
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
                $KeteranganSelesai1 = ['DITERIMA WEREHOUSE'];
                $KeteranganSelesai2 = ['DITERIMA PURCHASE'];
                $KeteranganLama1 = ['DITERIMA'];
                $KeteranganLama2 = ['PURCHASE'];
                $KeteranganRequest = ['REQUEST'];
                $StatusRequest = $dataRequest['nama_status'];
                $row = array();

                $row[] = ++$no;

                if (in_array($StatusRequest, $KeteranganLama1)) {
                    $row[] = '<div><span class="badge bg-success text-white">' . 'DITERIMA' . '<br>' . 'WEREHOUSE' . '</span></div>';
                } elseif (in_array($StatusRequest, $KeteranganLama2)) {
                    $row[] = '<div><span class="badge bg-info text-white">' . 'DITERIMA' . '<br>' . 'PURCHASE' . '</span></div>';
                } elseif (in_array($StatusRequest, $KeteranganSelesai1)) {
                    $row[] = '<div><span class="badge bg-success text-white">' . 'DITERIMA' . '<br>' . 'WEREHOUSE' . '</span></div>';
                } elseif (in_array($StatusRequest, $KeteranganSelesai2)) {
                    $row[] = '<div><span class="badge bg-info text-white">' . 'DITERIMA' . '<br>' . 'PURCHASE' . '</span></div>';
                } elseif (in_array($StatusRequest, $KeteranganRequest)) {
                    $row[] = '<div><span class="badge bg-warning text-white">' . 'REQUEST' . '</span></div>';
                } else {
                    $row[] = '<div><span class="badge bg-danger text-white">' . 'ORDER' . '</span></div>';
                }

                $row[] = '<div>' . 'Invoice : ' . $dataRequest['no_purchase_request'] . '</div>';
                $row[] = $dataRequest['nama_pegawai'];
                $row[] = $dataRequest['nama_barang'];
                $row[] = changeDateFormat('d-m-Y', $dataRequest['tanggal']);
                $row[] = $dataRequest['jumlah_request'];
                $row[] = $dataRequest['keterangan'];
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
