<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customers');
    }

    public function index()
    {
        $data['judul'] = 'Customer';
        $data['customers']  = $this->customers->read();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('customer/index', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $data['judul'] = 'Add Customer';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('customer/add', $data);
        $this->load->view('template/footer');
    }
    public function save()
    {
        $data = array(
            'customer_code' => $this->input->post('customer_code'),
            'customer_name' => $this->input->post('customer_name'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $query = $this->customers->create($data);
        redirect(base_url('CustomerController'));
    }
    public function edit($id)
    {

        $result = $this->customers->get("WHERE id = '$id'");
        $data = array(
            'id' => $id,
            'customer_code' => $result[0]['customer_code'],
            'customer_name' => $result[0]['customer_name'],
            'judul' => 'Edit Customer'
        );
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('customer/edit', $data);
        $this->load->view('template/footer');
    }
    public function update($id)
    {
        $data = array(
            'id' => $id,
            'customer_code' => $this->input->post('customer_code'),
            'customer_name' => $this->input->post('customer_name'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $query = $this->customers->update($data, $id);
        redirect(base_url('CustomerController'));
    }
    public function delete($id)
    {
        $query = $this->customers->delete($id);
        redirect(base_url('CustomerController'));
    }
}
