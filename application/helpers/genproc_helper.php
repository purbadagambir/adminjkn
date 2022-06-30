
<?php

if (!function_exists('cekLogin')) {
	function cekLogin()
	{
		$CI = &get_instance();
		if (($CI->session->userdata('role') == null) || ($CI->session->userdata('ppk') == null)) {
			$CI->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert !</strong> Login First! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect(base_url());
		}
	}
	$CI = '';
}

if (!function_exists('userRole')) {
	function userRole()
	{
		$CI = &get_instance();
		$role = $CI->session->userdata('role');
		if ($role == 0) {
			return $CI->load->view('templates/sidebar');
		} elseif ($role == 1) {
			return $CI->load->view('templates/sidebar');
		} else {
			$CI->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert !</strong> Role Not Registered! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect(base_url());
		}
		$CI = '';
	}
}

?>