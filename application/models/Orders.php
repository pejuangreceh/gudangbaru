<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Model
{
    function create($input)
    {
        $this->db->insert_batch('order_tb', $input);
    }
    function read($where)
    {
        $this->db->where('transaction_code', $where);
        $this->db->select('o.id, o.transaction_code, o.item_id, o.supplier_id, o.item_total, o.total_price, o.status, o.sisa_stok, i.item_name, s.supplier_name ');
        $this->db->from('order_tb o');
        $this->db->join('items i', 'i.id=o.item_id', 'left');
        $this->db->join('suppliers s', 's.id=o.supplier_id', 'left');
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
    function read_transaksi($where = 'order')
    {
        $this->db->where('type', $where);
        $this->db->select('t.id, t.transaction_code, t.supplier_id, t.status, s.supplier_name, t.created_at');
        $this->db->from('transactions t');
        $this->db->join('suppliers s', 's.id=t.supplier_id', 'left');
        $this->db->order_by('t.created_at', 'DESC');
        return $query = $this->db->get()->result();
    }

    function get($where = '')
    {
        $query = $this->db->query('select * from order_tb ' . $where . ' ORDER BY id DESC');
        return $query->result_array();
    }
    // function update($data, $where)
    // {
    //     $this->db->where('id', $where);
    //     return $this->db->update('order_tb', $data);
    // }
    // function delete($where, $code)
    // {
    //     $this->db->where('id', $where);
    //     return $this->db->delete('order_tb');
    //     // pengecekkan row pada tabel order
    //     cek_transaksi($code);
    // }
    function cek_transaksi($where)
    {
        $query = $this->db->query('SELECT * FROM order_tb WHERE transaction_code = "' . $where . '"');
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
    function accept_orders($data, $where)
    {
        $this->db->where('transaction_code', $where);
        return $this->db->update('order_tb', $data);
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
