<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doctors extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		cekLogin();
	}

	public function index()
	{
		$head['header'] = 'Doctors';
		$data['list'] = $this->loadService(JKN_WS . 'dokter/list/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');
		$data['poli'] = $this->loadService(JKN_WS . 'poliklinik/getDataPoli/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');;
		$data['doctors'] = $this->dbemed->doctorData();
		$data['ruangan'] = $this->m_poliklinik->selectall();
		$this->load->view('templates/header', $head);
		userRole();
		$this->load->view('v_doctor', $data);
		// $this->load->view('templates/footer');
	}

	public function jadwal($id)
	{
		$head['header'] = 'Doctor Schedules';
		$data['list'] = $this->loadService(JKN_WS . 'dokter/jadwal/' . $id . '/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');;
		$this->load->view('templates/header', $head);
		userRole();
		$this->load->view('v_doctor_schedules', $data);
		$this->load->view('templates/footer');
	}

	public function synToEmed($kodedokter)
	{
		// jadwal($id, $ppk)
		$jadwal = $this->loadService(JKN_WS . 'dokter/jadwal/' . $kodedokter . '/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');
		// echo $jadwal;
		try {
			$jadwalemed = json_decode($this->dbemed->insertBPJS_DPJP_SCHEDULES($jadwal));
			if ($jadwalemed->metadata->code == 200) {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Sukses ! </strong> Data berhasil di sinkronisasi <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>'
				);
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal ! </strong> ' . $jadwalemed->metadata->message . ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>'
				);
			}
		} catch (\Throwable $th) {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal ! </strong>' . $th->getMessage() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
			);
		}

		redirect('doctors/jadwal/' . $kodedokter);
	}

	public function downloadJadwal()
	{
		$kodepoli = $this->input->post('kodepoli');
		$tanggal = $this->input->post('tanggal');
		# getJadwalHfis($kodepoli, $tanggal)
		$response = $this->loadService(JKN_WS . 'dokter/getJadwalHfis/' . $kodepoli . '/' . $tanggal, 'GET', $this->requestHeader(), '');

		$res = json_decode($response);
		if ($res->metadata->code == 200) {
			#getJadwalDokterPoli($kodepoli, $ppk, $hari) KODEPOLI='all' for all poli
			$hari = date('w', strtotime($tanggal));
			$jadwal = $this->loadService(JKN_WS . 'dokter/getJadwalDokterPoli/' . $kodepoli . '/' . $this->session->userdata('ppk') . '/' . $hari, 'GET', $this->requestHeader(), '');
			$jadwalEmed = json_decode($this->dbemed->insertBPJS_DPJP_SCHEDULES($jadwal));
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success ! </strong>' . $jadwalEmed->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
		redirect('doctors');
	}

	public function addToEmed($kodedokter)
	{
		try {
			$datadokter = $this->loadService(JKN_WS . 'dokter/datadokter/' . $kodedokter, 'GET', $this->requestHeader(), '');
			// var_dump($doctorData);
			$data = json_decode($datadokter);

			if ($data->response->doctor_no != 0) {
				$this->dbemed->insertBPJS_DPJP($datadokter);
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success ! </strong>' . $data->response->namadokter . ' Berhasil di Update<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>'
				);
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Fail ! </strong>' . $data->response->namadokter . ' Belum dipasangkan dengan data dokter E-Med<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>'
				);
			}
		} catch (\Throwable $th) {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Fail ! </strong> Message : ' . $th->getMessage() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>'
			);
		}
		redirect('doctors');
	}

	public function setInisial()
	{
		$kodedokter = $this->input->post('kodedokter');
		$data['kodedokter'] = $kodedokter;
		$data['inisialantrian'] = $this->input->post('inisialantrian');
		$data['doctor_no'] = $this->input->post('contact_no');
		$data['nama_ruangan'] = $this->session->userdata('nama_ruangan');
		$data['namapoli'] = $this->input->post('nama_ruangan');
		$data['ppk'] = $this->session->userdata('ppk');
		$request = json_encode($data);

		$response = $this->loadService(JKN_WS . 'dokter/setInisial', 'POST', $this->requestHeader(), $request);
		$res = json_decode($response);
		if ($res->metadata->code == 200) {
			try {
				$doctorData = $this->loadService(JKN_WS . 'dokter/datadokter/' . $kodedokter . '/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');
				$jadwal = $this->loadService(JKN_WS . 'dokter/jadwal/' . $kodedokter . '/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');

				$insert = $this->dbemed->insertBPJS_DPJP($doctorData);
				//$this->dbemed->insertBPJS_DPJP_SCHEDULES($jadwal);
				//json_decode($this->dbemed->insertBPJS_DPJP_SCHEDULES($jadwal));

				$response = json_decode($insert);
				$qms = json_decode($doctorData, true);

				//$qmsdata = $qms['response'];
				//$insert_qms = $this->db->replace('doctors', $qmsdata);

				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success ! </strong>' . $response->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>'
				);
			} catch (\Throwable $th) {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Fail ! </strong> Message : ' . $th->getMessage() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
				);
			}
		} else {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal ! </strong>' . $res->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
			);
		}
		redirect('doctors');
	}

	public function getJadwalHfis()
	{
		$kodepoli = $this->input->post('kodepoli');
		$startdate = strtotime($this->input->post('tanggal'));
		$endate = strtotime("+6 days", $startdate);
		$i = 0;
		while ($startdate < $endate) {
			$date = date('Y-m-d', $startdate);
			$host = ANTREAN_WS . 'jadwaldokter/kodepoli/' . $kodepoli . '/tanggal/' . $date;
			$response = $this->connectBPJS('GET', $host, '');
			// var_dump($response);
			$data = json_decode($response);
			if ($data->metadata->code == 200) {
				$this->loadService(JKN_WS . 'dokter/insertJadwalHfis', 'POST', $this->requestHeader(), $response);
			}
			$startdate = strtotime('+1 day', $startdate);
			$i++;
		}
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-secondary alert-dismissible fade show" role="alert"><strong>Information ! </strong> Looping time :' . $i . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>'
		);
		redirect('doctors');
	}
}
