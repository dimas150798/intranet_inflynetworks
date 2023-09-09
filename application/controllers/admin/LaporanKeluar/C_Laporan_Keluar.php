<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}


class C_Laporan_Keluar extends CI_Controller
{
    public function index()
    {
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulanGET                   = $_GET['bulan'];
            $tahunGET                   = $_GET['tahun'];

            // Menyimpan Dalam Session
            $this->session->set_userdata('bulanGET', $bulanGET);
            $this->session->set_userdata('tahunGET', $tahunGET);

            $data['LaporanKeluar']      = $this->M_LaporanKeluar->LaporanKeluarPencarian($bulanGET, $tahunGET);

            // Menyimpan query di dalam data
            $data['bulanGET']           = $bulanGET;
            $data['tahunGET']           = $tahunGET;

            $this->load->view('template/DataLaporan/V_Header_Laporan', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/LaporanKeluar/V_Laporan_Keluar', $data);
            $this->load->view('template/DataLaporan/V_Footer_Laporan', $data);
        } else {
            date_default_timezone_set("Asia/Jakarta");
            $bulan                      = date("m");
            $tahun                      = date("Y");

            // Menyimpan Dalam Session
            $this->session->set_userdata('bulan', $bulan);
            $this->session->set_userdata('tahun', $tahun);

            $data['LaporanKeluar']      = $this->M_LaporanKeluar->LaporanKeluarPencarian($bulan, $tahun);

            // Menyimpan query di dalam data
            $data['bulan']           = $bulan;
            $data['tahun']           = $tahun;

            $this->load->view('template/DataLaporan/V_Header_Laporan', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/LaporanKeluar/V_Laporan_Keluar', $data);
            $this->load->view('template/DataLaporan/V_Footer_Laporan', $data);
        }
    }

    public function GetDataAjax()
    {
        if ($this->session->userdata('tahunGET') != NULL && $this->session->userdata('bulanGET') != NULL) {
            $result = $this->M_LaporanKeluar->LaporanKeluarPencarian($this->session->userdata('bulanGET'), $this->session->userdata('tahunGET'));

            $no = 0;

            foreach ($result as $laporanKeluar) {

                $row = array();
                $row[] = ++$no;
                $row[] = $laporanKeluar['nama_barang'];
                $row[] = $laporanKeluar['kode_barang'];
                $row[] = $laporanKeluar['jumlah'];
                $row[] = changeDateFormat('d-m-Y', $laporanKeluar['tanggal']);
                $row[] = $laporanKeluar['nama_pegawai'];
                $row[] = $laporanKeluar['keterangan'];

                $data[] = $row;
            }

            $ouput = array(
                'data' => $data
            );

            $this->output->set_content_type('application/json')->set_output(json_encode($ouput));
        } else {
            $result = $this->M_LaporanKeluar->LaporanKeluarPencarian($this->session->userdata('bulan'), $this->session->userdata('tahun'));

            $no = 0;

            foreach ($result as $laporanKeluar) {

                $row = array();
                $row[] = ++$no;
                $row[] = $laporanKeluar['nama_barang'];
                $row[] = $laporanKeluar['kode_barang'];
                $row[] = $laporanKeluar['jumlah'];
                $row[] = changeDateFormat('d-m-Y', $laporanKeluar['tanggal']);
                $row[] = $laporanKeluar['nama_pegawai'];
                $row[] = $laporanKeluar['keterangan'];

                $data[] = $row;
            }

            $ouput = array(
                'data' => $data
            );

            $this->output->set_content_type('application/json')->set_output(json_encode($ouput));
        }
    }
}
