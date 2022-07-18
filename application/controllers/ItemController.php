<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ItemController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('items');
        $this->load->model('categories');
        $this->load->model('units');
    }

    public function index()
    {
        $data['judul'] = 'Item';
        $data['items']  = $this->items->read();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item/index', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $data['judul'] = 'Add Item';
        $data['categories'] = $this->categories->read();
        $data['units'] = $this->units->read();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item/add', $data);
        $this->load->view('template/footer');
    }
    public function save()
    {
        $data = array(
            'sku_number' => $this->input->post('sku_number'),
            'item_code' => $this->input->post('item_code'),
            'item_name' => $this->input->post('item_name'),
            'item_category_id' => $this->input->post('item_category_id'),
            'unit_id' => $this->input->post('unit_id'),
            'selling_price' => $this->input->post('selling_price'),
            'buying_price' => $this->input->post('buying_price'),
            'used' => FALSE,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $query = $this->items->create($data);
        redirect(base_url('itemController'));
    }
    public function edit($id)
    {

        $result = $this->items->get("WHERE id = '$id'");
        $data = array(
            'id' => $id,
            'sku_number' => $result[0]['sku_number'],
            'item_code' => $result[0]['item_code'],
            'item_name' => $result[0]['item_name'],
            'item_category_id' => $result[0]['item_category_id'],
            'unit_id' => $result[0]['unit_id'],
            'selling_price' => $result[0]['selling_price'],
            'buying_price' => $result[0]['buying_price'],
            'judul' => 'Edit Item'
        );
        $data['categories'] = $this->categories->read();
        $data['units'] = $this->units->read();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item/edit', $data);
        $this->load->view('template/footer');
    }
    public function update($id)
    {
        $data = array(
            'id' => $id,
            'sku_number' => $this->input->post('sku_number'),
            'item_code' => $this->input->post('item_code'),
            'item_name' => $this->input->post('item_name'),
            'item_category_id' => $this->input->post('item_category_id'),
            'unit_id' => $this->input->post('unit_id'),
            'selling_price' => $this->input->post('selling_price'),
            'buying_price' => $this->input->post('buying_price'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $query = $this->items->update($data, $id);
        redirect(base_url('ItemController'));
    }
    public function delete($id)
    {
        $query = $this->items->delete($id);
        redirect(base_url('ItemController'));
    }
}
