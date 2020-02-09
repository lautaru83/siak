<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akademik/Mahasiswa_model' => 'Mahasiswa_model', 'akademik/Kelas_model' => 'Kelas_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Akademik";
        $data['kontensubmenu'] = "Mahasiswa";
        $data['kelas'] = $this->Kelas_model->data_fk();
        $this->template->display('akademik/mahasiswa/index', $data);
    }
    public function data($id)
    {
        $data['kontenmenu'] = "Master Akademik";
        $data['kontensubmenu'] = "Data";
        $data['kelas_id'] = $id;
        $data['detailkelas'] = $this->Kelas_model->detail_kelas_by_id($id);
        $data['kelas'] = $this->Kelas_model->ambil_data_id($id);
        $data['mahasiswa'] = $this->Mahasiswa_model->ambil_data_by_kelas_id($id);
        $this->template->display('akademik/mahasiswa/data', $data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'nim_error' => form_error('nim'),
                'nama_error' => form_error('nama'),
                'status_error' => form_error('is_active')
            );
        } else {
            $this->Mahasiswa_model->simpan();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function hapus()
    {
        $id = $this->input->post('id');
        $info = $this->input->post('info');
        $hasil = $this->Mahasiswa_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Mahasiswa_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Mahasiswa_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'nim' => $hasil['nim'],
                'nama' => $hasil['nama'],
                'is_active' => $hasil['is_active']
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
                'nim_error' => form_error('nim'),
                'nama_error' => form_error('nama'),
                'status_error' => form_error('is_active')
            );
        } else {
            $this->Mahasiswa_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function cek_uniknim()
    {
        $nim = $this->input->post('nim');
        $hasil = $this->Mahasiswa_model->cek_nim($nim);
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _validate()
    {
        if (!$this->input->post('idubah')) {
            $this->form_validation->set_rules('nim', 'NIM', 'required|trim|callback_cek_uniknim', [
                'cek_uniknim' => 'NIM telah digunakan oleh mahasiswa lain !'
            ]);
        }
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('is_active', 'Status', 'required|trim');
    }
}
