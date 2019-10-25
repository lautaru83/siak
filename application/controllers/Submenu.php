<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Submenu_model');
    }
    public function index()
    {
        $data['submenu'] = $this->Submenu_model->submenu_data();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar2');
        $this->load->view('submenu/index', $data);
        $this->load->view('templates/footer');
    }
}
