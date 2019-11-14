<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Template {

    protected $CI;

    // We'll use a constructor, as you can't directly call a function
    // from a property definition.
    public function __construct() {
        // Assign the CodeIgniter super-object
        $this->CI = &get_instance();
    }

    public function load($view_file_name, $data_array = array()) {
        $this->CI->load->view("templates/header");
        $this->CI->load->view($view_file_name, $data_array);
        $this->CI->load->view("templates/footer");
    }

}
