<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WarehouseController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('warehouses');
    }

    public function index()
    {
        $data['judul'] = 'warehouse';
        $data['warehouses']  = $this->warehouses->read();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('warehouse/index', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $data['judul'] = 'Add warehouse';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('warehouse/add', $data);
        $this->load->view('template/footer');
    }
    public function save()
    {
        $data = array(
            'warehouse_code' => $this->input->post('warehouse_code'),
            'warehouse_name' => $this->input->post('warehouse_name'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $query = $this->warehouses->create($data);
        redirect(base_url('warehouseController'));
    }
    public function edit($id)
    {

        $result = $this->warehouses->get("WHERE id = '$id'");
        $data = array(
            'id' => $id,
            'warehouse_code' => $result[0]['warehouse_code'],
            'warehouse_name' => $result[0]['warehouse_name'],
            'judul' => 'Edit warehouse'
        );
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('warehouse/edit', $data);
        $this->load->view('template/footer');
    }
    public function update($id)
    {
        $data = array(
            'id' => $id,
            'warehouse_code' => $this->input->post('warehouse_code'),
            'warehouse_name' => $this->input->post('warehouse_name'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $query = $this->warehouses->update($data, $id);
        redirect(base_url('warehouseController'));
    }
    public function delete($id)
    {
        $query = $this->warehouses->delete($id);
        redirect(base_url('warehouseController'));
    }
}
