<?php

class Migrate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
    }

    public function index()
    {
        if(!$this->migration->latest())
        {
            show_error($this->migration->error_string());
        } else {
            echo 'Migration successfully done. ' . PHP_EOL;
        }
    }

    public function version($version)
    {
        $migration = $this->migration->version($version);
        if (!$migration) {
            echo $this->migration->error_string();
        } else {
            echo 'Migration successfully done. ' . PHP_EOL;
        }
    }

}