<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Data_Order extends CI_Controller
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

            $data['DataOrder']        = $this->M_DataOrder->DataOrder($tahunGET, $bulanGET);

            // Menyimpan query di dalam data
            $data['bulanGET']           = $bulanGET;
            $data['tahunGET']           = $tahunGET;

            $this->load->view('template/DataPurchase/V_Header_Purchase', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataOrder/V_Data_Order', $data);
            $this->load->view('template/DataPurchase/V_Footer_Purchase', $data);
        } else {
            date_default_timezone_set("Asia/Jakarta");
            $bulan                      = date("m");
            $tahun                      = date("Y");

            // Menyimpan Dalam Session
            $this->session->set_userdata('bulan', $bulan);
            $this->session->set_userdata('tahun', $tahun);

            $data['DataOrder']        = $this->M_DataOrder->DataOrder($tahun, $bulan);

            // Menyimpan query di dalam data
            $data['bulan']           = $bulan;
            $data['tahun']           = $tahun;

            $this->load->view('template/DataPurchase/V_Header_Purchase', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataOrder/V_Data_Order', $data);
            $this->load->view('template/DataPurchase/V_Footer_Purchase', $data);
        }
    }

    public function GetDataAjax()
    {
        if ($this->session->userdata('tahunGET') != NULL && $this->session->userdata('bulanGET') != NULL) {
            $result        = $this->M_DataOrder->DataOrder($this->session->userdata('tahunGET'), $this->session->userdata('bulanGET'));

            $no = 0;

            foreach ($result as $dataOrder) {
                $KeteranganSelesai1 = ['DITERIMA WEREHOUSE'];
                $KeteranganSelesai2 = ['DITERIMA PURCHASE'];
                $KeteranganLama1 = ['DITERIMA'];
                $KeteranganLama2 = ['PURCHASE'];
                $KeteranganRequest = ['REQUEST'];
                $StatusOrder = $dataOrder['nama_status'];
                $row = array();

                $row[] = ++$no;

                if (in_array($StatusOrder, $KeteranganLama1)) {
                    $row[] = '<div><span class="badge bg-info text-white">' . 'DITERIMA' . '<br>' . 'WEREHOUSE' . '</span></div>';
                } elseif (in_array($StatusOrder, $KeteranganLama2)) {
                    $row[] = '<div><span class="badge bg-secondary text-white">' . 'DITERIMA' . '<br>' . 'PURCHASE' . '</span></div>';
                } elseif (in_array($StatusOrder, $KeteranganSelesai1)) {
                    $row[] = '<div><span class="badge bg-info text-white">' . 'DITERIMA' . '<br>' . 'WEREHOUSE' . '</span></div>';
                } elseif (in_array($StatusOrder, $KeteranganSelesai2)) {
                    $row[] = '<div><span class="badge bg-secondary text-white">' . 'DITERIMA' . '<br>' . 'PURCHASE' . '</span></div>';
                } elseif (in_array($StatusOrder, $KeteranganRequest)) {
                    $row[] = '<div><span class="badge bg-warning text-white">' . 'REQUEST' . '<br>' . 'PURCHASE' . '</span></div>';
                } else {
                    $row[] = '<div><span class="badge bg-success text-white">' . 'ORDER' . '<br>' . 'PURCHASE' . '</span></div>';
                }

                $row[] = '<div>' . 'Invoice : ' . $dataOrder['no_purchase_order'] . '<br>' . 'No Pesanan : ' . $dataOrder['no_pesanan'] . '</div>';
                $row[] = $dataOrder['nama_supplier'];
                $row[] = $dataOrder['nama_barang'];
                $row[] = $dataOrder['nama_pegawai'];
                $row[] = $dataOrder['harga_barang'];
                $row[] = changeDateFormat('d-m-Y', $dataOrder['tanggal']);
                $row[] = $dataOrder['jumlah_order'];
                $row[] = $dataOrder['keterangan'];

                $row[] =
                    '<div class="text-center">
                        <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            Option
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a onclick="ACCOrder(' . $dataOrder['id_purchase_order'] . ')"class="dropdown-item text-black"><i class="bi bi-bag-check"></i> Acc Request</a>
                            <a onclick="EditOrder(' . $dataOrder['id_purchase_order'] . ')"class="dropdown-item text-black"><i class="bi bi-pencil-square"></i> Edit Order</a>
                            <a onclick="DoneOrder(' . $dataOrder['id_purchase_order'] . ')"class="dropdown-item text-black"><i class="bi bi-check2-square"></i> Barang Diterima</a>
                            <a onclick="FotoKwitansi(' . $dataOrder['id_purchase_order'] . ')"class="dropdown-item text-black"><i class="bi bi-receipt-cutoff"></i> Foto Kwitansi</a>
                        </div>
                    </div>';

                $data[] = $row;
            }

            $ouput = array(
                'data' => $data
            );

            $this->output->set_content_type('application/json')->set_output(json_encode($ouput));
        } else {
            $result        = $this->M_DataOrder->DataOrder($this->session->userdata('tahun'), $this->session->userdata('bulan'));

            $no = 0;

            foreach ($result as $dataOrder) {
                $KeteranganSelesai1 = ['DITERIMA WEREHOUSE'];
                $KeteranganSelesai2 = ['DITERIMA PURCHASE'];
                $KeteranganLama1 = ['DITERIMA'];
                $KeteranganLama2 = ['PURCHASE'];
                $KeteranganRequest = ['REQUEST'];
                $StatusOrder = $dataOrder['nama_status'];
                $row = array();

                $row[] = ++$no;

                if (in_array($StatusOrder, $KeteranganLama1)) {
                    $row[] = '<div><span class="badge bg-info text-white">' . 'DITERIMA' . '<br>' . 'WEREHOUSE' . '</span></div>';
                } elseif (in_array($StatusOrder, $KeteranganLama2)) {
                    $row[] = '<div><span class="badge bg-secondary text-white">' . 'DITERIMA' . '<br>' . 'PURCHASE' . '</span></div>';
                } elseif (in_array($StatusOrder, $KeteranganSelesai1)) {
                    $row[] = '<div><span class="badge bg-info text-white">' . 'DITERIMA' . '<br>' . 'WEREHOUSE' . '</span></div>';
                } elseif (in_array($StatusOrder, $KeteranganSelesai2)) {
                    $row[] = '<div><span class="badge bg-secondary text-white">' . 'DITERIMA' . '<br>' . 'PURCHASE' . '</span></div>';
                } elseif (in_array($StatusOrder, $KeteranganRequest)) {
                    $row[] = '<div><span class="badge bg-warning text-white">' . 'REQUEST' . '<br>' . 'PURCHASE' . '</span></div>';
                } else {
                    $row[] = '<div><span class="badge bg-success text-white">' . 'ORDER' . '<br>' . 'PURCHASE' . '</span></div>';
                }

                $row[] = '<div>' . 'Invoice : ' . $dataOrder['no_purchase_order'] . '<br>' . 'No Pesanan : ' . $dataOrder['no_pesanan'] . '</div>';
                $row[] = $dataOrder['nama_supplier'];
                $row[] = $dataOrder['nama_barang'];
                $row[] = $dataOrder['nama_pegawai'];
                $row[] = $dataOrder['harga_barang'];
                $row[] = changeDateFormat('d-m-Y', $dataOrder['tanggal']);
                $row[] = $dataOrder['jumlah_order'];
                $row[] = $dataOrder['keterangan'];
                $row[] =
                    '<div class="text-center">
                        <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            Option
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a onclick="ACCOrder(' . $dataOrder['id_purchase_order'] . ')"class="dropdown-item text-black"><i class="bi bi-bag-check"></i> Acc Request</a>
                            <a onclick="EditOrder(' . $dataOrder['id_purchase_order'] . ')"class="dropdown-item text-black"><i class="bi bi-pencil-square"></i> Edit Order</a>
                            <a onclick="DoneOrder(' . $dataOrder['id_purchase_order'] . ')"class="dropdown-item text-black"><i class="bi bi-check2-square"></i> Barang Diterima</a>
                            <a onclick="FotoKwitansi(' . $dataOrder['id_purchase_order'] . ')"class="dropdown-item text-black"><i class="bi bi-receipt-cutoff"></i> Foto Kwitansi</a>
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
}
