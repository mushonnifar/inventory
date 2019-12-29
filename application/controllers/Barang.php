<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('barang_m');
        if (!$this->session->userdata('is_login')) {
            redirect('login');
        }
    }

    public function index() {
        if (!$this->auth->privilege_check('barang', 'read')) {
            $this->auth->no_access();
        }
        $barang = $this->barang_m->get_all();

        $this->template->load('pages/barang/index', ['data' => $barang]);
    }
    
    public function get_data() {
        $barang = $this->barang_m->get_all();

        $return['data'] = [];
        $no = 1;
        foreach ($barang as $value) {
            $value->no = $no;
            $value->image = '<img src="' . base_url('assets/images/') . $value->image . '" width="100">';
            $value->action = '<button class="btn btn-warning" onclick="edit(' . $value->id . ')">Edit</button>&nbsp;'
                    . '<button class="btn btn-danger" onclick="remove(' . $value->id . ')">Delete</button>';
            array_push($return['data'], $value);
            $no++;
        }
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($return));
    }

    public function create() {
        if (!$this->auth->privilege_check('barang', 'create')) {
            $this->auth->no_access();
        }
        $this->template->load('pages/barang/create');
    }

    public function store() {
        $post = $this->input->post();

        $config['upload_path'] = './assets/images';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '1024';

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $upload = $this->upload->data();
            $post['image'] = $upload['file_name'];
            $this->barang_m->insert($post);
            redirect('barang');
        } else {
            print_r($this->upload->display_errors());
        }
    }

    public function edit($id) {
        $barang = $this->barang_m->get_by_id($id);

        $this->template->load('pages/barang/edit', ['data' => $barang]);
    }

    public function update($id) {
        $post = $this->input->post();

        $config['upload_path'] = './assets/images';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '1024';

        $this->load->library('upload', $config);
        if (file_exists($_FILES['image']['tmp_name'])) {
            if ($this->upload->do_upload('image')) {
                $upload = $this->upload->data();
                $post['image'] = $upload['file_name'];
            } else {
                print_r($this->upload->display_errors());
            }
        }

        $this->barang_m->update($id, $post);
        redirect('barang');
    }

    public function delete($id) {
        $result = $this->barang_m->delete($id);
        if ($result) {
            redirect('barang');
        }
    }

}
