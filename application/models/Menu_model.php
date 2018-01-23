<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public $table = 'menus';
    public $name;
    public $slug;
    public $parent_id;
    public $icon;
    public $controller;
    public $model;
    public $sequence;
    public $active;
    public $created_at;
    public $updated_at;

    public function find($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->where('active', true);
        $query = $this->db->get();

        return $query->row();
    }

    public function all()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('active', true);
        $query = $this->db->get();

        return $query->result();
    }

    public function first()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('active', true);
        $query = $this->db->get();

        return $query->first_row();
    }

    /* for sidebar */
    public function getSidebar()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('active', true);
        $this->db->order_by('sequence', 'asc');
        $query = $this->db->get();

        return $query->result();
    }

    public function getBySlug($slug)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('slug', $slug);
        $this->db->where('active', true);
        $query = $this->db->get();

        return $query->first_row();
    }

    public function getTree()
    {
        $this->db->select('id, parent_id');
        $this->db->from($this->table);
        $this->db->where('active', true);
        $this->db->order_by('sequence', 'asc');
        $query = $this->db->get();

        return $query->result();
    }
}