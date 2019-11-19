<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(array('Menu_model' => 'Menu_model', 'Submenu_model' => 'Submenu_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Data";
        $data['kontensubmenu'] = "Submenu Management";
        $data['submenu'] = $this->Submenu_model->ambil_data();
        $data['menu'] = $this->Menu_model->ambil_data();
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('setting/submenu/index', $data);
        $this->load->view('theme/sidebar-info');
        $this->load->view('theme/footer');
    }

    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'submenu_error' => form_error('submenu'),
                'menu_error' => form_error('menu_id'),
                'url_error' => form_error('url'),
                'icon_error' => form_error('icon'),
                'status_error' => form_error('is_active')
            );
        } else {
            $this->Submenu_model->simpan();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $data = $this->Submenu_model->ambil_data_id($id);
        echo json_encode($data);
    }
    public function hapus($id, $info)
    {
        $hasil = $this->Submenu_model->cek_hapus($id);
        if (!$hasil) {
            $this->Submenu_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function ubah($id)
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'submenu_error' => form_error('submenu'),
                'menu_error' => form_error('menu_id'),
                'url_error' => form_error('url'),
                'icon_error' => form_error('icon'),
                'status_error' => form_error('is_active')
            );
        } else {
            $this->Submenu_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    private function _validate()
    {
        $this->form_validation->set_rules('submenu', 'Submenu', 'required|trim');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required|trim');
        $this->form_validation->set_rules('url', 'Url', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');
        $this->form_validation->set_rules('is_active', 'Status', 'required|trim');
    }
}
