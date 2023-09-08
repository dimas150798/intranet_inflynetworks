<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Barang_Aktivasi extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/DataBarang/V_Header_Barang');
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/StockBarangAktivasi/V_Barang_Aktivasi');
        $this->load->view('template/DataBarang/V_Footer_Barang');
    }

    public function GetDataAjax()
    {
        $result = $this->M_StockBarang->StockBarangAktivasi();

        $no = 0;

        foreach ($result as $dataBarang) {
            $NamaBarang     = $dataBarang['nama_barang'] == NULL;
            $TanggalRestock = $dataBarang['tanggal_restock'] == NULL;
            $TanggalMutasi  = $dataBarang['tanggal_mutasi'] == NULL;

            $row = array();
            $row[] = ++$no;
            $row[] = '<div>' . ($NamaBarang ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' :  strtoupper($dataBarang['nama_barang'])) . '</div>';
            $row[] = $dataBarang['jumlah_stockBarang'];
            $row[] = $dataBarang['jumlah_stockMutasi'];
            $row[] = $dataBarang['jumlah_stockRusak'];
            $row[] = '<div>' . ($TanggalRestock ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' :  changeDateFormat('d-m-Y', $dataBarang['tanggal_restock'])) . '</div>';
            $row[] = '<div>' . ($TanggalMutasi ? '<span class="badge bg-danger text-white">' . 'DATA KOSONG' . '</span>' :  changeDateFormat('d-m-Y', $dataBarang['tanggal_mutasi'])) . '</div>';
            $row[] =
                '<div class="text-center">
                    <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        Option
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a onclick="TambahBonusPembelian(' . $dataBarang['id_stockBarang'] . ')"class="dropdown-item text-black"><i class="bi bi-patch-plus"></i> Bonus Pembelian</a>
                        <a onclick="BarangAktivasiKeluar(' . $dataBarang['id_stockBarang'] . ')"class="dropdown-item text-black"><i class="bi bi-patch-minus"></i> Keluar Barang</a>
                        <a onclick="BarangAktivasiRusak(' . $dataBarang['id_stockBarang'] . ')"class="dropdown-item text-black"><i class="bi bi-node-minus-fill"></i> Barang Rusak</a>
                </div>';
            $data[] = $row;
        }

        $ouput = array(
            'data' => $data
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($ouput));
    }
}
