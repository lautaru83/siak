<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenjang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akademik/Jenjang_model' => 'Jenjang_model'));
    }
    public function index()
    {
        //echo "Angkatan";
        $data['kontenmenu'] = "Master Akademik";
        $data['kontensubmenu'] = "Jenjang Pendidikan";
        $data['jenjang'] = $this->Jenjang_model->ambil_data();
        $this->template->display('akademik/jenjang/index', $data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode_error' => form_error('id'),
                'jenjang_error' => form_error('jenjang')
            );
        } else {
            $this->Jenjang_model->simpan();
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
        $hasil = $this->Jenjang_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Jenjang_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Jenjang_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'jenjang' => $hasil['jenjang']
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
                'kode_error' => form_error('id'),
                'jenjang_error' => form_error('jenjang'),
            );
        } else {
            $this->Jenjang_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function cek_unik()
    {
        $id = $this->input->post('id');
        $hasil = $this->Jenjang_model->cek_id($id);
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _validate()
    {
        if (!$this->input->post('idubah')) {
            $this->form_validation->set_rules('id', 'Kode', 'required|trim|exact_length[2]|callback_cek_unik', [
                'cek_unik' => 'Kode telah digunakan!'
            ]);
        }
        $this->form_validation->set_rules('jenjang', 'Jenjang', 'required|trim');
    }
}
