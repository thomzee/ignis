<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends CI_Model
{
    public $table = 'groups';
    public $columns = array('name', 'description');
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
        $this->db->where('deleted_at', null);
        $query = $this->db->get();

        return $query->row();
    }

    public function all()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('deleted_at', null);
        $query = $this->db->get();

        return $query->result();
    }

    public function sql()
    {
        $qColumns = implode(', ', $this->columns) . ', ' . $this->table_id;
        $this->db->select($qColumns);
        $this->db->from($this->table);
        $this->db->where('deleted_at', null);
        $return['queries'] = $this->db;
        $return['result'] = $this->db->get();

        return $return;
    }

    function datatables($dt)
    {
        $this->datatables->dt = $dt;
        $this->datatables->sql = $this->sql();
        $this->datatables->columns = $this->columns;

        return $this->datatables->generate();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function saveId($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $data);
    }

    public function delete($row)
    {
        $this->db->where($this->table_id, $row->id);
        $this->db->delete($this->table);
    }

    public function softDelete($row)
    {
        $data = array(
            'deleted_at' => timestamp(),
        );
        $this->db->where($this->table_id, $row->id);
        $this->db->update($this->table, $data);
    }
}