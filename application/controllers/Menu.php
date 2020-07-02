<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model');
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Data";
        $data['kontensubmenu'] = "Menu Management";
        $data['menu'] = $this->Menu_model->ambil_data();
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('setting/menu/index', $data);
        $this->load->view('theme/sidebar-info');
        $this->load->view('theme/footer');
    }
    public function cetak()
    {
        $data['judul'] = "Data Menu";
        $data['menu'] = $this->Menu_model->ambil_data();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Data Menu";
        $this->pdf->load_view('setting/menu/cetak', $data);
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
    public function hapus($id, $info)
    {
        $hasil = $this->Menu_model->cek_hapus($id);
        if (!$hasil) {
            $this->Menu_model->hapus($id, $info);
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
    private function _validate()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
    }
}
