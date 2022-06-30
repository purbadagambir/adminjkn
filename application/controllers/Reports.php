<?php

/**
 * 
 */
class Reports extends CI_controller
{

	public function __construct()
	{
		parent::__construct();
		cekLogin();
	}


	public function printDataAnggota()
	{
		$data['list'] = $this->m_anggota->tampil_data();
		$this->load->view('templates/header');
		$this->load->view('reports/v_print_data_anggota', $data);
		$this->load->view('templates/print_footer');
	}

	public function printDataSilaturahmi()
	{
		$data['list'] = $this->m_silaturahmi->get_all_silaturahmi();
		$this->load->view('templates/header');
		$this->load->view('reports/v_print_data_Silaturahmi', $data);
		$this->load->view('templates/print_footer');
	}


	public function printDataWakaf()
	{
		$data['list'] = $this->m_wakaf->getDataAnggota();
		$this->load->view('templates/header');
		$this->load->view('reports/v_print_data_wakaf', $data);
		$this->load->view('templates/print_footer');
	}

	public function printIuranAnggota()
	{
		$id = $this->session->userdata('id');
		$whereanggota = array('id' => $id);

		/*$data['tIuran'] = $this->m_iuran->getTotalIuran($id);*/
		$data['list'] = $this->m_iuran->get_data_iuran_anggota($id);
		$this->load->view('templates/header');
		$this->load->view('reports/v_print_iuran_anggota', $data);
		$this->load->view('templates/print_footer');
	}

	public function printIuranWakafAnggota()
	{
		$id = $this->session->userdata('id');

		$data['list'] = $this->m_wakaf->getIuranWakaf($id);
		$data['list2'] = $this->m_wakaf->getDataWakaf($id);

		$this->load->view('templates/header');
		$this->load->view('reports/v_print_iuran_wakaf', $data);
		$this->load->view('templates/print_footer');
	}
}
