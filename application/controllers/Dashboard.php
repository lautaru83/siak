<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //is_logged_in();
    }
    public function index()
    {
        $data['title'] = "Siak-Serulingmas";
        $this->load->view('theme/header', $data);
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('dashboard/index');
        $this->load->view('theme/sidebar-info');
        $this->load->view('theme/footer');
    }
    // public function tes1()
    // {
    //     $this->load->view('dashboard/tes');

    // }
    public function tes()
    {
        $data['title'] = "Siak-Serulingmas";
        $this->load->view('theme/header', $data);
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('dashboard/tes');
        $this->load->view('theme/sidebar-info');
        $this->load->view('theme/footer');
    }
}
