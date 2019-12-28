<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(array('User_model' => 'User_model', 'Role_model' => 'Role_model', 'Unit_model' => 'Unit_model', 'Institusi_model' => 'Institusi_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Data";
        $data['kontensubmenu'] = "User Management";
        $data['user'] = $this->User_model->ambil_data();
        $data['institusi'] = $this->Institusi_model->ambil_data();
        $data['role'] = $this->Role_model->ambil_data();
        //$data['unit'] = $this->Unit_model->ambil_data();
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('setting/user/index', $data);
        $this->load->view('theme/sidebar-info');
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
                'institusi_error' => form_error('institusi_id'),
                'email_error' => form_error('email'),
                'sandi_error' => form_error('sandi'),
                'status_error' => form_error('is_active')
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
    public function hapus($id, $info)
    {
        $hasil = $this->User_model->cek_hapus($id);
        if (!$hasil) {
            $this->User_model->hapus($id, $info);
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
        if ($this->input->post('sandi')) {
            $this->form_validation->set_rules('sandi', 'Password', 'required|trim|min_length[5]');
        }
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'nama_error' => form_error('nama'),
                'role_error' => form_error('role_id'),
                'institusi_error' => form_error('institusi_id'),
                'email_error' => form_error('email'),
                'status_error' => form_error('is_active'),
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
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('role_id', 'Role', 'required|trim');
        $this->form_validation->set_rules('institusi_id', 'Institusi', 'required|trim');
        $this->form_validation->set_rules('is_active', 'Status', 'required|trim');
        if (!$this->input->post('idubah')) {
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('sandi', 'Password', 'required|trim|min_length[5]');
        }
    }
}
