<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UnitController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('units');
    }

    public function index()
    {
        $data['judul'] = 'unit';
        $data['units']  = $this->units->read();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('unit/index', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $data['judul'] = 'Add unit';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('unit/add', $data);
        $this->load->view('template/footer');
    }
    public function save()
    {
        $data = array(
            'unit_code' => $this->input->post('unit_code'),
            'unit_name' => $this->input->post('unit_name'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $query = $this->units->create($data);
        redirect(base_url('UnitController'));
    }
    public function edit($id)
    {

        $result = $this->units->get("WHERE id = '$id'");
        $data = array(
            'id' => $id,
            'unit_code' => $result[0]['unit_code'],
            'unit_name' => $result[0]['unit_name'],
            'judul' => 'Edit unit'
        );
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('unit/edit', $data);
        $this->load->view('template/footer');
    }
    public function update($id)
    {
        $data = array(
            'id' => $id,
            'unit_code' => $this->input->post('unit_code'),
            'unit_name' => $this->input->post('unit_name'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $query = $this->units->update($data, $id);
        redirect(base_url('UnitController'));
    }
    public function delete($id)
    {
        $query = $this->units->delete($id);
        redirect(base_url('UnitController'));
    }
}
