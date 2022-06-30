<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CallingPad extends CI_Controller
{

    public function index()
    {
        $title['title'] = 'Calling Pad Poli';
        $this->load->view('templates/auth_header', $title);
        $this->load->view('v_calling_pad_poli');
        $this->load->view('templates/auth_footer');
    }
}
