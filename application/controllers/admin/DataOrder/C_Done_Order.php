<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Done_Order extends CI_Controller
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

    public function DoneOrder($id_purchase_order)
    {
        $data['DoneOrder']  = $this->M_DataOrder->DoneOrder($id_purchase_order);
        $data['DataPegawai']    = $this->M_DataPegawai->DataPegawai();
        $data['DataStatus'] = $this->M_DataStatus->DataStatusOrder();

        $CheckOrder = $this->M_DataOrder->CheckOrder($id_purchase_order);

        if ($CheckOrder->id_status == 4) {
            $this->load->view('template/DataPurchase/V_Header_Purchase', $data);
            $this->load->view('template/V_Sidebar_Admin', $data);
            $this->load->view('admin/DataOrder/V_Done_Order', $data);
            $this->load->view('template/DataPurchase/V_Footer_Purchase', $data);
        } else {
            $this->session->set_flashdata('gagal_icon', 'warning');
            $this->session->set_flashdata('gagal_title', 'Barang Sudah Diterima');

            redirect('admin/DataOrder/C_Data_Order');
        }
    }

    public function OrderSave()
    {
        // mengambil data post pada view
        $id_purchase_order      = $this->input->post('id_purchase_order');
        $id_stockBarang         = $this->input->post('id_stockBarang');
        $id_barang              = $this->input->post('id_barang');
        $nama_barang            = $this->input->post('nama_barang');
        $no_pesanan             = $this->input->post('no_pesanan');
        $nama_supplier          = $this->input->post('nama_supplier');
        $jumlah_order           = $this->input->post('jumlah_order');
        $harga_barang           = $this->input->post('harga_barang');
        $tanggal_diterima       = $this->input->post('tanggal_diterima');
        $id_pegawai             = $this->input->post('id_pegawai');
        $id_status              = $this->input->post('id_status');

        // Mengambil data request untuk update id_status
        $CheckDone_Request       = $this->M_DataOrder->CheckOrder($id_purchase_order);

        // Mengambil data request untuk update id_status
        $CheckACC_Request       = $this->M_DataRequest->CheckACCRequest($CheckDone_Request->no_purchase_request, $id_barang);

        // Check Barang
        $CheckBarang            = $this->M_StockBarang->CheckStocBarang($id_stockBarang);
        $Stock_Barang           = $CheckBarang->jumlah_stockBarang + $jumlah_order;

        $DataOrder = array(
            'tanggal_diterima'  => $tanggal_diterima,
            'id_pegawai_terima' => $id_pegawai,
            'id_status'         => $id_status
        );

        $IdOrder = array(
            'id_purchase_order' => $id_purchase_order
        );

        $DataRequest = array(
            'id_status'         => $id_status
        );

        $IdRequest = array(
            'id_purchase_request' => $CheckACC_Request->id_purchase_request
        );

        $StockBarangInsert = array(
            'id_barang'             => $id_barang,
            'jumlah_stockBarang'    => $jumlah_order,
            'jumlah_stockMutasi'    => 0,
            'jumlah_stockRusak'     => 0,
            'tanggal_restock'       => $tanggal_diterima
        );

        // Data Stock Barang
        $StockBarangUpdate            = array(
            'jumlah_stockBarang'    => $Stock_Barang,
            'tanggal_restock'       => $tanggal_diterima
        );

        //update menggunakan id_stockBarang
        $IdStockBarang          = array(
            'id_stockBarang'    => $id_stockBarang
        );

        // Stock Barang Masuk
        $StockBarangMasuk       = array(
            'nama_barang'       => $nama_barang,
            'kode_barang'       => $no_pesanan,
            'jumlah'            => $jumlah_order,
            'tanggal'           => $tanggal_diterima,
            'id_pegawai'        => $id_pegawai,
            'id_status'         => 14
        );

        if ($CheckBarang == NULL) {
            $this->M_CRUD->updateData('data_purchase_order', $DataOrder, $IdOrder);
            $this->M_CRUD->updateData('data_purchase_request', $DataRequest, $IdRequest);
            $this->M_CRUD->insertData($StockBarangInsert, 'data_stockbarang');
            $this->M_CRUD->insertData($StockBarangMasuk, 'data_stockmasuk');

            redirect('admin/DataOrder/C_Data_Order');
        } else {
            $this->M_CRUD->updateData('data_purchase_order', $DataOrder, $IdOrder);
            $this->M_CRUD->updateData('data_purchase_request', $DataRequest, $IdRequest);
            $this->M_CRUD->updateData('data_stockbarang', $StockBarangUpdate, $IdStockBarang);
            $this->M_CRUD->insertData($StockBarangMasuk, 'data_stockmasuk');

            redirect('admin/DataOrder/C_Data_Order');
        }
    }
}
