<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data['menu'] = $this->db->get('menus')->result_array();
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar2');
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');
    }
}
