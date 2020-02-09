<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kodeperkiraan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        // $this->load->model('akuntansi/Kodeperkiraan_model', 'Kodeperkiraan_model');
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Pembukuan";
        $data['kontensubmenu'] = "Kode Perkiraan";
        $data['kodeperkiraan'] = $this->Kodeperkiraan_model->ambil_data();
        $data['institusi'] = $this->Institusi_model->data_institusi();
        $this->template->display('akuntansi/kodeperkiraan/index', $data);
    }
    public function data()
    {
        $data['kontenmenu'] = "Master Pembukuan";
        $data['kontensubmenu'] = "Data Kode Perkiraan";
        //$data['kodeperkiraan'] = $this->Kodeperkiraan_model->ambil_data();
        $data['institusi'] = $this->Institusi_model->data_institusi();
        $this->template->display('akuntansi/kodeperkiraan/data', $data);
    }
    public function simpanakun5()
    {
        $this->_akun5validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode5_error' => form_error('kode5'),
                'level5_error' => form_error('level5')
            );
        } else {
            $this->Kodeperkiraan_model->simpanakun5();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function simpanakun6()
    {
        $this->_akun6validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode6_error' => form_error('kode6'),
                'level6_error' => form_error('level6'),
                'posisi_error' => form_error('posisi'),
                'institusi_error' => form_error('institusi_id')
            );
        } else {
            $this->Kodeperkiraan_model->simpanakun6();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function hapusakun5()
    {
        $id = $this->input->post('id');
        $info = $this->input->post('info');
        $hasil = $this->Kodeperkiraan_model->cek_hapusakun5($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Kodeperkiraan_model->hapusakun5($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function hapusakun6()
    {
        $id = $this->input->post('id');
        $info = $this->input->post('info');
        $hasil = $this->Kodeperkiraan_model->cek_hapusakun6($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Kodeperkiraan_model->hapusakun6($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit5($id)
    {
        $hasil = $this->Kodeperkiraan_model->ambil_data_id5($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'kode5' => $hasil['kode5'],
                'a4level_id' => $hasil['a4level_id'],
                'level5' => $hasil['level5']
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit6($id)
    {
        $hasil = $this->Kodeperkiraan_model->ambil_data_id6($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'a5level_id' => $hasil['a5level_id'],
                'kode6' => $hasil['kode6'],
                'level6' => $hasil['level6'],
                'posisi' => $hasil['posisi'],
                'institusi_id' => $hasil['institusi_id']
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function ubahakun5($id)
    {
        $this->_akun5validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'level5_error' => form_error('level5')
            );
        } else {
            $this->Kodeperkiraan_model->ubahakun5($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ubahakun6($id)
    {
        $this->_akun6validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode6_error' => form_error('kode6'),
                'level6_error' => form_error('level6'),
                'posisi_error' => form_error('posisi'),
                'institusi_error' => form_error('institusi_id')
            );
        } else {
            $this->Kodeperkiraan_model->ubahakun6($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function cek_unik5()
    {
        $id = $this->input->post('id');
        $hasil = $this->Kodeperkiraan_model->cek_id5($id);
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _akun5validate()
    {
        if (!$this->input->post('idubah5')) {
            $this->form_validation->set_rules('kode5', 'Kode', 'required|trim|numeric|exact_length[2]|callback_cek_unik5', [
                'cek_unik5' => 'Kode telah digunakan oleh data lain !'
            ]);
        }
        $this->form_validation->set_rules('level5', 'Nama Akun', 'required|trim');
    }
    public function cek_unik6()
    {
        $id = $this->input->post('id');
        $hasil = $this->Kodeperkiraan_model->cek_id6($id);
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _akun6validate()
    {
        if (!$this->input->post('idubah6')) {
            $this->form_validation->set_rules('kode6', 'Kode Akun', 'required|trim|numeric|exact_length[2]|callback_cek_unik6', [
                'cek_unik6' => 'Kode telah digunakan oleh data lain !'
            ]);
        }
        $this->form_validation->set_rules('level6', 'Nama Akun', 'required|trim');
        $this->form_validation->set_rules('posisi', 'Posisi Akun', 'required|trim');
        $this->form_validation->set_rules('institusi_id', 'Institusi', 'required|trim');
    }
}
