<?php
defined('BASEPATH') or exit('No direct script access allowed');

# Database Emed Di load di Class Controller
class Dashboard extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		cekLogin();
	}

	public function index()
	{
		$head['header'] = 'Dashboard';
		$data['profile'] = $this->m_dashboard->profile($this->session->userdata('ppk'));
		//$data['rs'] = $this->getProfileData();
		$this->load->view('templates/header', $head);
		userRole();
		$this->load->view('v_dashboard', $data);
		// $this->load->view('templates/footer');
	}

	public function patientInfo()
	{
		echo $this->dbemed->patientInfo();
		return;
	}

	public function quesData()
	{
		echo $this->dbemed->quesData();
		return;
	}

	public function admissionData()
	{
		echo $this->dbemed->admissionData();
		return;
	}

	public function getJadwalPoli()
	{
		$hari = date('w');
		$poli = 'all';
		echo $this->loadService(JKN_WS . 'dokter/getJadwalDokterPoli/' . $poli . '/' . $this->session->userdata('ppk') . '/' . $hari, 'GET', $this->requestHeader(), '');
		return;
	}

	#countAppointment($ppk)
	public function countAppointment()
	{
		///echo $this->loadService(JKN_WS . 'antrean/countAppointment/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');
		echo $this->dbemed->appoinmentData();
		return;
	}

	public function registerWs()
	{
		$data['ppk'] = $this->input->post('ws_ppk');
		$data['name'] = $this->input->post('ws_name');
		$data['user_id'] = $this->input->post('ws_user_id');
		$data['const_id'] = $this->input->post('ws_const_id');
		$data['secreet_key'] = $this->input->post('ws_secreet_key');

		$request = json_encode($data);
		$response = $this->loadService(JKN_WS . 'token/newtoken', 'POST', $this->requestHeader(), $request);
		$res = json_decode($response);
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
		redirect('dashboard');
		return;
	}

	public function waktuTunggutoday()
	{
		$head['header'] = 'Dashboard';
		$data['profile'] = $this->m_dashboard->profile($this->session->userdata('ppk'));
		$this->load->view('templates/header', $head);
		userRole();
		$data['list'] = $this->dbemed->TaskData();
		$this->load->view('v_task', $data);
		$this->load->view('templates/footer');
	}

	public function waktutunggu()
	{
		$head['header'] = 'Dashboard';
		$data['profile'] = $this->m_dashboard->profile($this->session->userdata('ppk'));
		$this->load->view('templates/header', $head);
		userRole();
		// $data['list'] = $this->dbemed->TaskData();
		$this->load->view('v_waiting_time', $data);
		// $this->load->view('templates/footer');
	}

	public function waktuTunggubyHari()
	{
		$head['header'] = 'Dashboard';
		$data['profile'] = $this->m_dashboard->profile($this->session->userdata('ppk'));
		$this->load->view('templates/header', $head);
		userRole();
		// $data['list'] = $this->dbemed->TaskData();
		$this->load->view('v_waiting_time_byDate', $data);
		// $this->load->view('templates/footer');
	}

	public function sendingstatus()
	{
		$head['header'] = 'Dashboard';
		$data['profile'] = $this->m_dashboard->profile($this->session->userdata('ppk'));
		$this->load->view('templates/header', $head);
		userRole();
		$data['list'] = $this->dbemed->TaskData();
		$this->load->view('v_sending_status', $data);
		// $this->load->view('templates/footer');
	}

	public function waktuTungguByMonth()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$waktu = $this->input->post('waktu');

		$response = $this->connectBPJSnoEncrypt('GET', ANTREAN_WS . 'dashboard/waktutunggu/bulan/' . $bulan . '/tahun/' . $tahun . '/waktu/' . $waktu);
		echo $response;
		return;
	}

	public function waktuTungguByDate()
	{
		$tanggal = $this->input->post('tanggal');
		$waktu = $this->input->post('waktu');

		$response = $this->connectBPJSnoEncrypt('GET', ANTREAN_WS . 'dashboard/waktutunggu/tanggal/' . $tanggal . '/waktu/' . $waktu);
		echo $response;
		// $data['tanggal'] = $tanggal;
		// $data['waktu'] = $waktu;
		// echo json_encode($data);
		return;
	}
}
