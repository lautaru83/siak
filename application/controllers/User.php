<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    public function index()
    {
        $data['user'] = $this->User_model->user_data();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar2');
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    public function add()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar2');
        $this->load->view('user/add');
        $this->load->view('templates/footer');
    }
}
