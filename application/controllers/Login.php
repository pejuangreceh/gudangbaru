<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users');
    }

    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('login');
    }


    public function cek_login()
    {
        $username     = $this->input->post('username');
        $password     = $this->input->post('password');
        if (strpos($username, '@')) {
            $result     = $this->users->login_email($username, $password);
        } else {
            $result     = $this->users->login_username($username, $password);
        }
        if ($result) {
            $sess = array(
                'id'  => $result[0]['id'],
                'username'  => $result[0]['username'],
                'name'      => $result[0]['name'],
                'email'      => $result[0]['email'],
                'role_id'        => $result[0]['role_id'],
                'logged_in' => TRUE
            );
            $this->session->set_userdata($sess);
            redirect(base_url('DashboardController'));
        } else {
            $this->session->set_flashdata('message', 'Wrong Username or Password!');
            redirect(base_url());
        }
    }
    public function logout()
    {
        session_destroy();
        redirect(base_url());
    }
}
