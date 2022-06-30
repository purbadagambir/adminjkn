<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operasi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		cekLogin();
	}

	public function index()
	{
		$head['header'] = 'Jadwal Operasi';
		$req['tanggalawal'] = date('Y-m-d');
		$req['tanggalakhir'] = date('Y-m-t');
		$request = json_encode($req);
		$data['list'] = $this->loadService(JKN_WS . 'operasi/rs', 'POST', $this->requestHeader(), $request);
		$this->load->view('templates/header', $head);
		userRole();
		$this->load->view('v_operasi', $data);
	}

	public function setTerlaksana()
	{
		$req['kodebooking'] = $this->input->post('kodebooking');
		$req['tanggalterlaksana'] = $this->input->post('tanggalterlaksana');
		$req['ppk'] = $this->session->userdata('ppk');
		$request = json_encode($req);
		$response['list'] = $this->loadService(JKN_WS . 'operasi/setTerlaksana', 'POST', $this->requestHeader(), $request);
		$res = json_decode($response['list']);

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
				'<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Success ! </strong>' . $res->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>'
			);
		}
		redirect('operasi');
	}

	public function searchPatient($type = 'operasi')
	{
		$head['header'] = 'Search Patient';
		$head['tipe'] = 'operasi';
		$this->load->view('templates/header', $head);
		userRole();
		$this->load->view('v_search');
		// $this->load->view('templates/footer');
	}

	public function newOperasi($rm, $name, $social)
	{
		$head['header'] = 'New Jadwal Operasi';
		$param['rm'] = $rm;
		$param['name'] = str_replace('%20', ' ', $name);
		$param['social'] = $social;

		$data['param'] = $param;
		$data['poli'] = $this->loadService(JKN_WS . 'poliklinik/getDataPoli/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');
		$this->load->view('templates/header', $head);
		userRole();
		$this->load->view('v_new_operasi', $data);
		// $this->load->view('templates/footer');
	}

	public function setOperasi()
	{
		$req['nopeserta'] = $this->input->post('nopeserta');
		$req['namapeserta'] = $this->input->post('namapeserta');
		$req['nomorrm'] = $this->input->post('nomorrm');
		$req['kodepoli'] = $this->input->post('kodepoli');
		$req['namapoli'] = '';
		$req['jenistindakan'] = $this->input->post('jenistindakan');
		$req['tanggaloperasi'] = date('Y-m-d', strtotime($this->input->post('tanggaloperasi')));
		$req['ppk'] = $this->session->userdata('ppk');

		$reques_data = json_encode($req);
		// echo $reques_data;
		$data = $this->loadService(JKN_WS . 'operasi/insert', 'POST', $this->requestHeader(), $reques_data);
		var_dump($data);
		$res = json_decode($data);
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
		redirect('operasi');
	}

	public function batalOperasi()
	{
		$req['kodebooking'] = $this->input->post('batal_kodebooking');
		$req['tanggalterlaksana'] = date('Y-m-d');
		$req['ppk'] = $this->session->userdata('ppk');
		$request = json_encode($req);
		$response['list'] = $this->loadService(JKN_WS . 'operasi/batalOperasi', 'POST', $this->requestHeader(), $request);
		$res = json_decode($response['list']);

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
				'<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Success ! </strong>' . $res->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>'
			);
		}
		redirect('operasi');
	}
}
