<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GroupMenu_model extends CI_Model
{
    public $table = 'groups_menus';
    public $columns = array('group_id', 'menu_id', 'access');
    public $table_id = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function find($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function all()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();

        return $query->result();
    }

    public function roleLib($role_id, $menu_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('group_id', $role_id);
        $this->db->where('menu_id', $menu_id);
        $query = $this->db->get();

        return $query->result();
    }

    public function deleteByGroup($group_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->delete($this->table);
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
    }
}