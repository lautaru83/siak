<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        $data['menu'] = $this->db->get('menus')->result_array();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar2', $data);
        $this->load->view('templates/content');
        $this->load->view('templates/footer');
    }
}
