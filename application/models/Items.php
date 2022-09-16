<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Items extends CI_Model
{
    function create($input)
    {
        $this->db->insert('items', $input);
    }
    function read()
    {
        $startDate = date('Y-m-d H:i:s', strtotime("-30 days"));
        $endDate   = date('Y-m-d H:i:s', strtotime("now"));
        $this->db->select('i.id, i.item_code, i.item_name, i.item_category_id, i.unit_id, i.stok,i.newest_lead_time, i.sku_number, i.buying_price, i.selling_price, i.used, c.category_name, u.unit_name,n.avg_lead_time,n.max_lead_time,o.highest,o.avg');
        $this->db->from('items i');
        $this->db->join('categories c', 'c.id=i.item_category_id', 'left');
        $this->db->join('units u', 'u.id=i.unit_id', 'left');
        $this->db->join("(SELECT item_id, item_total, avg(item_total) as avg, max(item_total) as highest,created_at FROM item_out_tb WHERE created_at >= '$startDate' AND created_at <= '$endDate')  as o", 'o.item_id=i.id', 'left');
        $this->db->join("(SELECT item_id, avg(lead_time) as avg_lead_time, max(lead_time) as max_lead_time FROM item_in_tb WHERE lead_time != 0 GROUP BY item_id) as n", 'n.item_id=i.id', 'left');
        return $query = $this->db->get()->result();
    }
    function read_out()
    {
        $this->db->where('i.stok > ', 0);
        $this->db->select('i.id, i.item_code, i.item_name, i.item_category_id, i.unit_id, i.stok, i.sku_number, i.buying_price, i.selling_price, i.used, c.category_name, u.unit_name, ');
        $this->db->from('items i');
        $this->db->join('categories c', 'c.id=i.item_category_id', 'left');
        $this->db->join('units u', 'u.id=i.unit_id', 'left');
        return $query = $this->db->get()->result();
    }
    function get($where = '')
    {
        $query = $this->db->query('select * from items ' . $where . ' ORDER BY id DESC');
        return $query->result_array();
    }
    function update($data, $where)
    {
        $this->db->where('id', $where);
        return $this->db->update('items', $data);
    }
    function delete($where)
    {
        $this->db->where('id', $where);
        return $this->db->delete('items');
    }
}
