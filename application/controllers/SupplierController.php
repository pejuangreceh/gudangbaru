<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SupplierController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('suppliers');
    }

    public function index()
    {
        $data['judul'] = 'supplier';
        $data['suppliers']  = $this->suppliers->read();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('supplier/index', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $data['judul'] = 'Add supplier';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('supplier/add', $data);
        $this->load->view('template/footer');
    }
    public function save()
    {
        $data = array(
            'supplier_code' => $this->input->post('supplier_code'),
            'supplier_name' => $this->input->post('supplier_name'),
            'address' => $this->input->post('address'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $query = $this->suppliers->create($data);
        redirect(base_url('supplierController'));
    }
    public function edit($id)
    {

        $result = $this->suppliers->get("WHERE id = '$id'");
        $data = array(
            'id' => $id,
            'supplier_code' => $result[0]['supplier_code'],
            'supplier_name' => $result[0]['supplier_name'],
            'address' => $result[0]['address'],
            'judul' => 'Edit supplier'
        );
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('supplier/edit', $data);
        $this->load->view('template/footer');
    }
    public function update($id)
    {
        $data = array(
            'id' => $id,
            'supplier_code' => $this->input->post('supplier_code'),
            'supplier_name' => $this->input->post('supplier_name'),
            'address' => $this->input->post('address'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $query = $this->suppliers->update($data, $id);
        redirect(base_url('supplierController'));
    }
    public function delete($id)
    {
        $query = $this->suppliers->delete($id);
        redirect(base_url('supplierController'));
    }
}
