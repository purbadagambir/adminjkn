<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_controller
{

	public function index()
	{
		$title['title'] = 'Login';
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|valid_email');
		$this->form_validation->set_rules('password', 'Email', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/auth_header', $title);
			$this->load->view('v_login');
			$this->load->view('templates/auth_footer');
		} else {
			$this->_login();
		}
	}


	private function _login()
	{
		$email 	= $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('tb_users', ['email' => $email])->row_array();

		if ($user) {

			if ($user['activated'] == 'Y') {

				if (password_verify($password, $user['password'])) {
					$data = [
						'id'	=> $user['id'],
						'name'	=> $user['nama'],
						'email'	=> $user['email'],
						'role' 	=> $user['role'],
						'ppk' => $user['ppk']
					];
					$this->session->set_userdata($data);
					redirect('dashboard');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert !</strong> Password Wrong! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert !</strong> User Not activated! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert !</strong> E-Mail Not Registered! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('auth');
	}

	public function logout()
	{
		$this->session->sess_destroy();

		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert !</strong> You have been logged out! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('auth');
	}

	public function settingRs()
	{
		$data['ppk'] = $this->input->post('ppk');
		$data['nama_rs'] = $this->input->post('nama');
		$data['const_id'] = $this->input->post('constid');
		$data['secreet_key'] = $this->input->post('key');
		try {
			$this->db->replace('profile', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Alert !</strong> Hospital Profile Inserted! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		} catch (\Throwable $th) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Fail !</strong> ' . $th . ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
	}

	public function registration()
	{

		//$this->form_validation->set_rules('id_anggota','Id_Anggota','required|trim|is_unique[tb_users.id_anggota]',['is_unique'=>'User has already registred!' ]);
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_users.email]', [
			'is_unique' => 'E-mail has already registred!'
		]);
		$this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password Dont match',
			'min_length' => 'Password too Short!'
		]);
		$this->form_validation->set_rules('password2', 'password', 'required|trim|min_length[3]|matches[password1]');

		if ($this->form_validation->run() == false) {
			$title['title']	= 'Admin JKN User Registration';
			$this->load->view('templates/auth_header', $title);
			$this->load->view('v_registration');
			$this->load->view('templates/auth_footer');
		} else {
			$data = array(
				'nama' => htmlspecialchars($this->input->post('name')),
				'email' => htmlspecialchars($this->input->post('email')),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role' => 1,
				'activated' => 'N'
			);

			$this->db->insert('tb_users', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>Alert !</strong> Registration Success! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth/index');
		}
	}

	public function updatePassword()
	{
		$this->load->view('templates/header');
		userRole();
		$this->load->view('v_update_password');
		$this->load->view('templates/footer');
	}

	public function resetPassword()
	{
		$id = $this->session->userdata('id');
		$password1 = $this->input->post('password1');
		$password2 = $this->input->post('password2');

		$this->form_validation->set_rules('id', 'Id', 'trim|required');

		$this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password tidak sama',
			'min_length' => 'Password min 3 char!'
		]);
		$this->form_validation->set_rules('password2', 'password', 'required|trim|min_length[3]|matches[password1]');

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header');
			userRole();
			$this->load->view('v_update_password');
			$this->load->view('templates/footer');
		} else {
			$data = array('password' => password_hash($password1, PASSWORD_DEFAULT));
			$where = array('id' => $id);

			$this->m_users->updateUser($data, $where);

			$this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>Alert !</strong> Reset Password Success! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('dashboard');
		}
	}
}
