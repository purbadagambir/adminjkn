<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Medicalrecords extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
    }

    public function index()
    {
        $head['header'] = 'Alokasi Nomor Rekam Medik';
        $data['list'] = $this->loadService(JKN_WS . 'pasien/listrm/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');
        $this->load->view('templates/header', $head);
        userRole();
        $this->load->view('v_rm', $data);
        $this->load->view('templates/footer');
    }


    public function insert()
    {
        $rm = $this->input->post('rm');

        if (strlen($rm) == 6) {
            $insert_data = json_encode(array('norm' => $rm));
            $response = json_decode($this->loadService(JKN_WS . 'pasien/addrm/' . $this->session->userdata('ppk'), 'POST', $this->requestHeader(), $insert_data));
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert !</strong> ' . $response->metadata->message . ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert !</strong> No RM Harus 6 Digit! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
        redirect('medicalrecords');
    }

    public function delete($norm)
    {
        $delete_data = json_encode(array(
            'norm' => $norm,
            'ppk' => $this->session->userdata('ppk')
        ));
        $response = json_decode($this->loadService(JKN_WS . 'pasien/deleterm/' . $this->session->userdata('ppk'), 'POST', $this->requestHeader(), $delete_data));
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert !</strong> ' . $response->metadata->message . '! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('medicalrecords');
    }
}
