<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akunanggaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        // $this->load->model('akuntansi/Kodeperkiraan_model', 'Kodeperkiraan_model');
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Akunanggaran_model' => 'Akunanggaran_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Pembukuan";
        $data['kontensubmenu'] = "Akun Anggaran";
        $data['institusi_id'] = $this->session->userdata('idInstitusi');
        $data['kelompok'] = $this->Akunanggaran_model->kelompok_data();
        $data['akun'] = $this->Kodeperkiraan_model->akun6Institusi();
        $this->template->display('akuntansi/akunanggaran/index', $data);
    }
    public function simpanakun()
    {
        $this->_akunvalidate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'akun_error' => form_error('a6level_id')
            );
        } else {
            $this->Akunanggaran_model->simpanakun();
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
                'anggaran_error' => form_error('anggaran'),
                'posisi_error' => form_error('posisi')
            );
        } else {
            $this->Akunanggaran_model->simpananggaran();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    // public function hapusunit()
    // {
    //     $id = $this->input->post('id');
    //     $info = $this->input->post('info');
    //     $hasil = $this->Akunanggaran_model->cek_hapusunit($id);
    //     if ($hasil > 0) {
    //         $data = array(
    //             'status' => 'gagal'
    //         );
    //     } else {
    //         $this->Akunanggaran_model->hapusunit($id, $info);
    //         $data = array(
    //             'status' => 'sukses'
    //         );
    //     }
    //     echo json_encode($data);
    // }
    public function hapusanggaran()
    {
        $id = $this->input->post('id');
        $info = $this->input->post('info');
        $hasil = $this->Akunanggaran_model->cek_hapusanggaran($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Akunanggaran_model->hapusanggaran($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    // public function ajax_editunit($id)
    // {
    //     $hasil = $this->Akunanggaran_model->ambil_data_unit($id);
    //     if ($hasil) {
    //         $data = array(
    //             'status' => 'sukses',
    //             'id' => $hasil['id'],
    //             'kelompokanggaran_id' => $hasil['kelompokanggaran_id'],
    //             'unit_anggaran' => $hasil['unit_anggaran']
    //         );
    //     } else {
    //         $data = array(
    //             'status' => 'gagal'
    //         );
    //     }
    //     echo json_encode($data);
    // }
    public function ajax_editanggaran($id)
    {
        $hasil = $this->Akunanggaran_model->ambil_data_anggaran($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'kelompok_id' => $hasil['kelompok_id'],
                'anggaran' => $hasil['anggaran'],
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
    // public function ubahunit($id)
    // {
    //     $this->_unitvalidate();
    //     if ($this->form_validation->run() == false) {
    //         $data = array(
    //             'status' => 'gagal',
    //             'kodeunit_error' => form_error('kodeunit'),
    //             'unit_error' => form_error('unit_anggaran')
    //         );
    //     } else {
    //         $this->Akunanggaran_model->ubahunit($id);
    //         $data = array(
    //             'status' => 'sukses'
    //         );
    //     }
    //     echo json_encode($data);
    // }
    public function ubahanggaran()
    {
        $id = $this->input->post('idubah');
        $this->_anggaranvalidate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                //'kodeanggaran_error' => form_error('kodeanggaran'),
                'anggaran_error' => form_error('anggaran'),
                'posisi_error' => form_error('posisi')
                //'institusi_error' => form_error('institusi_id')
            );
        } else {
            $this->Akunanggaran_model->ubahanggaran($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function cek_unikakun()
    {
        $hasil = $this->Akunanggaran_model->cek_unikakun();
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _akunvalidate()
    {

        $this->form_validation->set_rules('a6level_id', 'Akun', 'required|trim|callback_cek_unikakun', [
            'cek_unikakun' => 'Kode telah digunakan oleh data lain !'
        ]);
    }
    // public function cek_unikanggaran()
    // {
    //     $id = $this->input->post('id');
    //     $hasil = $this->Akunanggaran_model->cek_idanggaran($id);
    //     if ($hasil > 0) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }
    private function _anggaranvalidate()
    {
        // if (!$this->input->post('idubah')) {
        //     $this->form_validation->set_rules('kodeanggaran', 'Kode Akun', 'required|trim|numeric|exact_length[2]|callback_cek_unikanggaran', [
        //         'cek_unikanggaran' => 'Kode telah digunakan oleh data lain !'
        //     ]);
        // }
        $this->form_validation->set_rules('anggaran', 'Nama Akun', 'required|trim');
        $this->form_validation->set_rules('posisi', 'Posisi Akun', 'required|trim');
        // $this->form_validation->set_rules('institusi_id', 'Institusi', 'required|trim');
    }
}
