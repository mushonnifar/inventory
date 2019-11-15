<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_m');
    }

    public function index() {
        $this->load->view('pages/login');
    }

    public function do_login() {
        $data = $this->input->post(null, true);
        $is_login = $this->user_m->authorize($data['username'], hash('sha512', $data['password']));
        if ($is_login) {
            $session_set = array(
                'is_login' => true,
                'nama' => $is_login->name,
                'id_user' => $is_login->id,
                'username' => $is_login->username,
                'role_id' => $is_login->role_id
            );
            $this->session->set_userdata($session_set);
            redirect("dashboard");
        } else {
            $this->session->set_flashdata('message', "Username atau password salah");
            redirect("login");
        }
    }

}
