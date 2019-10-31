<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Role_model');
    }
    public function index()
    {
        $data['role'] = $this->Role_model->ambil_data();
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('role/index', $data);
        $this->load->view('theme/footer');
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'role_error' => form_error('role'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Role_model->simpan();
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
                'role_error' => form_error('role'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Role_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $data = $this->Role_model->ambil_data_id($id);
        echo json_encode($data);
    }
    public function hapus($id)
    {
        $hasil = $this->Role_model->cek_hapus($id);
        if (!$hasil) {
            $this->Role_model->hapus($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data role berhasil dihapus!</div>');
            redirect('role');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Penghapusan data dibatalkan, data sedang digunakan oleh system!</div>');
            redirect('role');
        }
    }
    private function _validate()
    {
        $this->form_validation->set_rules('role', 'Role', 'required|trim', [
            'required' => 'Nama role harap diisi!'
        ]);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
            'required' => 'Keterangan harap diisi!'
        ]);
    }
}
