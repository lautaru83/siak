<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Institusi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Institusi_model');
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Data";
        $data['kontensubmenu'] = "Institusi Management";
        $data['institusi'] = $this->Institusi_model->ambil_data();
        $this->load->view('theme/header', $data);
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('setting/institusi/index', $data);
        $this->load->view('theme/sidebar-info');
        $this->load->view('theme/footer');
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'institusi_error' => form_error('institusi'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Institusi_model->simpan();
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
                'institusi_error' => form_error('institusi'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Institusi_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $data = $this->Institusi_model->ambil_data_id($id);
        echo json_encode($data);
    }
    public function hapus($id, $info)
    {
        $hasil = $this->Institusi_model->cek_hapus($id);
        if (!$hasil) {
            $this->Institusi_model->hapus($id, $info);
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
    // public function ajax_hapus($id, $info)
    // {
    //     $hasil = $this->Institusi_model->cek_hapus($id);
    //     if (!$hasil) {
    //         $this->Institusi_model->hapus($id, $info);
    //         $data = array(
    //             'status' => 'sukses'
    //         );
    //     } else {
    //         $data = array(
    //             'status' => 'gagal'
    //         );
    //     }
    //     echo json_encode($data);
    // }
    private function _validate()
    {
        $this->form_validation->set_rules('institusi', 'Institusi', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
    }
}
