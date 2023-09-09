<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}


class C_Laporan_Masuk extends CI_Controller
{
    public function index()
    {
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulanGET                   = $_GET['bulan'];
            $tahunGET                   = $_GET['tahun'];

            // Menyimpan Dalam Session
            $this->session->set_userdata('bulanGET', $bulanGET);
            $this->session->set_userdata('tahunGET', $tahunGET);

            $data['LaporanMasuk']      = $this->M_LaporanMasuk->LaporanMasukPencarian($bulanGET, $tahunGET);

            // Menyimpan query di dalam data
            $data['bulanGET']           = $bulanGET;
            $data['tahunGET']           = $tahunGET;

            $this->load->view('template/DataLaporan/V_Header_Laporan', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/LaporanMasuk/V_Laporan_Masuk', $data);
            $this->load->view('template/DataLaporan/V_Footer_Laporan', $data);
        } else {
            date_default_timezone_set("Asia/Jakarta");
            $bulan                      = date("m");
            $tahun                      = date("Y");

            // Menyimpan Dalam Session
            $this->session->set_userdata('bulan', $bulan);
            $this->session->set_userdata('tahun', $tahun);

            $data['LaporanMasuk']      = $this->M_LaporanMasuk->LaporanMasukPencarian($bulan, $tahun);

            // Menyimpan query di dalam data
            $data['bulan']           = $bulan;
            $data['tahun']           = $tahun;

            $this->load->view('template/DataLaporan/V_Header_Laporan', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/LaporanMasuk/V_Laporan_Masuk', $data);
            $this->load->view('template/DataLaporan/V_Footer_Laporan', $data);
        }
    }

    public function GetDataAjax()
    {
        if ($this->session->userdata('tahunGET') != NULL && $this->session->userdata('bulanGET') != NULL) {
            $result = $this->M_LaporanMasuk->LaporanMasukPencarian($this->session->userdata('bulanGET'), $this->session->userdata('tahunGET'));

            $no = 0;

            foreach ($result as $laporanMasuk) {

                $row = array();
                $row[] = ++$no;
                $row[] = $laporanMasuk['nama_barang'];
                $row[] = $laporanMasuk['kode_barang'];
                $row[] = $laporanMasuk['jumlah'];
                $row[] = changeDateFormat('d-m-Y', $laporanMasuk['tanggal']);
                $row[] = $laporanMasuk['nama_pegawai'];
                $row[] = $laporanMasuk['keterangan'];

                $data[] = $row;
            }

            $ouput = array(
                'data' => $data
            );

            $this->output->set_content_type('application/json')->set_output(json_encode($ouput));
        } else {
            $result = $this->M_LaporanMasuk->LaporanMasukPencarian($this->session->userdata('bulan'), $this->session->userdata('tahun'));

            $no = 0;

            foreach ($result as $laporanMasuk) {

                $row = array();
                $row[] = ++$no;
                $row[] = $laporanMasuk['nama_barang'];
                $row[] = $laporanMasuk['kode_barang'];
                $row[] = $laporanMasuk['jumlah'];
                $row[] = changeDateFormat('d-m-Y', $laporanMasuk['tanggal']);
                $row[] = $laporanMasuk['nama_pegawai'];
                $row[] = $laporanMasuk['keterangan'];

                $data[] = $row;
            }

            $ouput = array(
                'data' => $data
            );

            $this->output->set_content_type('application/json')->set_output(json_encode($ouput));
        }
    }
}
