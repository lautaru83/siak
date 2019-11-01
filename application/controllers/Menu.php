<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
    }
    public function index()
    {
        $data['menu'] = $this->Menu_model->ambil_data();
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('menu/index', $data);
        $this->load->view('theme/footer');
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'menu_error' => form_error('menu'),
                'icon_error' => form_error('icon'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Menu_model->simpan();
            $data = array(
                'status' => 'sukses'
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
                'menu_error' => form_error('menu'),
                'icon_error' => form_error('icon'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Menu_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $data = $this->Menu_model->ambil_data_id($id);
        echo json_encode($data);
    }
    public function hapus($id)
    {
        $hasil = $this->Menu_model->cek_hapus($id);
        if (!$hasil) {
            $this->Menu_model->hapus($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data menu berhasil dihapus!</div>');
            redirect('menu');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Penghapusan data dibatalkan, data sedang digunakan oleh system!</div>');
            redirect('menu');
        }
    }
    private function _validate()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim', [
            'required' => 'Nama menu harap diisi!'
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim', [
            'required' => 'Icon harap diisi!'
        ]);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
            'required' => 'Keterangan harap diisi!'
        ]);
    }
}
