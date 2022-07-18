<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CategoryController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('categories');
    }

    public function index()
    {
        $data['judul'] = 'category';
        $data['categories']  = $this->categories->read();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('category/index', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $data['judul'] = 'Add category';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('category/add', $data);
        $this->load->view('template/footer');
    }
    public function save()
    {
        $data = array(
            'category_code' => $this->input->post('category_code'),
            'category_name' => $this->input->post('category_name'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $query = $this->categories->create($data);
        redirect(base_url('CategoryController'));
    }
    public function edit($id)
    {

        $result = $this->categories->get("WHERE id = '$id'");
        $data = array(
            'id' => $id,
            'category_code' => $result[0]['category_code'],
            'category_name' => $result[0]['category_name'],
            'judul' => 'Edit category'
        );
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('category/edit', $data);
        $this->load->view('template/footer');
    }
    public function update($id)
    {
        $data = array(
            'id' => $id,
            'category_code' => $this->input->post('category_code'),
            'category_name' => $this->input->post('category_name'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $query = $this->categories->update($data, $id);
        redirect(base_url('CategoryController'));
    }
    public function delete($id)
    {
        $query = $this->categories->delete($id);
        redirect(base_url('CategoryController'));
    }
}
