<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu_seeder extends CI_Model {
    private $table;

    public $seederName = 'Menu';

    public function __construct() {
        parent::__construct();
        $this->table = 'menus';
    }

    public function run(){
        $this->db->truncate($this->table);

        $data = array(
            'parent_id'     => null,
            'name'          => 'Dashboard',
            'slug'          => toSlug('Dashboard'),
            'icon'          => 'fa fa-chevron-right',
            'controller'    => 'Dashboard',
            'model'         => 'Dashboard_model',
            'sequence'      => 1,
            'created_at'    => timestamp(),
        );
        $this->db->insert($this->table, $data);
        $user = $this->db->insert_id();

        $data = array(
            'parent_id'     => NULL,
            'name'          => 'User Management',
            'slug'          => null,
            'icon'          => 'fa fa-folder',
            'controller'    => NULL,
            'model'         => NULL,
            'sequence'      => 1,
            'created_at'    => timestamp(),
        );
        $this->db->insert($this->table, $data);
        $user_management = $this->db->insert_id();

        $data = array(
            'parent_id'     => $user_management,
            'name'          => 'Users',
            'slug'          => toSlug('Users'),
            'icon'          => 'fa fa-chevron-right',
            'controller'    => 'Users',
            'model'         => 'Users_model',
            'sequence'      => 1,
            'created_at'    => timestamp(),
        );
        $this->db->insert($this->table, $data);
        $user = $this->db->insert_id();

        $data = array(
            'parent_id'     => $user_management,
            'name'          => 'Group',
            'slug'          => toSlug('Group'),
            'icon'          => 'fa fa-chevron-right',
            'controller'    => 'Group',
            'model'         => 'Group_model',
            'sequence'      => 1,
            'created_at'    => timestamp(),
        );
        $this->db->insert($this->table, $data);
        $group = $this->db->insert_id();
    }
}
