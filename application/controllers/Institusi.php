<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Institusi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Institusi_model');
    }
    public function index()
    {
        $data['institusi'] = $this->Institusi_model->ambil_data();
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('institusi/index', $data);
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
    public function hapus($id)
    {
        $hasil = $this->Institusi_model->cek_hapus($id);
        if (!$hasil) {
            $this->Institusi_model->hapus($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data institusi berhasil dihapus!</div>');
            redirect('institusi');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Penghapusan data dibatalkan, data sedang digunakan oleh system!</div>');
            redirect('institusi');
        }
    }
    private function _validate()
    {
        $this->form_validation->set_rules('institusi', 'Institusi', 'required|trim', [
            'required' => 'Institusi harap diisi!'
        ]);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
            'required' => 'Keterangan harap diisi!'
        ]);
    }
}
