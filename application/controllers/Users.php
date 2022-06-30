<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		cekLogin();
	}

	public function index()
	{
		$head['header'] = 'Alokasi Nomor Rekam Medik';
		$data['ppk'] = $this->m_dashboard->selectAll();
		$data['userdata'] = $this->m_users->selectAll();
		$this->load->view('templates/header', $head);
		userRole();
		$this->load->view('admin/v_users', $data);
		// $this->load->view('templates/footer');
	}

	public function activateUser()
	{
		$id = $this->input->post('id_user');
		$ppk = $this->input->post('ppk');
		try {
			$this->db->query('UPDATE tb_users 
						 SET activated="Y",ppk=?
						 WHERE id=?', [$ppk, $id]);
			$this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>Alert !</strong> Update User Role Success! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		} catch (\Throwable $th) {
			$this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>Fail !</strong> Update with Error : ' . $th . ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('users');
	}

	public function detailData($id)
	{
		$data['list'] = $this->m_users->getUserData($id);
		$this->load->view('templates/header');
		userRole();
		$this->load->view('admin/v_edit_data_user', $data);
		$this->load->view('templates/footer');
	}

	public function editUser()
	{
		$id = $this->input->post('id');
		$role = $this->input->post('role');

		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		$this->form_validation->set_rules('id', 'Id', 'trim|required');

		if ($this->form_validation->run() == true) {
			$data = array('role' => $role);
			$where = array('id' => $id);

			$this->m_users->updateUser($data, $where);

			$this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>Alert !</strong> Update User Role Success! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('users');
		} else {
			$this->load->view('templates/header');
			userRole();
			$this->load->view('admin/v_edit_data_user');
			$this->load->view('templates/footer');
		}
	}

	public function delUser($id)
	{
		$result = $this->m_users->deleteUser($id);
		$this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>Alert !</strong> Delete User Role ' . $result . '! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('users');
	}
}
