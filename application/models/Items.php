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
        $this->db->select('i.id, i.item_code, i.item_name, i.item_category_id, i.unit_id, i.stok, i.sku_number, i.buying_price, i.selling_price, i.used, c.category_name, u.unit_name, ');
        $this->db->from('items i');
        $this->db->join('categories c', 'c.id=i.item_category_id', 'left');
        $this->db->join('units u', 'u.id=i.unit_id', 'left');
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
