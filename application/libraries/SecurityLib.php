<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SecurityLib
{
    protected $_ci;
    protected $access;
    protected $delimiter;

    function __construct()
    {
        $this->_ci = &get_instance();

        $this->_ci->config->load('access', TRUE);
        $this->access = $this->_ci->config->item('menu', 'access');
        $this->delimiter = $this->_ci->config->item('delimiter', 'access');

        $this->_ci->load->model('Menu_model', 'menus');
    }

    public function check_access($action, $slug){
        $return = false;
        foreach ($this->_ci->menus->joinGroupMenu() as $key => $menu) {
            if ($menu->slug == $slug) {
                $accesses = explode($this->delimiter, $menu->access);
                if(in_array($action, $accesses)){
                    $return = true;
                }
            }
        }
        return $return;
    }
}

?>