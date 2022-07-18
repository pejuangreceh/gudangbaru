<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warehouses extends CI_Model
{
    function create($input)
    {
        $this->db->insert('warehouses', $input);
    }
    function read()
    {
        $this->db->select('*');
        $this->db->from('warehouses');
        return $query = $this->db->get()->result();
    }
    function get($where = '')
    {
        $query = $this->db->query('select * from warehouses ' . $where . ' ORDER BY id DESC');
        return $query->result_array();
    }
    function update($data, $where)
    {
        $this->db->where('id', $where);
        return $this->db->update('warehouses', $data);
    }
    function delete($where)
    {
        $this->db->where('id', $where);
        return $this->db->delete('warehouses');
    }
}
