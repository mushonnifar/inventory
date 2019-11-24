<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

    function authorize($username, $password) {
        $data = $this->db->get_where('user', array(
                    'username' => $username,
                    'password' => $password
                ))->row();
        return $data;
    }

    public function get_all() {
        $this->db->select('user.*, role.name as role_name');
        $this->db->from('user');
        $this->db->join('role', 'user.role_id = role.id', 'left');
        $data = $this->db->get();

        return $data->result();
    }

    public function insert($data) {
        $result = $this->db->insert('user', $data);
        return $result;
    }
    
    public function get_by_id($id) {
        $data = $this->db->get_where('user', array('id' => $id))->row();
        return $data;
    }
    
    public function update($id, $data) {
        $this->db->where('id', $id);
        $result = $this->db->update('user', $data);
        return $result;
    }
    
    public function delete($id) {
        $result = $this->db->delete('user', ['id' => $id]);
        return $result;
    }
}
