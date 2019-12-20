<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('role_m');
        $this->load->model('role_menu_m');
        $this->load->model('menu_m');
        if (!$this->session->userdata('is_login')) {
            redirect('login');
        }
    }

    public function index() {
        if (!$this->auth->privilege_check('role', 'read')) {
            $this->auth->no_access();
        }
        $role = $this->role_m->get_all();

        $this->template->load('pages/role/index', ['data' => $role]);
    }

    public function create() {
        if (!$this->auth->privilege_check('role', 'create')) {
            $this->auth->no_access();
        }
        $this->template->load('pages/role/create');
    }

    public function store() {
        $post = $this->input->post();

        $result = $this->role_m->insert($post);
        if ($result) {
            redirect('role');
        }
    }

    public function edit($id) {
        if (!$this->auth->privilege_check('role', 'update')) {
            $this->auth->no_access();
        }
        $role = $this->role_m->get_by_id($id);

        $this->template->load('pages/role/edit', ['data' => $role]);
    }

    public function update($id) {
        $post = $this->input->post();

        $result = $this->role_m->update($id, $post);
        if ($result) {
            redirect('role');
        }
    }

    public function delete($id) {
        if (!$this->auth->privilege_check('role', 'delete')) {
            $this->auth->no_access();
        }
        $result = $this->role_m->delete($id);
        if ($result) {
            redirect('role');
        }
    }

    public function config($id) {
        if (!$this->auth->privilege_check('role', 'create')) {
            $this->auth->no_access();
        }
        $role = $this->role_m->get_by_id($id);
        $menu = $this->template->get_menu();
        $role_menu = $this->role_menu_m->get_privilege($id);
        $table = '';
        foreach ($menu as $value) {
            $privilege = $this->set_privilege($role_menu, $value['id']);
            $table .= '<tr>';
            $table .= '<td><b>' . $value['name'] . '</b></td>';
            if (count($value['child']) > 0) {
                $table .= '<td><input name="read[' . $value['id'] . ']" value="y" type="checkbox" ' . $privilege['read'] . '></td>';
                $table .= '<td></td><td></td><td></td>';
            } else {
                $table .= '<td><input name="read[' . $value['id'] . ']" value="y" type="checkbox" ' . $privilege['read'] . '></td>';
                $table .= '<td><input name="create[' . $value['id'] . ']" value="y" type="checkbox" ' . $privilege['create'] . '></td>';
                $table .= '<td><input name="update[' . $value['id'] . ']" value="y" type="checkbox" ' . $privilege['update'] . '></td>';
                $table .= '<td><input name="delete[' . $value['id'] . ']" value="y" type="checkbox" ' . $privilege['delete'] . '></td>';
            }

            $table .= '</tr>';
            foreach ($value['child'] as $k => $v) {
                $privilege = $this->set_privilege($role_menu, $v['id']);
                $table .= '<tr>';
                $table .= '<td>' . $v['name'] . '</td>';
                $table .= '<td><input name="read[' . $v['id'] . ']" value="y" type="checkbox" ' . $privilege['read'] . '></td>';
                $table .= '<td><input name="create[' . $v['id'] . ']" value="y" type="checkbox" ' . $privilege['create'] . '></td>';
                $table .= '<td><input name="update[' . $v['id'] . ']" value="y" type="checkbox" ' . $privilege['update'] . '></td>';
                $table .= '<td><input name="delete[' . $v['id'] . ']" value="y" type="checkbox" ' . $privilege['delete'] . '></td>';
                $table .= '</tr>';
            }
        }
        $this->template->load('pages/role/config', ['table' => $table, 'role' => $role]);
    }

    public function store_config() {
        $post = $this->input->post();
        $data = $this->set_data_privilege($post);
        $this->db->trans_start();
        $this->role_menu_m->delete_by_role($post['role_id']);
        $this->role_menu_m->insert_batch($data);
        $this->db->trans_complete();

        if ($this->db->trans_status() !== FALSE) {
            redirect('role');
        }
    }

    private function set_privilege($role_menu, $menu_id) {
        $key = array_search($menu_id, array_column($role_menu, 'menu_id'));
        if ($key !== FALSE) {
            $privilege['read'] = $role_menu[$key]->read == 'y' ? 'checked' : '';
            $privilege['create'] = $role_menu[$key]->create == 'y' ? 'checked' : '';
            $privilege['update'] = $role_menu[$key]->update == 'y' ? 'checked' : '';
            $privilege['delete'] = $role_menu[$key]->delete == 'y' ? 'checked' : '';

            return $privilege;
        }

        $privilege['read'] = '';
        $privilege['create'] = '';
        $privilege['update'] = '';
        $privilege['delete'] = '';

        return $privilege;
    }

    private function set_data_privilege($post) {
        $role_id = $post['role_id'];
        $menu = $this->menu_m->get_all();
        $data = [];
        foreach ($menu as $key => $value) {
            $data[$key] = [
                'role_id' => $role_id,
                'menu_id' => $value->id,
                'create' => $this->set_value('create', $value->id, $post),
                'read' => $this->set_value('read', $value->id, $post),
                'update' => $this->set_value('update', $value->id, $post),
                'delete' => $this->set_value('delete', $value->id, $post),
            ];
        }
        return $data;
    }

    private function set_value($key, $id, $post) {
        if (array_key_exists($key, $post) && array_key_exists($id, $post[$key])) {
            return 'y';
        } else {
            return 'n';
        }
    }

}
