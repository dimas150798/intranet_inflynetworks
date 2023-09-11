<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Dashboard_Admin extends CI_Controller
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
        $this->load->view('template/V_Header_Admin');
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/V_Dashboard_Admin');
        $this->load->view('template/V_Footer_Dashboard');
    }
}
