<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modal
{
    protected $_ci;

    function __construct()
    {
        $this->_ci = &get_instance();
    }

    function views($template = NULL, $type = "form", $data = NULL)
    {
        if ($template != NULL) {
            if($type == "form"){
                echo $data['_modals_form'] = $this->_ci->load->view($template, $data, TRUE);
            }else{
                echo $data['_modals_action'] = $this->_ci->load->view($template, $data, TRUE);
            }
        }
    }
}

?>