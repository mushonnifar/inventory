<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('barang_m');
        if (!$this->session->userdata('is_login')) {
            redirect('login');
        }
    }

    public function index() {
        if (!$this->auth->privilege_check('barang_ajax', 'read')) {
            $this->auth->no_access();
        }
        $this->template->load('pages/barang_ajax/index');
    }

    public function get_data() {
        $barang = $this->barang_m->get_all();

        $return['data'] = [];
        $no = 1;
        foreach ($barang as $value) {
            $value->no = $no;
            $value->image = '<img src="' . base_url('assets/images/') . $value->image . '" width="100">';
            $value->action = '<button class="btn btn-warning" onclick="edit(\'' . $value->id . '\')">Edit</button>&nbsp;'
                    . '<button class="btn btn-danger" onclick="remove(\'' . $value->id . '\')">Delete</button>';
            array_push($return['data'], $value);
            $no++;
        }
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($return));
    }

    public function store() {
        if (!$this->auth->privilege_check('barang_ajax', 'create')) {
            $response = [
                "status" => "fail",
                "status_code" => 0,
                "message" => "Anda tidak mempunyai akses"
            ];
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
            return;
        }
        $post = $this->input->post();

        $config['upload_path'] = './assets/images';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '1024';

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $upload = $this->upload->data();
            $post['image'] = $upload['file_name'];
            $insert = $this->barang_m->insert($post);
            if ($insert) {
                $response = [
                    "status" => "success",
                    "status_code" => 1,
                    "message" => "Data berhasil disimpan"
                ];
            } else {
                $response = [
                    "status" => "fail",
                    "status_code" => 0,
                    "message" => "Data gagal disimpan"
                ];
            }
        } else {
            $response = [
                "status" => "fail",
                "status_code" => 0,
                "message" => $this->upload->display_errors()
            ];
        }
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
    }

    public function edit($id) {
        $barang = $this->barang_m->get_by_id($id);

        if ($barang) {
            $response = [
                "status" => "success",
                "status_code" => 1,
                "message" => "Berhasil get data",
                "data" => $barang
            ];
        } else {
            $response = [
                "status" => "fail",
                "status_code" => 0,
                "message" => "Gagal get data"
            ];
        }
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
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
                $response = [
                    "status" => "fail",
                    "status_code" => 0,
                    "message" => $this->upload->display_errors()
                ];
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));
                return;
            }
        }

        $update = $this->barang_m->update($id, $post);
        if ($update) {
            $response = [
                "status" => "success",
                "status_code" => 1,
                "message" => "Data berhasil disimpan"
            ];
        } else {
            $response = [
                "status" => "fail",
                "status_code" => 0,
                "message" => "Data gagal disimpan"
            ];
        }
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
    }

    public function delete($id) {
        $result = $this->barang_m->delete($id);
        if ($result) {
            $response = [
                "status" => "success",
                "status_code" => 1,
                "message" => "Data berhasil dihapus"
            ];
        } else {
            $response = [
                "status" => "fail",
                "status_code" => 0,
                "message" => "Data gagal dihapus"
            ];
        }
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
    }

}
