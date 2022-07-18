<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Model
{
    function create($input)
    {
        $this->db->insert('users', $input);
    }
    function read()
    {
        $this->db->select('*');
        $this->db->from('users');
        return $query = $this->db->get()->result();
    }
    function get($where = '')
    {
        $query = $this->db->query('select * from users ' . $where . ' ORDER BY id DESC');
        return $query->result_array();
    }
    function update($data, $where)
    {
        $this->db->where('id', $where);
        return $this->db->update('users', $data);
    }
    function delete($where)
    {
        $this->db->where('id', $where);
        return $this->db->delete('users');
    }
    function login_email($username, $password)
    {
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('users');
        return $query->result_array();
    }
    function login_username($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('users');
        return $query->result_array();
    }
}
