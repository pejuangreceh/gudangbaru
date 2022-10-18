<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item_ins extends CI_Model
{
    function create($input)
    {
        $this->db->insert_batch('order_tb', $input);
    }
    function read($where)
    {
        $this->db->where('transaction_code', $where);
        $this->db->where('o.sisa_stok >', 0);
        $this->db->select('o.id, o.transaction_code, o.item_id, o.supplier_id, o.item_total, o.total_price, o.status, o.sisa_stok, o.in_date, i.item_name, s.supplier_name, i.buying_price ');
        $this->db->from('order_tb o');
        $this->db->join('items i', 'i.id=o.item_id', 'left');
        $this->db->join('suppliers s', 's.id=o.supplier_id', 'left');
        return $query = $this->db->get()->result();
    }
    function read_item_in($where)
    {
        $this->db->where('transaction_code', $where);
        $this->db->select('o.id, o.transaction_code, o.item_id, o.supplier_id, o.item_total, o.total_price, o.in_date, i.item_name, s.supplier_name, w.warehouse_name ');
        $this->db->from('item_in_tb o');
        $this->db->join('items i', 'i.id=o.item_id', 'left');
        $this->db->join('suppliers s', 's.id=o.supplier_id', 'left');
        $this->db->join('warehouses w', 'w.id=o.warehouse_id', 'left');
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
    function read_transaksi($where = 'in')
    {
        $this->db->where('type', $where);
        $this->db->select('t.id, t.transaction_code, t.supplier_id, t.status, s.supplier_name, w.warehouse_name, t.created_at');
        $this->db->from('transactions t');
        $this->db->join('suppliers s', 's.id=t.supplier_id', 'left');
        $this->db->join('warehouses w', 'w.id=t.warehouse_id', 'left');
        $this->db->order_by('t.created_at', 'DESC');
        return $query = $this->db->get()->result();
    }
    function read_list_slow_moving($periode = NULL)
    {
        if (($periode == NULL) || ($periode == 'week')) {
            $startDate = date('Y-m-d H:i:s', strtotime("-3 days"));
        } elseif ($periode == 'month') {
            $startDate = date('Y-m-d H:i:s', strtotime("-30 days"));
        } elseif ($periode == 'month_3') {
            $startDate = date('Y-m-d H:i:s', strtotime("-90 days"));
        }
        $endDate   = date('Y-m-d H:i:s', strtotime("now"));
        if (($periode != NULL)) {
            $this->db->where('i.in_date >=', $startDate);
            $this->db->where('i.in_date <=', $endDate);
        }
        $this->db->select('*, sum(i.item_total) as total, count(i.item_total) as total_transaction ,s.item_name, s.item_code');
        $this->db->from('item_in_tb i');
        $this->db->join('items s', 's.id=i.item_id', 'left');
        $this->db->group_by('i.item_id');
        $this->db->order_by('total', 'ASC');
        return $query = $this->db->get()->result();
    }
    function read_transaksi_order($where = 'order', $where2 = 'accepted', $where3 = 'stok_in', $where4 = 'done')
    {
        $array = array('type' => $where, 'total_stok > ' => 0);
        $this->db->where($array);
        $this->db->where_in('status', [$where2, $where3, $where4]);
        $this->db->select('t.id, t.transaction_code, t.supplier_id, t.status, s.supplier_name');
        $this->db->from('transactions t');
        $this->db->join('suppliers s', 's.id=t.supplier_id', 'left');
        return $query = $this->db->get()->result();
    }




    function get($where = '')
    {
        $query = $this->db->query('select * from order_tb ' . $where . ' ORDER BY id DESC');
        return $query->result_array();
    }
    function update($data, $where)
    {
        $this->db->where('transaction_code', $where);
        return $this->db->update('transactions', $data);
    }
    function update_item($data, $where)
    {
        $this->db->where('id', $where);
        return $this->db->update('items', $data);
    }
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
