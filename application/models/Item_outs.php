<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item_outs extends CI_Model
{
    function create($input)
    {
        $this->db->insert_batch('item_out_tb', $input);
    }
    function read($where)
    {
        $this->db->where('transaction_code', $where);
        $this->db->select('o.id, o.transaction_code, o.item_id, o.warehouse_id, o.item_total, o.total_price, o.status, i.item_name, s.warehouse_name, c.customer_name, i.buying_price ');
        $this->db->from('item_out_tb o');
        $this->db->join('items i', 'i.id=o.item_id', 'left');
        $this->db->join('warehouses s', 's.id=o.warehouse_id', 'left');
        $this->db->join('customers c', 'c.id=o.customer_id', 'left');
        $this->db->order_by('o.created_at', 'DESC');
        return $query = $this->db->get()->result();
    }
    function read_item_out($where)
    {
        $this->db->where('transaction_code', $where);
        $this->db->select('o.id, o.transaction_code, o.item_id, o.warehouse_id, o.item_total, o.total_price, o.status, i.item_name, w.warehouse_name, c.customer_name');
        $this->db->from('item_out_tb o');
        $this->db->join('items i', 'i.id=o.item_id', 'left');
        $this->db->join('warehouses w', 'w.id=o.warehouse_id', 'left');
        $this->db->join('customers c', 'c.id=o.customer_id', 'left');
        $this->db->order_by('o.created_at', 'DESC');
        return $query = $this->db->get()->result();
    }
    function read_per_transaksi($where)
    {
        $this->db->where('transaction_code', $where);
        $this->db->select('*');
        $this->db->from('transactions');
        $query = $this->db->get();
        return $result = $query->row();
    }
    function read_transaksi($where = 'out')
    {
        $this->db->where('type', $where);
        $this->db->select('t.id, t.transaction_code, t.warehouse_id, t.status, w.warehouse_name, c.customer_name, t.created_at');
        $this->db->from('transactions t');
        $this->db->join('warehouses w', 'w.id=t.warehouse_id', 'left');
        $this->db->join('customers c', 'c.id=t.customer_id', 'left');
        $this->db->order_by('t.created_at', 'DESC');
        return $query = $this->db->get()->result();
    }
    function read_transaksi_order($where = 'order', $where2 = 'accepted', $where3 = 'stok_in', $where4 = 'done')
    {
        $array = array('type' => $where, 'total_stok > ' => 0);
        $this->db->where($array);
        $this->db->where_in('status', [$where2, $where3, $where4]);
        $this->db->select('t.id, t.transaction_code, t.warehouse_id, t.status, s.warehouse_name');
        $this->db->from('transactions t');
        $this->db->join('warehouses s', 's.id=t.warehouse_id', 'left');
        return $query = $this->db->get()->result();
    }




    function get($where = '')
    {
        $query = $this->db->query('select * from item_out_tb ' . $where . ' ORDER BY id DESC');
        return $query->result_array();
    }
    function update($data, $where)
    {
        $this->db->where('transaction_code', $where);
        return $this->db->update('transactions', $data);
    }
    // function delete($where, $code)
    // {
    //     $this->db->where('id', $where);
    //     return $this->db->delete('item_out_tb');
    //     // pengecekkan row pada tabel order
    //     cek_transaksi($code);
    // }
    function cek_transaksi($where)
    {
        $query = $this->db->query('SELECT * FROM item_out_tb WHERE transaction_code = "' . $where . '"');
        $cek = $query->num_rows();
        if ($cek < 1) {
            $this->db->where('transaction_code', $where);
            return $this->db->delete('transactions');
        }
    }
    function reject($data, $where)
    {
        $this->db->where('id', $where);
        return $this->db->update('transactions', $data);
    }
    function accept($data, $where)
    {
        $this->db->where('id', $where);
        return $this->db->update('transactions', $data);
    }
    function accept_item_outs($data, $where)
    {
        $this->db->where('transaction_code', $where);
        return $this->db->update('item_out_tb', $data);
    }
    public function get_idmax()
    {
        $this->db->select_max('transaction_code');
        $this->db->from('transactions');
        $query = $this->db->get();
        return $query;
    }
    public function get_newid($auto_id, $prefix)
    {
        $newId = substr($auto_id, 1, 5);
        $tambah = (int)$newId + 1;
        if (strlen($tambah) == 1) {
            $transaction_code = $prefix . "0000" . $tambah;
        } else if (strlen($tambah) == 2) {
            $transaction_code = $prefix . "000" . $tambah;
        } else if (strlen($tambah) == 3) {
            $transaction_code = $prefix . "00" . $tambah;
        } else if (strlen($tambah) == 4) {
            $transaction_code = $prefix . "0" . $tambah;
        } else if (strlen($tambah) == 5) {
            $transaction_code = $prefix . $tambah;
        }
        return $transaction_code;
    }
}
