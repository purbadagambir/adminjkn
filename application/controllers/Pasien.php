<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
    }

    public function index()
    {
        $head['header'] = 'Pasien';
        $data['list'] = $this->loadService(JKN_WS . 'pasien/list/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');
        $this->load->view('templates/header', $head);
        userRole();
        $this->load->view('v_pasien', $data);
    }

    public function deletePasien($rm)
    {
        $head['header'] = 'Pasien';
        $data['list'] = $this->loadService(JKN_WS . 'pasien/list/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');
        $this->load->view('templates/header', $head);
        userRole();
        $this->load->view('v_pasien', $data);
    }

    public function insert()
    {
        $insertpatient = FALSE;
        $nokartu = $this->input->post('nokartu');
        $cek = $this->dbemed->selectPatient($nokartu);
        if ($cek['jml'] == 0) {
            $patientdata = $this->loadService(JKN_WS . 'pasien/selectnokartu/' . $nokartu, 'GET', '', '');
            $insertpatient = $this->dbemed->insertPatient($patientdata);
            if ($insertpatient == true) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success ! </strong> Insert Success. <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>'
                );
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal ! </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>'
                );
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal ! </strong>' . $insertpatient . ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
            );
        }

        redirect('pasien');
    }
}
