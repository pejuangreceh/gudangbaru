<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Model
{
    function create($input)
    {
        $this->db->insert('categories', $input);
    }
    function read()
    {
        $this->db->select('*');
        $this->db->from('categories');
        return $query = $this->db->get()->result();
    }
    function get($where = '')
    {
        $query = $this->db->query('select * from categories ' . $where . ' ORDER BY id DESC');
        return $query->result_array();
    }
    function update($data, $where)
    {
        $this->db->where('id', $where);
        return $this->db->update('categories', $data);
    }
    function delete($where)
    {
        $this->db->where('id', $where);
        return $this->db->delete('categories');
    }
}
