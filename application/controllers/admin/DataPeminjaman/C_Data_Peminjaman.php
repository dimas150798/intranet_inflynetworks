<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Data_Peminjaman extends CI_Controller
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
        if ((isset($_GET['day']) && $_GET['day'] != '')) {
            $dayGET                 = $_GET['day'];

            // Menyimpan Dalam Session
            $this->session->set_userdata('dayGET', $dayGET);

            $data['DataPeminjaman']      = $this->M_DataPeminjaman->DataPeminjaman($dayGET);

            // Menyimpan query di dalam data
            $data['dayGET']           = $dayGET;

            $this->load->view('template/DataPeminjaman/V_Header_Peminjaman', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataPeminjaman/V_Data_Peminjaman', $data);
            $this->load->view('template/DataPeminjaman/V_Footer_Peminjaman', $data);
        } else {
            date_default_timezone_set("Asia/Jakarta");
            $day                        = date("Y-m-d");

            // Menyimpan Dalam Session
            $this->session->set_userdata('day', $day);

            $data['DataPeminjaman']      = $this->M_DataPeminjaman->DataPeminjaman($day);

            // Menyimpan query di dalam data
            $data['day']           = $day;

            $this->load->view('template/DataPeminjaman/V_Header_Peminjaman', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataPeminjaman/V_Data_Peminjaman', $data);
            $this->load->view('template/DataPeminjaman/V_Footer_Peminjaman', $data);
        }
    }

    public function GetDataAjax()
    {
        if ($this->session->userdata('dayGET') != '') {
            $result = $this->M_DataPeminjaman->DataPeminjaman($this->session->userdata('dayGET'));

            $no = 0;

            foreach ($result as $dataPeminjaman) {
                $NamaStatus = $dataPeminjaman['nama_status'] == 'PENDING';

                $row = array();
                $row[] = ++$no;
                $row[] = $dataPeminjaman['nama_barang'];
                $row[] = $dataPeminjaman['nama_pegawai'];
                $row[] = changeDateFormat('d-m-Y', $dataPeminjaman['tanggal']);
                $row[] = $dataPeminjaman['jumlah'];
                $row[] = $dataPeminjaman['keterangan'];
                $row[] = '<div>' . ($NamaStatus ? '<span class="badge bg-danger text-white">' . $dataPeminjaman['nama_status'] . '</span>' : '<span class="badge bg-success text-white">' . $dataPeminjaman['nama_status'] . '</span>') . '</div>';
                $row[] =
                    '<div class="text-center">
                <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    Option
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a onclick="EditDataCustomer(' . $dataPeminjaman['id_peminjaman_barang'] . ')"class="dropdown-item text-black"><i class="bi bi-pencil-square"></i> Edit</a>
                    <a onclick="DeleteCustomer(' . $dataPeminjaman['id_peminjaman_barang'] . ')"class="dropdown-item text-black"><i class="bi bi-trash3-fill"></i> Hapus</a>
                    <a onclick="TerminasiCustomer(' . $dataPeminjaman['id_peminjaman_barang'] . ')"class="dropdown-item text-black"><i class="bi bi-wifi-off"></i> Terminasi</a>
                </div>
            </div>';

                $data[] = $row;
            }

            $ouput = array(
                'data' => $data
            );

            $this->output->set_content_type('application/json')->set_output(json_encode($ouput));
        } else {
            $result = $this->M_DataPeminjaman->DataPeminjaman($this->session->userdata('day'));

            $no = 0;

            foreach ($result as $dataPeminjaman) {
                $NamaStatus = $dataPeminjaman['nama_status'] == 'PENDING';

                $row = array();
                $row[] = ++$no;
                $row[] = $dataPeminjaman['nama_barang'];
                $row[] = $dataPeminjaman['nama_pegawai'];
                $row[] = changeDateFormat('d-m-Y', $dataPeminjaman['tanggal']);
                $row[] = $dataPeminjaman['jumlah'];
                $row[] = $dataPeminjaman['keterangan'];
                $row[] = '<div>' . ($NamaStatus ? '<span class="badge bg-danger text-white">' . $dataPeminjaman['nama_status'] . '</span>' : '<span class="badge bg-success text-white">' . $dataPeminjaman['nama_status'] . '</span>') . '</div>';
                $row[] =
                    '<div class="text-center">
                <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    Option
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a onclick="EditDataCustomer(' . $dataPeminjaman['id_peminjaman_barang'] . ')"class="dropdown-item text-black"><i class="bi bi-pencil-square"></i> Edit</a>
                    <a onclick="DeleteCustomer(' . $dataPeminjaman['id_peminjaman_barang'] . ')"class="dropdown-item text-black"><i class="bi bi-trash3-fill"></i> Hapus</a>
                    <a onclick="TerminasiCustomer(' . $dataPeminjaman['id_peminjaman_barang'] . ')"class="dropdown-item text-black"><i class="bi bi-wifi-off"></i> Terminasi</a>
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
