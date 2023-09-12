<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Foto_Peminjaman extends CI_Controller
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
        if (isset($_GET['day']) && $_GET['day'] != '') {
            $dayGET = $_GET['day'];

            // Menyimpan Dalam Session
            $this->session->set_userdata('dayGET', $dayGET);

            $data['DataPeminjaman']      = $this->M_DataPeminjaman->FotoPeminjaman($dayGET);

            // Menyimpan query di dalam data
            // $data['dayGET']           = $dayGET;

            $this->load->view('template/DataPeminjaman/V_Header_Peminjaman', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataPeminjaman/V_Foto_Peminjaman', $data);
            $this->load->view('template/DataPeminjaman/V_Footer_Peminjaman', $data);
        } else {
            date_default_timezone_set("Asia/Jakarta");
            $day                        = date("Y-m-d");

            // Menyimpan Dalam Session
            $this->session->set_userdata('day', $day);

            $data['DataPeminjaman']      = $this->M_DataPeminjaman->FotoPeminjaman($day);

            // Menyimpan query di dalam data
            // $data['day']           = $day;

            $this->load->view('template/DataPeminjaman/V_Header_Peminjaman', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataPeminjaman/V_Foto_Peminjaman', $data);
            $this->load->view('template/DataPeminjaman/V_Footer_Peminjaman', $data);
        }
    }

    public function GetDataAjax()
    {

        if ($this->session->userdata('dayGET') != '' and $this->session->userdata('dayGET') != NULL) {
            $result = $this->M_DataPeminjaman->FotoPeminjaman($this->session->userdata('dayGET'));

            $no = 0;

            foreach ($result as $dataPeminjaman) {
                $FotoPeminjaman_1 = $dataPeminjaman['foto_peminjaman1'] == NULL;
                $FotoPeminjaman_2 = $dataPeminjaman['foto_peminjaman2'] == NULL;

                $FotoPengembalian_1 = $dataPeminjaman['foto_pengembalian1'] == NULL;
                $FotoPengembalian_2 = $dataPeminjaman['foto_pengembalian2'] == NULL;

                $TanggalPengembalian = $dataPeminjaman['tanggal_pengembalian'] == NULL;

                $row = array();
                $row[] = ++$no;
                $row[] = $dataPeminjaman['nama_pegawai'];
                $row[] = '<div>' . ($FotoPeminjaman_1 ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' :  '<span class="badge bg-success text-white">' . 'DATA ADA' . '</span>') . '</div>';
                $row[] = '<div>' . ($FotoPeminjaman_2 ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' :  '<span class="badge bg-success text-white">' . 'DATA ADA' . '</span>') . '</div>';
                $row[] = '<div>' . ($FotoPengembalian_1 ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' : '<span class="badge bg-success text-white">' . 'DATA ADA' . '</span>') . '</div>';
                $row[] = '<div>' . ($FotoPengembalian_2 ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' :  '<span class="badge bg-success text-white">' . 'DATA ADA' . '</span>') . '</div>';
                $row[] = changeDateFormat('d-m-Y', $dataPeminjaman['tanggal_peminjaman']);
                $row[] = '<div>' . ($TanggalPengembalian ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' :  changeDateFormat('d-m-Y', $dataPeminjaman['tanggal_pengembalian'])) . '</div>';
                $row[] = '<div class="text-center">
                            <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                Option
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a onclick="FotoBarangKembali(' . $dataPeminjaman['id_bukti_barang_peminjaman'] . ')"class="dropdown-item text-black"><i class="bi bi-layer-backward"></i> Foto Pengembalian</a>
                                <a onclick="DetailFotoPeminjaman(' . $dataPeminjaman['id_bukti_barang_peminjaman'] . ')"class="dropdown-item text-black"><i class="bi bi-images"></i> Detail Pengembalian</a>
                            </div>
                        </div>';

                $data[] = $row;
            }

            $ouput = array(
                'data' => $data
            );

            $this->output->set_content_type('application/json')->set_output(json_encode($ouput));
        } else {
            $result = $this->M_DataPeminjaman->FotoPeminjaman($this->session->userdata('day'));

            $no = 0;

            foreach ($result as $dataPeminjaman) {
                $FotoPeminjaman_1 = $dataPeminjaman['foto_peminjaman1'] == NULL;
                $FotoPeminjaman_2 = $dataPeminjaman['foto_peminjaman2'] == NULL;

                $FotoPengembalian_1 = $dataPeminjaman['foto_pengembalian1'] == NULL;
                $FotoPengembalian_2 = $dataPeminjaman['foto_pengembalian2'] == NULL;

                $TanggalPengembalian = $dataPeminjaman['tanggal_pengembalian'] == NULL;

                $row = array();
                $row[] = ++$no;
                $row[] = $dataPeminjaman['nama_pegawai'];
                $row[] = '<div>' . ($FotoPeminjaman_1 ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' :  '<span class="badge bg-success text-white">' . 'DATA ADA' . '</span>') . '</div>';
                $row[] = '<div>' . ($FotoPeminjaman_2 ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' :  '<span class="badge bg-success text-white">' . 'DATA ADA' . '</span>') . '</div>';
                $row[] = '<div>' . ($FotoPengembalian_1 ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' : '<span class="badge bg-success text-white">' . 'DATA ADA' . '</span>') . '</div>';
                $row[] = '<div>' . ($FotoPengembalian_2 ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' :  '<span class="badge bg-success text-white">' . 'DATA ADA' . '</span>') . '</div>';
                $row[] = changeDateFormat('d-m-Y', $dataPeminjaman['tanggal_peminjaman']);
                $row[] = '<div>' . ($TanggalPengembalian ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' :  changeDateFormat('d-m-Y', $dataPeminjaman['tanggal_pengembalian'])) . '</div>';
                $row[] = '<div class="text-center">
                            <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                Option
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a onclick="FotoBarangKembali(' . $dataPeminjaman['id_bukti_barang_peminjaman'] . ')"class="dropdown-item text-black"><i class="bi bi-layer-backward"></i> Barang Kembali</a>
                                <a onclick="DetailFotoPeminjaman(' . $dataPeminjaman['id_bukti_barang_peminjaman'] . ')"class="dropdown-item text-black"><i class="bi bi-images"></i> Detail Pengembalian</a>
                            
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
