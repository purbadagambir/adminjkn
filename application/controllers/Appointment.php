<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appointment extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
    }

    public function index()
    {
        $data['header'] = 'Appointment';
        $data['list'] = $this->loadService(JKN_WS . 'antrean/kodeppk', 'GET', $this->requestHeader(), '');
        $this->load->view('templates/header', $data);
        userRole();
        $this->load->view('v_appointment');
        $this->load->view('templates/footer');
    }

    public function downloadAppointment()
    {
        $data = $this->loadService(JKN_WS . 'antrean/kodeppk', 'GET', $this->requestHeader(), '');
        $result = $this->dbemed->insertAppointment($data);

        $res = json_decode($result);
        if ($res->metadata->code == 200) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success ! </strong>' . $res->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal ! </strong>' . $res->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
            );
        }

        redirect('appointment');
    }

    public function getJadwalDokter()
    {
        # public function getJadwalDokterPoli($kodepoli, $ppk, $hari);
        $poli = $this->input->post('poli');
        $tanggal = $this->input->post('tanggal');

        $hari = date('w', strtotime($tanggal));

        echo $this->loadService(JKN_WS . 'dokter/getJadwalDokterPoli/' . $poli . '/' . $this->session->userdata('ppk') . '/' . $hari, 'GET', $this->requestHeader(), '');
        return;
    }

    public function getjampraktek()
    {
        #   public function getJamPraktek($kodedokter, $kodepoli, $hari, $ppk)
        $kodedokter = $this->input->post('kodedokter');
        $kodepoli = $this->input->post('kodepoli');
        $tanggal = $this->input->post('tanggal');
        $hari = date('w', strtotime($tanggal));

        // echo $kodedokter . '-' . $kodepoli;
        echo $this->loadService(JKN_WS . 'dokter/getJamPraktek/' . $kodedokter . '/' . $kodepoli . '/' . $hari . '/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');
        return;
    }

    public function searchPatient($tipe = '')
    {
        $head['header'] = 'Search Patient';
        $head['tipe'] = 'appointment';
        $this->load->view('templates/header', $head);
        userRole();
        $this->load->view('v_search');
        // $this->load->view('templates/footer');
    }

    public function searchPatientByOpt()
    {
        $opt = $this->input->post('opt');
        $param = $this->input->post('param');

        echo $this->dbemed->getPatienDataRm($opt, $param);
        return;
    }

    public function newAppointment($rm, $name, $social)
    {
        $param['rm'] = $rm;
        $param['name'] = str_replace('%20', ' ', $name);
        $param['social'] = $social;

        $head['header'] = 'New Appointment';
        $data['param'] = $param;
        $data['poli'] = $this->loadService(JKN_WS . 'poliklinik/getDataPoli/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');
        $this->load->view('templates/header', $head);
        userRole();
        $this->load->view('v_new_appointment', $data);
        // $this->load->view('templates/footer');
    }

    public function setAppointment()
    {
        $req['nomorkartu'] = $this->input->post('nomorkartu');
        $req['nik'] = '';
        $req['namapeserta'] = $this->input->post('namapeserta');
        $req['kodepoli'] = $this->input->post('kodepoli');
        $req['norm'] = $this->input->post('norm');
        $req['tanggalperiksa'] = date('Y-m-d', strtotime($this->input->post('tanggalperiksa')));
        $req['kodedokter'] = $this->input->post('kodedokter');
        $req['jampraktek'] = $this->input->post('jampraktek');
        $req['jeniskunjungan'] = '1';
        $req['nomorreferensi'] = $this->input->post('nomorreferensi');

        $reques_data = json_encode($req);
        $data = $this->loadService(JKN_WS . 'antrean/getAntreanRs', 'POST', $this->requestHeader(), $reques_data);

        $res = json_decode($data);
        if ($res->metadata->code == 200) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success ! </strong>' . $res->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
            );
            redirect('appointment');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal ! </strong>' . $res->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
            );
            $this->newAppointment($this->input->post('norm'), $this->input->post('namapeserta'), $this->input->post('nomorkartu'));
        }
    }

    public function delete($kodebooking)
    {

        $data['kodebooking'] = $kodebooking;
        $data['keterangan'] = 'Batal oleh user RS ' . $this->session->userdata('name');

        $request_data = json_encode($data);

        $response = $this->loadService(JKN_WS . 'antrean/batal', 'POST', $this->requestHeader(), $request_data);
        $res = json_decode($response);
        // var_dump($response);
        if ($res->metadata->code == 200) {
            $this->dbemed->deleteAppointment($request_data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success ! </strong>' . $res->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
            );
            redirect('appointment');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal ! </strong>' . $res->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
            );
            $this->newAppointment($this->input->post('norm'), $this->input->post('namapeserta'), $this->input->post('nomorkartu'));
        }
        return;
    }
}
