<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Add_Pegawai extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/V_Header_Admin');
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/DataPelanggan/V_Add_Pegawai');
        $this->load->view('template/V_Footer_Admin');
    }

    public function TambahPegawai()
    {
    }
}
