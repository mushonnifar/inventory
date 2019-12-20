<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Role_menu_m extends CI_Model {

    public function get_privilege($id) {
        $data = $this->db->get_where('role_has_menu', array('role_id' => $id))->result();

        return $data;
    }

    public function insert_batch($data) {
        $result = $this->db->insert_batch('role_has_menu', $data);

        return $result;
    }

    public function delete_by_role($role_id) {
        $result = $this->db->delete('role_has_menu', ['role_id' => $role_id]);

        return $result;
    }

    public function check_auth($link, $action) {
        $this->db->select('role_has_menu.id');
        $this->db->from('role_has_menu');
        $this->db->join('menu', 'role_has_menu.menu_id = menu.id');
        $this->db->join('user', 'role_has_menu.role_id = user.role_id');
        $this->db->where('user.id', $this->session->userdata('id_user'));
        $this->db->where('role_has_menu.' . $action, 'y');
        $this->db->where('menu.link', $link);
        $data = $this->db->get();
        
        return $data->num_rows();
    }

}
