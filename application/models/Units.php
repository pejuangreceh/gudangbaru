<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Units extends CI_Model
{
    function create($input)
    {
        $this->db->insert('units', $input);
    }
    function read()
    {
        $this->db->select('*');
        $this->db->from('units');
        return $query = $this->db->get()->result();
    }
    function get($where = '')
    {
        $query = $this->db->query('select * from units ' . $where . ' ORDER BY id DESC');
        return $query->result_array();
    }
    function update($data, $where)
    {
        $this->db->where('id', $where);
        return $this->db->update('units', $data);
    }
    function delete($where)
    {
        $this->db->where('id', $where);
        return $this->db->delete('units');
    }
}
