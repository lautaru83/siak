<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Institusi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data['institusi'] = $this->db->get('institusis')->result_array();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar2');
        $this->load->view('institusi/index', $data);
        $this->load->view('templates/footer');
    }
}
