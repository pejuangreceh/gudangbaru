<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IteminController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('item_ins');
        $this->load->model('items');
        $this->load->model('suppliers');
        $this->load->model('warehouses');
        $this->load->model('categories');
        $this->load->model('units');
    }

    public function index()
    {
        $data['judul'] = 'Item in';
        $data['transactions']  = $this->item_ins->read_transaksi();
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item_in/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($id, $transaction_code)
    {
        $data['judul'] = 'Item in Detail';
        $data['item_ins']  = $this->item_ins->read_item_in($transaction_code);
        $data['transaction_code'] = $transaction_code;
        $data['aksi'] = 'detail';
        $data['keterangan'] = $this->item_ins->read_per_transaksi($transaction_code);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item_in/detail', $data);
        $this->load->view('template/footer');
    }
    public function add($transaction_code = NULL)
    {
        $where = $this->input->post('transaction_code');
        $data['transaction_code'] = $this->input->post('transaction_code');
        $data['judul'] = 'Add Item in';
        $data['items'] = $this->items->read();
        $data['suppliers'] = $this->suppliers->read();
        $data['warehouses'] = $this->warehouses->read();
        $data['new_id'] = $this->get_transaction_code();
        $data['transactions']  = $this->item_ins->read_transaksi_order();
        $data['orders']  = $this->item_ins->read($where);
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item_in/add', $data);
        $this->load->view('template/footer');
    }

    public function get_transaction_code()
    {
        $new_id =  $this->item_ins->get_idmax()->result();
        // var_dump($new_id);
        if ($new_id > 0) {
            foreach ($new_id as $key) {
                $auto_id = $key->transaction_code;
            }
        }
        // echo $auto_id;
        return $this->item_ins->get_newid($auto_id, 'P');
        // echo $transaction_code;
    }
    public function save()
    {
        $result = array();
        $item_id = $_POST['item_id'];
        $in_date = $_POST['in_date'];
        $in_date_string = new DateTime($in_date);
        $supplier_id = $_POST['supplier_id'];
        $warehouse_id = $_POST['warehouse_id'];
        $item_total = $_POST['sisa_stok'];
        $total_price = $_POST['total_price'];
        $transaction_code = $_POST['transaction_code'];
        $parent_code = $_POST['parent_code'];
        // var_dump($item_code);
        $result = array();
        if (isset($_POST['parent_code'])) {
            for ($i = 0; $i < count($_POST['total_price']); $i++) {
                $order_date = new DateTime($_POST['order_date'][$i]);
                $now = new DateTime();
                $result = array(
                    'transaction_code' => $transaction_code,
                    'item_id' => $_POST['item_id'][$i],
                    'order_id' => $_POST['order_id'][$i],
                    'supplier_id' => $supplier_id,
                    'warehouse_id' => $warehouse_id,
                    'item_total' => $_POST['sisa_stok'][$i],
                    'total_price' => $_POST['total_price'][$i],
                    'parent_code' => $parent_code,
                    'in_date' => $in_date,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'lead_time' => date_diff($order_date, $in_date_string)->days
                );
                $this->db->insert('item_in_tb', $result);
                $result_item = array(
                    'newest_lead_time' => date_diff($order_date, $in_date_string)->days,
                    'newest_order_id' => $_POST['order_id'][$i],
                );
                $this->item_ins->update_item($result_item, $_POST['item_id'][$i],);
            }
            $result_transaction = array(
                'transaction_code' => $transaction_code,
                'type' => 'in',
                'supplier_id' => $supplier_id,
                'warehouse_id' => $warehouse_id,
                'parent_code' => $parent_code,
                'status' => 'stok_in',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('transactions', $result_transaction);
            // mengupdate status order setelah item in menjadi -> stok_in

            $result_transaction_order = array(
                'status' => 'done',
            );
            $this->item_ins->update($result_transaction_order, $parent_code);
            redirect(base_url('IteminController'));
        } else {
            redirect(base_url('IteminController/add'));
        }
    }
    public function accept_detail($id, $transaction_code)
    {
        $data['judul'] = 'Accept item in';
        $data['item_ins']  = $this->item_ins->read($transaction_code);
        $data['id'] = $id;
        $data['transaction_code'] = $transaction_code;
        $data['aksi'] = 'accept';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item_in/detail', $data);
        $this->load->view('template/footer');
    }
    public function reject_detail($id, $transaction_code)
    {
        $data['judul'] = 'Accept item in';
        $data['item_ins']  = $this->item_ins->read($transaction_code);
        $data['id'] = $id;
        $data['transaction_code'] = $transaction_code;
        $data['aksi'] = 'reject';
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('item_in/detail', $data);
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
        $this->item_ins->reject($result_transaction, $id);
        redirect(base_url('itemController'));
    }
    public function accept($id, $transaction_code)
    {
        $data['id'] = $id;
        $data['transaction_code'] = $transaction_code;
        $result_transaction = array(
            'description' => $this->input->post('description'),
            'status' => 'accepted',
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->item_ins->accept($result_transaction, $id);
        redirect(base_url('itemController'));
    }


    // public function delete($id, $code)
    // {
    //     $query = $this->item_ins->delete($id, $code);
    //     $query_transaksi = $this->item_ins->cek_transaksi($code);
    //     redirect(base_url('itemController'));
    // }
    // public function lihat($code)
    // {
    //     $query = $this->item_ins->cek_transaksi($code);
    //     echo $query;
    // }
}
