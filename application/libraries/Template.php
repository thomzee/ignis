<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{
    protected $_ci;

    function __construct()
    {
        $this->_ci = &get_instance();
    }

    function views($template = NULL, $data = NULL)
    {
        if ($template != NULL) {
            # head
            $data['_styles'] = $this->_ci->load->view('layouts/styles', $data, TRUE);
            $data['_scripts'] = $this->_ci->load->view('layouts/scripts', $data, TRUE);
            $data['_meta'] = $this->_ci->load->view('layouts/meta', $data, TRUE);

            # main
            $data['_header'] = $this->_ci->load->view('layouts/header', $data, TRUE);
            $data['_flash'] = $this->_ci->load->view('layouts/flash', $data, TRUE);
            $data['_sidebar'] = $this->_ci->load->view('layouts/sidebar', $data, TRUE);
            $data['_footer'] = $this->_ci->load->view('layouts/footer', $data, TRUE);
            $data['_right'] = $this->_ci->load->view('layouts/right', $data, TRUE);

            # content
            $data['_content'] = $this->_ci->load->view($template, $data, TRUE);

            echo $data['_app'] = $this->_ci->load->view('layouts/app', $data, TRUE);
        }
    }
}

?>