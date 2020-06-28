<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(array('Role_model' => 'Role_model', 'Access_model' => 'Access_model', 'Menu_model' => 'Menu_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Data";
        $data['kontensubmenu'] = "Role Management";
        $data['role'] = $this->Role_model->ambil_data();
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('setting/role/index', $data);
        $this->load->view('theme/sidebar-info');
        $this->load->view('theme/footer');
    }
    public function cetak()
    {
        $data['role'] = $this->Role_model->ambil_data();
        $this->load->view('setting/role/cetak', $data);
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
    public function hapus($id, $info)
    {
        $hasil = $this->Role_model->cek_hapus($id);
        if (!$hasil) {
            $this->Role_model->hapus($id, $info);
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
    public function access($role_id)
    {
        $data['role_id'] = $role_id;
        $data['kontenmenu'] = "Master Data";
        $data['kontensubmenu'] = "Role Management";
        $data['menu'] = $this->Menu_model->ambil_data();
        $data['role'] = $this->Role_model->ambil_data_id($role_id);
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('setting/role/access', $data);
        $this->load->view('theme/sidebar-info');
        $this->load->view('theme/footer');
    }
    public function ubahaccess()
    {
        $role_id = $this->input->post('roleId');
        $submenu_id = $this->input->post('submenuId');
        $data = [
            "role_id" => $role_id,
            "submenu_id" => $submenu_id
        ];
        $hasil = $this->Access_model->cek_data($data);
        if ($hasil) {
            $this->Access_model->hapus($data);
        } else {
            $this->Access_model->simpan($data);
        }
    }
    private function _validate()
    {
        $this->form_validation->set_rules('role', 'Role', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
    }
}
