<?php

class Antrean extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        cekLogin();
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('antrean/topbar');
        $this->load->view('antrean/v_client');
    }
}
