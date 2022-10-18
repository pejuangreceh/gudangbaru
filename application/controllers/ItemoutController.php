<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ItemoutController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('item_outs');
        $this->load->model('items');
        $this->load->model('suppliers');
        $this->load->model('warehouses');
        $this->load->model('customers');
        $this->load->model('categories');
        $this->load->model('units');
    }

    public function index()
    {
        $data['judul'] = 'Item out';
        $data['transactions']  = $this->item_outs->read_transaksi();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item_out/index', $data);
        $this->load->view('template/footer');
    }
    public function list_of_selling()
    {
        $where = $this->input->post('periode');
        $data['periode'] = $this->input->post('periode');
        $data['judul'] = 'List of Sell';
        $data['transactions']  = $this->item_outs->read_list_selling($where);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item_out/selling', $data);
        $this->load->view('template/footer');
    }
    public function list_of_buying()
    {
        $where = $this->input->post('periode');
        $data['periode'] = $this->input->post('periode');
        $data['judul'] = 'List of Buy';
        $data['transactions']  = $this->item_outs->read_list_buying($where);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item_out/buying', $data);
        $this->load->view('template/footer');
    }
    public function list_of_fast_moving()
    {
        $where = $this->input->post('periode');
        $data['periode'] = $this->input->post('periode');
        $data['judul'] = 'List of Fast Moving';
        $data['transactions']  = $this->item_outs->read_list_fast_moving($where);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item_out/fast_moving', $data);
        $this->load->view('template/footer');
    }
    public function list_of_slow_moving()
    {
        $where = $this->input->post('periode');
        $data['periode'] = $this->input->post('periode');
        $data['judul'] = 'List of Slow Moving';
        $data['transactions']  = $this->item_outs->read_list_slow_moving($where);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item_out/slow_moving', $data);
        $this->load->view('template/footer');
    }
    public function detail($id, $transaction_code)
    {
        $data['judul'] = 'Item out Detail';
        $data['item_outs']  = $this->item_outs->read_item_out($transaction_code);
        $data['transaction_code'] = $transaction_code;
        $data['aksi'] = 'detail';
        $data['keterangan'] = $this->item_outs->read_per_transaksi($transaction_code);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item_out/detail', $data);
        $this->load->view('template/footer');
    }
    public function add($transaction_code = NULL)
    {
        $where = $this->input->post('transaction_code');
        $data['transaction_code'] = $this->input->post('transaction_code');
        $data['judul'] = 'Add Item out';
        $data['items'] = $this->items->read_out();
        $data['suppliers'] = $this->suppliers->read();
        $data['warehouses'] = $this->warehouses->read();
        $data['customers'] = $this->customers->read();
        $data['new_id'] = $this->get_transaction_code();
        $data['transactions']  = $this->item_outs->read_transaksi_order();
        $data['orders']  = $this->item_outs->read($where);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item_out/add', $data);
        $this->load->view('template/footer');
    }

    public function get_transaction_code()
    {
        $new_id =  $this->item_outs->get_idmax()->result();
        // var_dump($new_id);
        if ($new_id > 0) {
            foreach ($new_id as $key) {
                $auto_id = $key->transaction_code;
            }
        }
        // echo $auto_id;
        return $this->item_outs->get_newid($auto_id, 'P');
        // echo $transaction_code;
    }
    public function save()
    {
        $result = array();
        $item_id = $_POST['item_id'];
        $out_date = $_POST['out_date'];
        $out_date_string = new DateTime($out_date);
        $customer_id = $_POST['customer_id'];
        $warehouse_id = $_POST['warehouse_id'];
        $item_total = $_POST['item_total'];
        $selling_price = $_POST['selling_price'];
        $total_price = $_POST['total_price'];
        $transaction_code = $_POST['transaction_code'];
        // var_dump($item_code);
        $result = array();
        // pengecekkan input
        if (isset($_POST['item_id'])) {
            for ($i = 0; $i < count($_POST['total_price']); $i++) {
                $result = array(
                    'transaction_code' => $transaction_code,
                    'item_id' => $_POST['item_id'][$i],
                    'customer_id' => $customer_id,
                    'warehouse_id' => $warehouse_id,
                    'item_total' => $_POST['item_total'][$i],
                    'selling_price' => $_POST['selling_price'][$i],
                    'total_price' => $_POST['total_price'][$i],
                    'status' => 'pending',
                    'out_date' => $out_date,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('item_out_tb', $result);
            }
            $result_transaction = array(
                'transaction_code' => $transaction_code,
                'type' => 'out',
                'customer_id' => $customer_id,
                'warehouse_id' => $warehouse_id,
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('transactions', $result_transaction);
            // mengupdate status order setelah Item out menjadi -> stok_in

            // $result_transaction_order = array(
            //     'status' => 'done',
            // );
            // $this->item_outs->update($result_transaction_order);
            redirect(base_url('ItemoutController'));
        } else {
            redirect(base_url('ItemoutController/add'));
        }
    }
    public function accept_detail($id, $transaction_code)
    {
        $data['judul'] = 'Verification Item out';
        $data['item_outs']  = $this->item_outs->read($transaction_code);
        $data['id'] = $id;
        $data['keterangan'] = $this->item_outs->read_per_transaksi($transaction_code);
        $data['transaction_code'] = $transaction_code;
        $data['aksi'] = 'accept';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item_out/detail', $data);
        $this->load->view('template/footer');
    }
    public function reject_detail($id, $transaction_code)
    {
        $data['judul'] = 'Reject Item out';
        $data['item_outs']  = $this->item_outs->read($transaction_code);
        $data['id'] = $id;
        $data['keterangan'] = $this->item_outs->read_per_transaksi($transaction_code);
        $data['transaction_code'] = $transaction_code;
        $data['aksi'] = 'reject';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item_out/detail', $data);
        $this->load->view('template/footer');
    }
    public function reject($id, $transaction_code)
    {
        $data['id'] = $id;
        $data['transaction_code'] = $transaction_code;
        // update transactions
        $result_transaction = array(
            'description' => $this->input->post('description'),
            'status' => 'rejected',
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->item_outs->reject($result_transaction, $id);
        // update item out
        $result_item_out = array(
            'status' => 'rejected',
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->item_outs->accept_item_outs($result_item_out, $transaction_code);
        redirect(base_url('ItemoutController'));
    }
    public function accept($id, $transaction_code)
    {
        $data['id'] = $id;
        $data['transaction_code'] = $transaction_code;
        //update transactions
        $result_transaction = array(
            'description' => $this->input->post('description'),
            'status' => 'accepted',
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->item_outs->accept($result_transaction, $id);
        // update item out
        $result_item_out = array(
            'status' => 'accepted',
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->item_outs->accept_item_outs($result_item_out, $transaction_code);
        redirect(base_url('itemoutController'));
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
        $query = $this->item_outs->update($data, $id);
        redirect(base_url('ItemoutController'));
    }
    // public function delete($id, $code)
    // {
    //     $query = $this->item_outs->delete($id, $code);
    //     $query_transaksi = $this->item_outs->cek_transaksi($code);
    //     redirect(base_url('itemController'));
    // }
    // public function lihat($code)
    // {
    //     $query = $this->item_outs->cek_transaksi($code);
    //     echo $query;
    // }
}
