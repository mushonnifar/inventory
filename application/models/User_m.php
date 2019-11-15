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

}
