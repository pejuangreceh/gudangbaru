<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('orders');
        $this->load->model('items');
        $this->load->model('suppliers');
        $this->load->model('warehouses');
        $this->load->model('categories');
        $this->load->model('units');
    }

    public function index()
    {
        $data['judul'] = 'Order';
        $data['transactions']  = $this->orders->read_transaksi();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('order/index', $data);
        $this->load->view('template/footer');
    }
    public function detail($id, $transaction_code)
    {
        $data['judul'] = 'Order Detail';
        $data['orders']  = $this->orders->read($transaction_code);
        $data['transaction_code'] = $transaction_code;
        $data['aksi'] = 'detail';
        $data['keterangan'] = $this->orders->read_per_transaksi($transaction_code);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('order/detail', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $data['judul'] = 'Add Order';
        $data['items'] = $this->items->read();
        $data['suppliers'] = $this->suppliers->read();
        $data['warehouses'] = $this->warehouses->read();
        $data['new_id'] = $this->get_transaction_code();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('order/add', $data);
        $this->load->view('template/footer');
    }
    public function get_transaction_code()
    {
        $new_id =  $this->orders->get_idmax()->result();
        // var_dump($new_id);
        if ($new_id > 0) {
            foreach ($new_id as $key) {
                $auto_id = $key->transaction_code;
            }
        }
        // echo $auto_id;
        return $transaction_code = $this->orders->get_newid($auto_id, 'P');
        // echo $transaction_code;
    }
    public function save()
    {
        $result = array();
        $item_id = $_POST['item_id'];
        $order_date = $_POST['order_date'];
        $supplier_id = $_POST['supplier_id'];
        $item_total = $_POST['item_total'];
        $buying_price = $_POST['buying_price'];
        $total_price = $_POST['total_price'];
        $transaction_code = $_POST['transaction_code'];
        // var_dump($order_code);
        // pengecekkan input
        if (isset($_POST['item_id'])) {
            $result = array();
            $total_stok = 0;
            for ($i = 0; $i < count($_POST['total_price']); $i++) {
                $result = array(
                    'transaction_code' => $transaction_code,
                    'item_id' => $_POST['item_id'][$i],
                    'supplier_id' => $supplier_id,
                    'item_total' => $_POST['item_total'][$i],
                    'buying_price' => $_POST['buying_price'][$i],
                    'total_price' => $_POST['total_price'][$i],
                    'status' => 'pending',
                    'sisa_stok' => $_POST['item_total'][$i],
                    'order_date' => $order_date,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $total_stok += $_POST['item_total'][$i];
                $this->db->insert('order_tb', $result);
            }
            $result_transaction = array(
                'transaction_code' => $transaction_code,
                'type' => 'order',
                'supplier_id' => $supplier_id,
                'status' => 'pending',
                'total_stok' => $total_stok,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('transactions', $result_transaction);
            redirect(base_url('OrderController'));
        } else {
            redirect(base_url('OrderController/add'));
        }
    }
    public function accept_detail($id, $transaction_code)
    {
        $data['judul'] = 'Verification Order';
        $data['orders']  = $this->orders->read($transaction_code);
        $data['id'] = $id;
        $data['transaction_code'] = $transaction_code;
        $data['aksi'] = 'accept';
        $data['keterangan'] = $this->orders->read_per_transaksi($transaction_code);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('order/detail', $data);
        $this->load->view('template/footer');
    }
    public function reject_detail($id, $transaction_code)
    {
        $data['judul'] = 'Reject Order';
        $data['orders']  = $this->orders->read($transaction_code);
        $data['id'] = $id;
        $data['transaction_code'] = $transaction_code;
        $data['aksi'] = 'reject';
        $data['keterangan'] = $this->orders->read_per_transaksi($transaction_code);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('order/detail', $data);
        $this->load->view('template/footer');
    }
    public function reject($id, $transaction_code)
    {
        $data['id'] = $id;
        $data['transaction_code'] = $transaction_code;
        $result_transaction = array(
            'description' => $this->input->post('description'),
            'status' => 'rejected',
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->orders->reject($result_transaction, $id);
        redirect(base_url('OrderController'));
    }
    public function accept($id, $transaction_code)
    {
        $data['id'] = $id;
        $data['transaction_code'] = $transaction_code;
        // update transactions
        $result_transaction = array(
            'description' => $this->input->post('description'),
            'status' => 'accepted',
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->orders->accept($result_transaction, $id);
        // update orders
        $result_order = array(
            'status' => 'accepted',
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->orders->accept_orders($result_order, $transaction_code);
        redirect(base_url('OrderController'));
    }

    public function update($id)
    {
        $data = array(
            'id' => $id,
            'sku_number' => $this->input->post('sku_number'),
            'order_code' => $this->input->post('order_code'),
            'order_name' => $this->input->post('order_name'),
            'order_category_id' => $this->input->post('order_category_id'),
            'unit_id' => $this->input->post('unit_id'),
            'selling_price' => $this->input->post('selling_price'),
            'buying_price' => $this->input->post('buying_price'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $query = $this->orders->update($data, $id);
        redirect(base_url('OrderController'));
    }
    // public function delete($id, $code)
    // {
    //     $query = $this->orders->delete($id, $code);
    //     $query_transaksi = $this->orders->cek_transaksi($code);
    //     redirect(base_url('OrderController'));
    // }
    // public function lihat($code)
    // {
    //     $query = $this->orders->cek_transaksi($code);
    //     echo $query;
    // }
}
