<?php

class M_dashboard extends CI_model
{
  public function profile($ppk)
  {
    $sql = $this->db->query('SELECT * FROM profile where ppk=?', [$ppk]);

    if ($sql->num_rows() > 0) {
      $data = $sql->result_array();
      return json_encode(array('response' => $data));
    } else {
      return json_encode(array('response' => 'data tidak ditemukan'));
    }
  }

  public function selectAll()
  {
    $sql = $this->db->query('SELECT * FROM profile');

    if ($sql->num_rows() > 0) {
      $data = $sql->result_array();
      return json_encode(array('response' => $data));
    } else {
      return json_encode(array('response' => 'data tidak ditemukan'));
    }
  }
}
