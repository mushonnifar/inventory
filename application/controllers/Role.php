<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('role_m');
    }

    public function index() {
        $role = $this->role_m->get_all();

        $this->template->load('pages/role/index', ['data' => $role]);
    }

    public function create() {
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
        $result = $this->role_m->delete($id);
        if ($result) {
            redirect('role');
        }
    }
}
