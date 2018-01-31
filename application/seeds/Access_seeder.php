<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Access_seeder extends CI_Model
{
    private $table;
    private $access;
    private $delimiter;

    public $seederName = 'Access';

    public function __construct()
    {
        parent::__construct();
        $this->table = 'groups_menus';

        $this->load->model('Menu_model', 'menu');
        $this->load->model('group/Group_model', 'group');

        $this->config->load('access', TRUE);
        $this->access = $this->config->item('menu', 'access');
        $this->delimiter = $this->config->item('delimiter', 'access');
    }

    public function run(){
        $this->db->truncate($this->table);

        foreach ($this->menu->seederAccess() as $key => $menu) {
            $data = array(
                'group_id' => 1,
                'menu_id' => $menu->id,
                'access' => implode($this->delimiter, $this->access[$menu->slug]['action'])
            );

            $this->db->insert($this->table, $data);
        }
    }
}