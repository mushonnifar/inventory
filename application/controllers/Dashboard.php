<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('is_login')) {
            redirect('login');
        }
    }

    public function index() {
        $this->template->load('pages/dashboard/index');
    }

}
