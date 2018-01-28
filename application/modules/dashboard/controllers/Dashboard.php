<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->data['menu'] = 'Dashboard';

        $this->data['view'] = 'dashboard';
        $this->data['slug'] = 'dashboard';
    }

    public function index()
    {
        $this->template->views($this->data['view'].'/index', $this->data);
    }
}
