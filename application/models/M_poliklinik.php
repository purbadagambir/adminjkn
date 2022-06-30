<?php

class M_poliklinik extends CI_model
{

    public function selectAll()
    {
        $sql = $this->db->query('SELECT * FROM ruangan');

        if ($sql->num_rows() > 0) {
            $data = $sql->result_array();
            return json_encode(array('response' => $data));
        } else {
            return json_encode(array('response' => null));
        }
    }

    public function insert($data)
    {
        try {
            $this->db->insert('ruangan', $data);
            return json_encode(array('response' => true));
        } catch (\Throwable $th) {
            return json_encode(array('response' => $th->getMessage()));
        }
    }

    public function delete($where)
    {
        try {
            $this->db->delete('ruangan', $where);
            return json_encode(array('response' => true));
        } catch (\Throwable $th) {
            return json_encode(array('response' => $th->getMessage()));
        }
    }
}
