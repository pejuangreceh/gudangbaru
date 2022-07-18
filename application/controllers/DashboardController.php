<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboards');
        $this->load->model('items');
        $this->load->model('item_outs');
        $this->load->model('suppliers');
        $this->load->model('warehouses');
        $this->load->model('customers');
        $this->load->model('categories');
        $this->load->model('units');
    }

    public function index()
    {
        $data['judul'] = 'Item out';
        $data['item_outs']  = $this->dashboards->read_item_out();
        $data['item_outs_2']  = $this->dashboards->read_item_out_2();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('dashboard/index', $data);
        $this->load->view('template/footer');
    }
}
