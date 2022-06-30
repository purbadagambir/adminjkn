<?php

class M_users extends CI_model
{

	public function selectAll()
	{
		$sql = $this->db->query('SELECT * FROM tb_users');
		if ($sql->num_rows() > 0) {
			$data = $sql->result_array();
			return json_encode(array('response' => $data));
		} else {
			return json_encode(array('response' => 'data tidak ditemukan'));
		}
	}

	public function getUserData($id)
	{
		$sql = $this->db->query('SELECT *
									FROM tb_users
									WHERE id= ?', [$id]);
		if ($sql->num_rows() == 1) {
			$data = $sql->result_array();
			return json_encode(array('response' => $data));
		} else {
			return json_encode(array('response' => 'data tidak ditemukan'));
		}
	}

	public function updateUser($data, $where)
	{
		$this->db->where($where);
		$this->db->update('tb_users', $data);
	}

	public function deleteUser($id)
	{
		$sql = $this->db->query('DELETE from tb_users
								WHERE id_anggota=?', [$id]);
		if ($sql) {
			return 'Sukses';
		} else {
			return $this->db->error();
		}
	}
}
