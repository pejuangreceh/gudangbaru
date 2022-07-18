<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users');
    }

    public function index()
    {
        $data['judul'] = 'User';
        $data['users']  = $this->users->read();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $data['judul'] = 'Add User';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('user/add', $data);
        $this->load->view('template/footer');
    }
    public function save()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'nik' => $this->input->post('nik'),
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'phone_number' => $this->input->post('phone_number'),
            'role_id' => $this->input->post('role_id'),
            'password' => $this->input->post('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $query = $this->users->create($data);
        redirect(base_url('UserController'));
    }
    public function edit($id)
    {
        $result = $this->users->get("WHERE id = '$id'");
        $data = array(
            'id' => $id,
            'name' => $result[0]['name'],
            'username' => $result[0]['username'],
            'email' => $result[0]['email'],
            'nik' => $result[0]['nik'],
            'gender' => $result[0]['gender'],
            'address' => $result[0]['address'],
            'phone_number' => $result[0]['phone_number'],
            'role_id' => $result[0]['role_id'],
            'password' => $result[0]['password'],
            'judul' => 'Edit User'
        );
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('user/edit', $data);
        $this->load->view('template/footer');
    }
    public function update($id)
    {
        $data = array(
            'id' => $id,
            'name' => $this->input->post('name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'nik' => $this->input->post('nik'),
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'phone_number' => $this->input->post('phone_number'),
            'role_id' => $this->input->post('role_id'),
            'password' => $this->input->post('password'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $query = $this->users->update($data, $id);
        redirect(base_url('UserController'));
    }
    public function delete($id)
    {
        $query = $this->users->delete($id);
        redirect(base_url('UserController'));
    }
}
