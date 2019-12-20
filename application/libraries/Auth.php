<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {

    private $CI = NULL;

    function __construct() {
        $this->CI = & get_instance();
    }

    function privilege_check($link, $action) {
        $this->CI->load->model('role_menu_m');
        $access = $this->CI->role_menu_m->check_auth($link, $action);
        if ($access > 0) {
            return true;
        }
        return false;
    }

    public function no_access() {
        $this->CI->template->load('no_access');
    }

}
