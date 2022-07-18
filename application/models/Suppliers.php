<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Suppliers extends CI_Model
{
    function create($input)
    {
        $this->db->insert('suppliers', $input);
    }
    function read()
    {
        $this->db->select('*');
        $this->db->from('suppliers');
        return $query = $this->db->get()->result();
    }
    function get($where = '')
    {
        $query = $this->db->query('select * from suppliers ' . $where . ' ORDER BY id DESC');
        return $query->result_array();
    }
    function update($data, $where)
    {
        $this->db->where('id', $where);
        return $this->db->update('suppliers', $data);
    }
    function delete($where)
    {
        $this->db->where('id', $where);
        return $this->db->delete('suppliers');
    }
}
