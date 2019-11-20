<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Role_m extends CI_Model {

    public function get_all() {
        $data = $this->db->get('role')->result();

        return $data;
    }

    public function insert($data) {
        $result = $this->db->insert('role', $data);
        return $result;
    }

    public function get_by_id($id) {
        $data = $this->db->get_where('role', array('id' => $id))->row();
        return $data;
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $result = $this->db->update('role', $data);
        return $result;
    }

    public function delete($id) {
        $result = $this->db->delete('role', ['id' => $id]);
        return $result;
    }

}
