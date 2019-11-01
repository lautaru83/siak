<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Menu_model' => 'Menu_model', 'Submenu_model' => 'Submenu_model'));
    }
    public function index()
    {
        $data['submenu'] = $this->Submenu_model->ambil_data();
        $data['menu'] = $this->Menu_model->ambil_data();
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('submenu/index', $data);
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
                'icon_error' => form_error('icon')
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
    public function hapus($id)
    {
        $hasil = $this->Submenu_model->cek_hapus($id);
        if (!$hasil) {
            $this->Submenu_model->hapus($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data submenu berhasil dihapus!</div>');
            redirect('submenu');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Penghapusan data dibatalkan, data sedang digunakan oleh system!</div>');
            redirect('submenu');
        }
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
                'icon_error' => form_error('icon')
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
        $this->form_validation->set_rules('submenu', 'Submenu', 'required|trim', [
            'required' => 'Nama submenu harap diisi!'
        ]);
        $this->form_validation->set_rules('menu_id', 'Menu', 'required|trim', [
            'required' => 'Harap pilih menu!'
        ]);
        $this->form_validation->set_rules('url', 'Url', 'required|trim', [
            'required' => 'Harap isi url!'
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim', [
            'required' => 'Icon harap diisi!'
        ]);
    }
}
