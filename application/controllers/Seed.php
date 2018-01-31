<?php

class Seed extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('../seeds/menu_seeder');
        $this->load->library('../seeds/access_seeder');
    }

    public function index()
    {
        try{
            $this->menu_seeder->run();
            echo $this->menu_seeder->seederName . ' successfully seeded. ' . PHP_EOL;
            $this->access_seeder->run();
            echo $this->access_seeder->seederName . ' successfully seeded. ' . PHP_EOL;
        }catch (ErrorException $e){
            echo 'Something went wrong. ' . PHP_EOL;
        }
    }
}