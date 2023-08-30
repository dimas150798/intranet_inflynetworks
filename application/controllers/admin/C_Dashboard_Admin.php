<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Dashboard_Admin extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/V_Header_Admin');
        $this->load->view('template/V_Sidebar_Admin');
        $this->load->view('admin/V_Dashboard_Admin');
        $this->load->view('template/V_Footer_Dashboard');
    }
}
