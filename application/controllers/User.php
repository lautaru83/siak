<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('User_model' => 'User_model', 'Role_model' => 'Role_model', 'Unit_model' => 'Unit_model'));
    }
    public function index()
    {
        $data['user'] = $this->User_model->ambil_data();
        $data['role'] = $this->Role_model->ambil_data();
        $data['unit'] = $this->Unit_model->ambil_data();
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('user/index', $data);
        $this->load->view('theme/footer');
    }

    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'nama_error' => form_error('nama'),
                'role_error' => form_error('role_id'),
                'unit_error' => form_error('unit_id'),
                'email_error' => form_error('email'),
                'sandi_error' => form_error('sandi')
            );
        } else {
            $this->User_model->simpan();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $data = $this->User_model->ambil_data_id($id);
        echo json_encode($data);
    }
    public function hapus($id)
    {
        $hasil = $this->User_model->cek_hapus($id);
        if (!$hasil) {
            $this->User_model->hapus($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data user berhasil dihapus!</div>');
            redirect('user');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Penghapusan data dibatalkan, data sedang digunakan oleh system!</div>');
            redirect('user');
        }
    }
    public function ubah($id)
    {
        if ($this->input->post('sandi')) {
            $this->form_validation->set_rules('sandi', 'password', 'required|trim|min_length[5]');
        }
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'nama_error' => form_error('nama'),
                'role_error' => form_error('role_id'),
                'unit_error' => form_error('unit_id'),
                'email_error' => form_error('email'),
                'sandi_error' => form_error('sandi')
            );
        } else {
            $this->User_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    private function _validate()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required|trim');
        $this->form_validation->set_rules('role_id', 'role', 'required|trim');
        $this->form_validation->set_rules('unit_id', 'unit', 'required|trim');
        if (!$this->input->post('idubah')) {
            $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('sandi', 'password', 'required|trim|min_length[5]');
        }
    }
}
