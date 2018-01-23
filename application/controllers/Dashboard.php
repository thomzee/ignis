<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->data['view'] = 'dashboard/index';
        $this->data['menu'] = 'Dashboard';
        $this->data['breadcrumbs'] = 'Dashboard';
        $this->data['slug'] = 'dashboard';
    }

    public function index()
    {
        $this->template->views($this->data['view'], $this->data);
    }
}
