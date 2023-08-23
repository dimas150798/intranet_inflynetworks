<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Login extends CI_Controller
{
    public function index()
    {
        $this->form_validation->set_rules('username_login', 'username_login', 'required');
        $this->form_validation->set_rules('password_login', 'password_login', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu');

        if ($this->form_validation->run() == false) {
            // apabila error kembali ke form login
            $this->load->view('template/V_Header_Login');
            $this->load->view('V_Login');
            $this->load->view('template/V_Footer_Login');
        } else {
            // mengambil data dari view post
            $username_login = $this->input->post('username_login');
            $password_login = $this->input->post('password_login');

            $data_login = $this->M_Login->CheckLogin($username_login, $password_login);

            if ($data_login == NULL) {
                // apabila error kembali ke form login
                // Notifikasi gagal login
                $this->session->set_flashdata('LoginGagal_icon', 'error');
                $this->session->set_flashdata('LoginGagal_title', 'Email atau Password Salah');

                $this->load->view('template/V_Header_Login');
                $this->load->view('V_Login');
                $this->load->view('template/V_Footer_Login');
            } else {
                redirect('admin/C_Dashboard_Admin');
            }
        }
    }
}
