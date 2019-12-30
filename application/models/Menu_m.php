<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_m extends CI_Model {

    public function get_parent() {
        $data = $this->db->get_where('menu', array('parent' => 0))->result_array();
        return $data;
    }

    public function get_child() {
        $data = $this->db->get_where('menu', array('parent !=' => 0))->result_array();
        return $data;
    }

    public function get_all() {
        $data = $this->db->get('menu')->result();

        return $data;
    }

    public function insert($data) {
        $result = $this->db->insert('menu', $data);
        return $result;
    }

    public function get_by_id($id) {
        $data = $this->db->get_where('menu', array('id' => $id))->row();
        return $data;
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $result = $this->db->update('menu', $data);
        return $result;
    }

    public function delete($id) {
        $result = $this->db->delete('menu', ['id' => $id]);
        return $result;
    }

    public function get_parent_by_role($role_id) {
        $this->db->select('tb1.*');
        $this->db->from('menu as tb1');
        $this->db->join('role_has_menu tb2', 'tb1.id = tb2.menu_id');
        $this->db->where('tb1.parent', 0);
        $this->db->where('tb2.`read`', 'y');
        $this->db->where('tb2.role_id', $role_id);
        return $this->db->get()->result_array();
    }

    public function get_child_by_role($role_id) {
        $this->db->select('tb1.*');
        $this->db->from('menu as tb1');
        $this->db->join('role_has_menu tb2', 'tb1.id = tb2.menu_id');
        $this->db->where('tb1.parent !=', 0);
        $this->db->where('tb2.`read`', 'y');
        $this->db->where('tb2.role_id', $role_id);
        return $this->db->get()->result_array();
    }
}
