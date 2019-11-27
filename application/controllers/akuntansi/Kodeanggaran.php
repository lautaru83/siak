<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kodeanggaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        // $this->load->model('akuntansi/Kodeperkiraan_model', 'Kodeperkiraan_model');
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Kodeanggaran_model' => 'Kodeanggaran_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Pembukuan";
        $data['kontensubmenu'] = "Kode Anggaran";
        $data['kelompokanggaran'] = $this->Kodeanggaran_model->kelompokanggaran_data();
        $data['institusi'] = $this->Institusi_model->data_institusi();
        $this->template->display('akuntansi/kodeanggaran/index', $data);
    }
    public function simpanunit()
    {
        $this->_unitvalidate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kodeunit_error' => form_error('kodeunit'),
                'unit_error' => form_error('unit_anggaran')
            );
        } else {
            $this->Kodeanggaran_model->simpanunit();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function simpananggaran()
    {
        $this->_anggaranvalidate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kodeanggaran_error' => form_error('kodeanggaran'),
                'anggaran_error' => form_error('nama_anggaran'),
                'posisi_error' => form_error('posisi'),
                'institusi_error' => form_error('institusi_id')
            );
        } else {
            $this->Kodeanggaran_model->simpananggaran();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function hapusunit()
    {
        $id = $this->input->post('id');
        $info = $this->input->post('info');
        $hasil = $this->Kodeanggaran_model->cek_hapusunit($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Kodeanggaran_model->hapusunit($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function hapusanggaran()
    {
        $id = $this->input->post('id');
        $info = $this->input->post('info');
        $hasil = $this->Kodeanggaran_model->cek_hapusanggaran($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Kodeanggaran_model->hapusanggaran($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_editunit($id)
    {
        $hasil = $this->Kodeanggaran_model->ambil_data_unit($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'kelompokanggaran_id' => $hasil['kelompokanggaran_id'],
                'unit_anggaran' => $hasil['unit_anggaran']
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function ajax_editanggaran($id)
    {
        $hasil = $this->Kodeanggaran_model->ambil_data_anggaran($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'unitanggaran_id' => $hasil['unitanggaran_id'],
                'kode' => $hasil['kode'],
                'nama_anggaran' => $hasil['nama_anggaran'],
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
    public function ubahunit($id)
    {
        $this->_unitvalidate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kodeunit_error' => form_error('kodeunit'),
                'unit_error' => form_error('unit_anggaran')
            );
        } else {
            $this->Kodeanggaran_model->ubahunit($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ubahanggaran($id)
    {
        $this->_anggaranvalidate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kodeanggaran_error' => form_error('kodeanggaran'),
                'anggaran_error' => form_error('nama_anggaran'),
                'posisi_error' => form_error('posisi'),
                'institusi_error' => form_error('institusi_id')
            );
        } else {
            $this->Kodeanggaran_model->ubahanggaran($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function cek_unikunit()
    {
        $id = $this->input->post('id');
        $hasil = $this->Kodeanggaran_model->cek_idunit($id);
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _unitvalidate()
    {
        if (!$this->input->post('idubahunit')) {
            $this->form_validation->set_rules('kodeunit', 'Kode', 'required|trim|numeric|exact_length[3]|callback_cek_unikunit', [
                'cek_unikunit' => 'Kode telah digunakan oleh data lain !'
            ]);
        }
        $this->form_validation->set_rules('unit_anggaran', 'Nama Akun', 'required|trim');
    }
    public function cek_unikanggaran()
    {
        $id = $this->input->post('id');
        $hasil = $this->Kodeanggaran_model->cek_idanggaran($id);
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _anggaranvalidate()
    {
        if (!$this->input->post('idubahanggaran')) {
            $this->form_validation->set_rules('kodeanggaran', 'Kode Akun', 'required|trim|numeric|exact_length[2]|callback_cek_unikanggaran', [
                'cek_unikanggaran' => 'Kode telah digunakan oleh data lain !'
            ]);
        }
        $this->form_validation->set_rules('nama_anggaran', 'Nama Akun', 'required|trim');
        $this->form_validation->set_rules('posisi', 'Posisi Akun', 'required|trim');
        $this->form_validation->set_rules('institusi_id', 'Institusi', 'required|trim');
    }
}
