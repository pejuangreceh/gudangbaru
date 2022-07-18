<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customers extends CI_Model
{
    function create($input)
    {
        $this->db->insert('customers', $input);
    }
    function read()
    {
        $this->db->select('*');
        $this->db->from('customers');
        return $query = $this->db->get()->result();
    }
    function get($where = '')
    {
        $query = $this->db->query('select * from customers ' . $where . ' ORDER BY id DESC');
        return $query->result_array();
    }
    function update($data, $where)
    {
        $this->db->where('id', $where);
        return $this->db->update('customers', $data);
    }
    function delete($where)
    {
        $this->db->where('id', $where);
        return $this->db->delete('customers');
    }
}
