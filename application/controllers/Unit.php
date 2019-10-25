<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Unit_model');
    }
    public function index()
    {
        $data['unit'] = $this->Unit_model->unit_data();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar2');
        $this->load->view('unit/index', $data);
        $this->load->view('templates/footer');
    }
}
