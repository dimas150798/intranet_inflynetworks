<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('changeDateFormat')) {
    function changeDateFormat($format = 'd-m-Y', $givenDate = null)
    {
        return date($format, strtotime($givenDate));
    }
}

class C_Barang_Keluar extends CI_Controller
{

    // Data Barang Keluar
    public function DataBarangKeluar($id_stockBarang)
    {
        $data['DataStock']      = $this->M_StockBarang->EditStockBarang($id_stockBarang);
        $data['DataPegawai']    = $this->M_DataPegawai->DataPegawai();
        $data['DataCustomer']   = $this->M_DataCustomer->CustomerBelumAktivasi();
        $data['DataAktivasi']   = $this->M_DataAktivasi->DataAktivasiStock($id_stockBarang);
        $data['DataAdaptor']    = $this->M_StockBarang->StockBarangAdapter();

        // Check Jumlah Data Barang Patch Core
        $CheckStock             = $this->M_StockBarang->CheckStocBarang($id_stockBarang);

        $JumlahStock            = $CheckStock->jumlah_stockBarang;
        $data['StockBarang']    = $CheckStock->jumlah_stockBarang;

        $Hitam_UPC               = $this->M_StockBarang->CheckStocBarang('49');
        $Kuning_APC              = $this->M_StockBarang->CheckStocBarang('50');
        $Biru_UPC                = $this->M_StockBarang->CheckStocBarang('51');

        $data['Hitam_UPC']      = $Hitam_UPC->jumlah_stockBarang;
        $data['Kuning_APC']     = $Kuning_APC->jumlah_stockBarang;
        $data['Biru_UPC']       = $Biru_UPC->jumlah_stockBarang;

        if ($id_stockBarang == 49 or $id_stockBarang == 50 or $id_stockBarang == 51 or $id_stockBarang == 30 or $id_stockBarang == 29 or $id_stockBarang == 31) {
            if ($JumlahStock != 0) {
                $this->load->view('template/DataBarang/V_Header_Barang', $data);
                $this->load->view('template/V_Sidebar_Admin', $data);
                $this->load->view('admin/StockBarangAktivasi/V_Barang_Keluar', $data);
                $this->load->view('template/DataBarang/V_Footer_Barang', $data);
            } else {
                $this->session->set_flashdata('gagal_icon', 'warning');
                $this->session->set_flashdata('gagal_title', 'Stock Barang Tidak Ada');
                redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
            }
        } else {
            if ($JumlahStock != 0) {
                $this->load->view('template/DataBarang/V_Header_Barang', $data);
                $this->load->view('template/V_Sidebar_Admin', $data);
                $this->load->view('admin/StockBarangAktivasi/V_Barang_KeluarModem', $data);
                $this->load->view('template/DataBarang/V_Footer_Barang', $data);
            } else {
                $this->session->set_flashdata('gagal_icon', 'warning');
                $this->session->set_flashdata('gagal_title', 'Stock Barang Tidak Ada');
                redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
            }
        }
    }
    // End Data Barang Keluar

    // Tambah Barang Keluar 
    public function TambahBarangKeluar()
    {
        // mengambil data post pada view
        $id_stockBarang     = $this->input->post('id_stockBarang');
        $id_barang          = $this->input->post('id_barang');
        $nama_barang        = $this->input->post('nama_barang');
        $id_customer        = $this->input->post('id_customer');
        $kode_barang        = $this->input->post('kode_barang');
        $jumlah             = $this->input->post('jumlah');
        $adaptor            = $this->input->post('adaptor');
        $Hitam_UPC          = $this->input->post('Hitam_UPC');
        $Kuning_APC         = $this->input->post('Kuning_APC');
        $Biru_UPC           = $this->input->post('Biru_UPC');
        $tanggal            = $this->input->post('tanggal');
        $id_pegawai         = $this->input->post('id_pegawai');
        $keterangan         = $this->input->post('keterangan');

        // DATA AKTIVASI
        $CheckAktivasi      = $this->M_DataAktivasi->CheckAktivasiStock($kode_barang);
        $IdStatus           = $CheckAktivasi->id_status;

        // DATA BARANG NON MODEM
        $CheckStock         = $this->M_StockBarang->CheckStocBarang($id_stockBarang);

        // MENGURANGI DAN MENAMBAH STOCK, MUTASI NON MODEM
        $JumlahStockBarang  = $CheckStock->jumlah_stockBarang - $jumlah;
        $JumlahMutasiBarang = $CheckStock->jumlah_stockMutasi + $jumlah;

        // MENGURANGI DAN MENAMBAH STOCK, MUTASI MODEM
        $JumlahStockModem   = $CheckStock->jumlah_stockBarang - 1;
        $JumlahMutasiModem  = $CheckStock->jumlah_stockMutasi + 1;

        // DATA BARANG CUSTOMER
        $DataCustomer               = array(
            'kode_barang'           => $kode_barang
        );

        // WHERE CONDITION ID CUSTOMER
        $IdCustomer                 = array(
            'id_customer'           => $id_customer
        );

        // DATA BARANG NON MODEM
        $DataBarang                 = array(
            'jumlah_stockBarang'    => $JumlahStockBarang,
            'jumlah_stockMutasi'    => $JumlahMutasiBarang,
            'tanggal_mutasi'        => $tanggal
        );

        // DATA BARANG MODEM
        $DataBarangModem            = array(
            'jumlah_stockBarang'    => $JumlahStockModem,
            'jumlah_stockMutasi'    => $JumlahMutasiModem,
            'tanggal_mutasi'        => $tanggal
        );

        // WHERE CONDITION ID BARANG
        $IdBarang                   = array(
            'id_stockBarang'        => $id_stockBarang
        );

        // LAPORAN BARANG NON MODEM
        $LaporanBarang_Keluar       = array(
            'id_stockBarang'        => $id_stockBarang,
            'jumlah'                => $jumlah,
            'tanggal'               => $tanggal,
            'id_pegawai'            => $id_pegawai,
            'id_status'             => 13,
            'keterangan'            => $keterangan
        );

        // DATA BARANG PATCH CORD
        $HitamUPC               = $this->M_StockBarang->CheckStocBarang('49');
        $KuningAPC              = $this->M_StockBarang->CheckStocBarang('50');
        $BiruUPC                = $this->M_StockBarang->CheckStocBarang('51');

        // MENGURANGI DATA JUMLAH STOCK PATCH CORD
        $Stock_Hitam_UPC        = $HitamUPC->jumlah_stockBarang - $Hitam_UPC;
        $Stock_Kuning_APC       = $KuningAPC->jumlah_stockBarang - $Kuning_APC;
        $Stock_Biru_UPC         = $BiruUPC->jumlah_stockBarang - $Biru_UPC;

        // MENAMBAH DATA JUMLAH STOCK PATCH CORD
        $Mutasi_Hitam_UPC       = $HitamUPC->jumlah_stockMutasi + $Hitam_UPC;
        $Mutasi_Kuning_APC      = $KuningAPC->jumlah_stockMutasi + $Kuning_APC;
        $Mutasi_Biru_UPC        = $BiruUPC->jumlah_stockMutasi + $Biru_UPC;

        // DATA BARANG ADAPTOR
        $CheckAdaptor           = $this->M_StockBarang->CheckStocBarang($adaptor);

        // MENGURANGI DAN MENAMBAH JUMLAH ADAPTOR 
        $StockAdaptor           = $CheckAdaptor->jumlah_stockBarang - 1;
        $MutasiAdaptor          = $CheckAdaptor->jumlah_stockMutasi + 1;

        // DATA BARANG PATCH CORD HITAM
        $DataStock_HitamUPC = array(
            'jumlah_stockBarang'            => $Stock_Hitam_UPC,
            'jumlah_stockMutasi'            => $Mutasi_Hitam_UPC,
            'tanggal_restock'               => $tanggal
        );

        //WHERE CONDITION ID BARANG PATCH CORD HITAM
        $IdHitamUPC = array(
            'id_stockBarang'                => 49
        );

        // DATA BARANG PATCH CORD KUNING APC
        $DataStock_KuningAPC = array(
            'jumlah_stockBarang'            => $Stock_Kuning_APC,
            'jumlah_stockMutasi'            => $Mutasi_Kuning_APC,
            'tanggal_mutasi'                => $tanggal
        );

        //WHERE CONDITION ID BARANG PATCH CORD KUNING APC
        $IdKuningAPC = array(
            'id_stockBarang'                => 50
        );

        // DATA BARANG PATCH CORD BIRU UPC
        $DataStock_BiruUPC = array(
            'jumlah_stockBarang'            => $Stock_Biru_UPC,
            'jumlah_stockMutasi'            => $Mutasi_Biru_UPC,
            'tanggal_mutasi'                => $tanggal
        );

        //WHERE CONDITION ID BARANG PATCH CORD BIRU UPC
        $IdBiruUPC = array(
            'id_stockBarang'                => 51
        );

        // DATA BARANG ADAPTOR
        $DataStock_Adaptor = array(
            'jumlah_stockBarang'            => $StockAdaptor,
            'jumlah_stockMutasi'            => $MutasiAdaptor,
            'tanggal_mutasi'                => $tanggal,
        );

        //WHERE CONDITION ID BARANG ADAPTOR
        $IdAdaptor = array(
            'id_stockBarang'                => $adaptor
        );

        // DATA BARANG AKTIVASI
        $DataAktivasi           = array(
            'kode_barang'                   => $kode_barang,
            'id_stockBarang'                => $id_stockBarang,
            'jumlah_modem'                  => 1,
            'Patch_Core_Hitam_UPC_Outdor'   => $Hitam_UPC,
            'Patch_Core_Kuning_UPC_Biru'    => $Biru_UPC,
            'Patch_Core_Kuning_APC_Hijau'   => $Kuning_APC,
            'Adaptor'                       => $adaptor,
            'tanggal'                       => $tanggal,
            'id_status'                     => 13,
            'id_pegawai'                    => $id_pegawai,
            'id_customer'                   => $id_customer,
            'id_keadaanbarang'              => 2
        );

        //WHERE CONDITION ID BARANG PADA AKTIVASI
        $IdAktivasi = array(
            'kode_barang'                   => $kode_barang
        );

        // LAPORAN BARANG KELUAR MODEM
        $LaporanBarang_KeluarModem       = array(
            'id_stockBarang'        => $id_stockBarang,
            'kode_barang'           => $kode_barang,
            'jumlah'                => 1,
            'tanggal'               => $tanggal,
            'id_pegawai'            => $id_pegawai,
            'id_status'             => 13,
            'id_customer'           => $id_customer,
            'keterangan'            => $keterangan
        );

        // LAPORAN BARANG KELUAR ADAPTOR
        $LaporanBarang_KeluarAdaptor       = array(
            'id_stockBarang'        => $adaptor,
            'kode_barang'           => $kode_barang,
            'jumlah'                => 1,
            'tanggal'               => $tanggal,
            'id_pegawai'            => $id_pegawai,
            'id_status'             => 13,
            'id_customer'           => $id_customer,
            'keterangan'            => $keterangan
        );

        // LAPORAN BARANG KELUAR PATCH CORD HITAM
        $Laporan_HitamUPC = array(
            'id_stockBarang'                => 49,
            'kode_barang'                   => $kode_barang,
            'jumlah'                        => $Hitam_UPC,
            'tanggal'                       => $tanggal,
            'id_pegawai'                    => $id_pegawai,
            'id_status'                     => 13,
            'id_customer'                   => $id_customer,
            'keterangan'                    => $keterangan
        );

        // LAPORAN BARANG KELUAR PATCH CORD KUNING APC
        $Laporan_KuningAPC = array(
            'id_stockBarang'                => 50,
            'kode_barang'                   => $kode_barang,
            'jumlah'                        => $Kuning_APC,
            'tanggal'                       => $tanggal,
            'id_pegawai'                    => $id_pegawai,
            'id_status'                     => 13,
            'id_customer'                   => $id_customer,
            'keterangan'                    => $keterangan
        );

        // LAPORAN BARANG KELUAR PATCH CORD BIRU UPC
        $Laporan_BiruUPC = array(
            'id_stockBarang'                => 51,
            'kode_barang'                   => $kode_barang,
            'jumlah'                        => $Biru_UPC,
            'tanggal'                       => $tanggal,
            'id_pegawai'                    => $id_pegawai,
            'id_status'                     => 13,
            'id_customer'                   => $id_customer,
            'keterangan'                    => $keterangan
        );

        if ($kode_barang == NULL) {
            // INSERT LAPORAN DAN UPDATE STOCK NON MODEM
            $this->M_CRUD->updateData('data_stockbarang', $DataBarang, $IdBarang);
            $this->M_CRUD->insertData($LaporanBarang_Keluar, 'data_stockkeluar');

            $this->session->set_flashdata('berhasil_icon', 'success');
            $this->session->set_flashdata('berhasil_title', 'Keluar Barang Berhasil');

            redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
        } else {
            if ($CheckAktivasi != NULL && $IdStatus == 12) {
                // INSERT LAPORAN DAN UPDATE STOCK MODEM
                $this->M_CRUD->updateData('data_aktivasi', $DataAktivasi, $IdAktivasi);
                $this->M_CRUD->updateData('data_stockbarang', $DataBarangModem, $IdBarang);
                $this->M_CRUD->updateData('data_stockbarang', $DataStock_HitamUPC, $IdHitamUPC);
                $this->M_CRUD->updateData('data_stockbarang', $DataStock_KuningAPC, $IdKuningAPC);
                $this->M_CRUD->updateData('data_stockbarang', $DataStock_BiruUPC, $IdBiruUPC);
                $this->M_CRUD->updateData('data_stockbarang', $DataStock_Adaptor, $IdAdaptor);
                $this->M_CRUD->updateData('data_customer', $DataCustomer, $IdCustomer);

                $this->M_CRUD->insertData($LaporanBarang_KeluarModem, 'data_stockkeluar');
                $this->M_CRUD->insertData($LaporanBarang_KeluarAdaptor, 'data_stockkeluar');

                if ($Hitam_UPC != 0) {
                    $this->M_CRUD->insertData($Laporan_HitamUPC, 'data_stockkeluar');
                }

                if ($Kuning_APC != 0) {
                    $this->M_CRUD->insertData($Laporan_KuningAPC, 'data_stockkeluar');
                }

                if ($Biru_UPC != 0) {
                    $this->M_CRUD->insertData($Laporan_BiruUPC, 'data_stockkeluar');
                }

                $this->session->set_flashdata('berhasil_icon', 'success');
                $this->session->set_flashdata('berhasil_title', 'Keluar Barang Berhasil Dengan SN Yang Sudah Ada');

                redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
            } elseif ($CheckAktivasi == NULL) {
                // INSERT LAPORAN DAN UPDATE STOCK MODEM
                $this->M_CRUD->updateData('data_stockbarang', $DataBarangModem, $IdBarang);
                $this->M_CRUD->updateData('data_stockbarang', $DataStock_HitamUPC, $IdHitamUPC);
                $this->M_CRUD->updateData('data_stockbarang', $DataStock_KuningAPC, $IdKuningAPC);
                $this->M_CRUD->updateData('data_stockbarang', $DataStock_BiruUPC, $IdBiruUPC);
                $this->M_CRUD->updateData('data_stockbarang', $DataStock_Adaptor, $IdAdaptor);
                $this->M_CRUD->updateData('data_customer', $DataCustomer, $IdCustomer);

                $this->M_CRUD->insertData($DataAktivasi, 'data_aktivasi');
                $this->M_CRUD->insertData($LaporanBarang_KeluarModem, 'data_stockkeluar');
                $this->M_CRUD->insertData($LaporanBarang_KeluarAdaptor, 'data_stockkeluar');

                if ($Hitam_UPC != 0) {
                    $this->M_CRUD->insertData($Laporan_HitamUPC, 'data_stockkeluar');
                }

                if ($Kuning_APC != 0) {
                    $this->M_CRUD->insertData($Laporan_KuningAPC, 'data_stockkeluar');
                }

                if ($Biru_UPC != 0) {
                    $this->M_CRUD->insertData($Laporan_BiruUPC, 'data_stockkeluar');
                }

                $this->session->set_flashdata('berhasil_icon', 'success');
                $this->session->set_flashdata('berhasil_title', 'Keluar Barang Berhasil');

                redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
            } else {
                $this->session->set_flashdata('gagal_icon', 'success');
                $this->session->set_flashdata('gagal_title', 'Tidak Masuk SN Modem Sudah Terpakai Dan Status Bukan Stock');

                redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
            }
        }
    }

    // Tambah Barang Keluar 
    public function TambahBarangKeluarBackup()
    {
        // mengambil data post pada view
        $id_stockBarang     = $this->input->post('id_stockBarang');
        $nama_barang        = $this->input->post('nama_barang');
        $id_customer        = $this->input->post('id_customer');
        $kode_barang        = $this->input->post('kode_barang');
        $adaptor            = $this->input->post('adaptor');
        $Hitam_UPC          = $this->input->post('Hitam_UPC');
        $Kuning_APC         = $this->input->post('Kuning_APC');
        $Biru_UPC           = $this->input->post('Biru_UPC');
        $tanggal            = $this->input->post('tanggal');
        $id_pegawai         = $this->input->post('id_pegawai');
        $keterangan         = $this->input->post('keterangan');

        // Check Id Modem
        $CheckModem             = $this->M_StockBarang->CheckStocBarang($id_stockBarang);
        $StockModem             = $CheckModem->jumlah_stockBarang - 1;
        $MutasiModem            = $CheckModem->jumlah_stockMutasi + 1;

        // Check Id Adaptor
        $CheckAdaptor           = $this->M_StockBarang->CheckStocBarang($adaptor);
        $StockAdaptor           = $CheckAdaptor->jumlah_stockBarang - 1;
        $MutasiAdaptor          = $CheckAdaptor->jumlah_stockMutasi + 1;

        // Check Jumlah Data Barang Patch Core
        $HitamUPC               = $this->M_StockBarang->CheckStocBarang('49');
        $KuningAPC              = $this->M_StockBarang->CheckStocBarang('50');
        $BiruUPC                = $this->M_StockBarang->CheckStocBarang('51');

        // Mengambil data jumlah stock 
        $Stock_Hitam_UPC        = $HitamUPC->jumlah_stockBarang - $Hitam_UPC;
        $Stock_Kuning_APC       = $KuningAPC->jumlah_stockBarang - $Kuning_APC;
        $Stock_Biru_UPC         = $BiruUPC->jumlah_stockBarang - $Biru_UPC;

        // Mengambil data jumlah mutasi
        $Mutasi_Hitam_UPC       = $HitamUPC->jumlah_stockMutasi + $Hitam_UPC;
        $Mutasi_Kuning_APC      = $KuningAPC->jumlah_stockMutasi + $Kuning_APC;
        $Mutasi_Biru_UPC        = $BiruUPC->jumlah_stockMutasi + $Biru_UPC;


        $DataStock_Barang = array();

        $dataAktivasi = array(
            'Patch_Core_Hitam_UPC_Outdor'   => $Hitam_UPC,
            'Patch_Core_Kuning_UPC_Biru'    => $Biru_UPC,
            'Patch_Core_Kuning_APC_Hijau'   => $Kuning_APC,
            'Adaptor'                       => $adaptor,
            'tanggal'                       => $tanggal,
            'id_status'                     => 13,
            'id_pegawai'                    => $id_pegawai,
            'id_customer'                   => $id_customer,
        );

        //update menggunakan data aktivasi menggunakan kode barang
        $IdAktivasi = array(
            'kode_barang'                   => $kode_barang
        );

        $DataStock_HitamUPC = array(
            'jumlah_stockBarang'            => $Stock_Hitam_UPC,
            'jumlah_stockMutasi'            => $Mutasi_Hitam_UPC,
            'tanggal_restock'               => $tanggal
        );

        //update menggunakan stock hitam UPC 
        $IdHitamUPC = array(
            'id_stockBarang'                => 49
        );

        $DataStock_KuningAPC = array(
            'jumlah_stockBarang'            => $Stock_Kuning_APC,
            'jumlah_stockMutasi'            => $Mutasi_Kuning_APC,
            'tanggal_mutasi'                => $tanggal
        );

        //update menggunakan stock kuning APC 
        $IdKuningAPC = array(
            'id_stockBarang'                => 50
        );

        $DataStock_BiruUPC = array(
            'jumlah_stockBarang'            => $Stock_Biru_UPC,
            'jumlah_stockMutasi'            => $Mutasi_Biru_UPC,
            'tanggal_mutasi'                => $tanggal
        );

        //update menggunakan stock Biru UPC
        $IdBiruUPC = array(
            'id_stockBarang'                => 51
        );

        $DataStock_Adaptor = array(
            'jumlah_stockBarang'            => $StockAdaptor,
            'jumlah_stockMutasi'            => $MutasiAdaptor,
            'tanggal_mutasi'                => $tanggal,
        );

        //update menggunakan id adaptor
        $IdAdaptor = array(
            'id_stockBarang'                => $adaptor
        );

        $DataStock_Modem = array(
            'jumlah_stockBarang'            => $StockModem,
            'jumlah_stockMutasi'            => $MutasiModem,
            'tanggal_mutasi'                => $tanggal,
        );

        // update menggunakan id modem
        $IdModem = array(
            'id_stockBarang'                => $id_stockBarang
        );

        $DataCustomer = array(
            'kode_barang'                   => $kode_barang
        );

        // Update menggunakan id customer
        $IdCustomer = array(
            'id_customer'                   => $id_customer
        );

        $Laporan_Modem = array(
            'id_stockBarang'                => $id_stockBarang,
            'kode_barang'                   => $kode_barang,
            'jumlah'                        => 1,
            'tanggal'                       => $tanggal,
            'id_pegawai'                    => $id_pegawai,
            'id_status'                     => 13,
            'id_customer'                   => $id_customer,
            'keterangan'                    => $keterangan
        );

        $Laporan_Barang = array(
            'id_stockBarang'                => $id_stockBarang,
            'kode_barang'                   => $kode_barang,
            'jumlah'                        => 1,
            'tanggal'                       => $tanggal,
            'id_pegawai'                    => $id_pegawai,
            'id_status'                     => 13,
            'id_customer'                   => $id_customer,
            'keterangan'                    => $keterangan
        );

        $Laporan_HitamUPC = array(
            'id_stockBarang'                => 49,
            'kode_barang'                   => $kode_barang,
            'jumlah'                        => $Hitam_UPC,
            'tanggal'                       => $tanggal,
            'id_pegawai'                    => $id_pegawai,
            'id_status'                     => 13,
            'id_customer'                   => $id_customer,
            'keterangan'                    => $keterangan
        );

        $Laporan_KuningAPC = array(
            'id_stockBarang'                => 50,
            'kode_barang'                   => $kode_barang,
            'jumlah'                        => $Kuning_APC,
            'tanggal'                       => $tanggal,
            'id_pegawai'                    => $id_pegawai,
            'id_status'                     => 13,
            'id_customer'                   => $id_customer,
            'keterangan'                    => $keterangan
        );

        $Laporan_BiruUPC = array(
            'id_stockBarang'                => 51,
            'kode_barang'                   => $kode_barang,
            'jumlah'                        => $Biru_UPC,
            'tanggal'                       => $tanggal,
            'id_pegawai'                    => $id_pegawai,
            'id_status'                     => 13,
            'id_customer'                   => $id_customer,
            'keterangan'                    => $keterangan
        );

        // Update Data 
        $this->M_CRUD->updateData('data_stockbarang', $DataStock_Modem, $IdModem);
        $this->M_CRUD->updateData('data_stockbarang', $DataStock_HitamUPC, $IdHitamUPC);
        $this->M_CRUD->updateData('data_stockbarang', $DataStock_KuningAPC, $IdKuningAPC);
        $this->M_CRUD->updateData('data_stockbarang', $DataStock_BiruUPC, $IdBiruUPC);
        $this->M_CRUD->updateData('data_stockbarang', $DataStock_Adaptor, $IdAdaptor);
        $this->M_CRUD->updateData('data_customer', $DataCustomer, $IdCustomer);
        $this->M_CRUD->updateData('data_aktivasi', $dataAktivasi, $IdAktivasi);

        // Insert Data Laporan

        if ($kode_barang != NULL) {
            $this->M_CRUD->insertData($Laporan_Modem, 'data_stockkeluar');
        } else {
            $this->M_CRUD->insertData($Laporan_Barang, 'data_stockkeluar');
        }

        if ($Hitam_UPC != 0) {
            $this->M_CRUD->insertData($Laporan_HitamUPC, 'data_stockkeluar');
        }

        if ($Kuning_APC != 0) {
            $this->M_CRUD->insertData($Laporan_KuningAPC, 'data_stockkeluar');
        }

        if ($Biru_UPC != 0) {
            $this->M_CRUD->insertData($Laporan_BiruUPC, 'data_stockkeluar');
        }

        $this->session->set_flashdata('berhasil_icon', 'success');
        $this->session->set_flashdata('berhasil_title', 'Keluar Barang Berhasil');

        redirect('admin/StockBarangAktivasi/C_Barang_Aktivasi');
    }
}
