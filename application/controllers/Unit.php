<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'Unit_model' => 'Unit_model'));
    }
    public function index()
    {
        $data['unit'] = $this->Unit_model->ambil_data();
        $data['institusi'] = $this->Institusi_model->ambil_data();
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('unit/index', $data);
        $this->load->view('theme/footer');
    }

    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'id_error' => form_error('id'),
                'unit_error' => form_error('unit'),
                'institusi_error' => form_error('institusi_id')
            );
        } else {
            $this->Unit_model->simpan();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $data = $this->Unit_model->ambil_data_id($id);
        echo json_encode($data);
    }
    public function hapus($id)
    {
        $hasil = $this->Unit_model->cek_hapus($id);
        if (!$hasil) {
            $this->Unit_model->hapus($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data unit berhasil dihapus!</div>');
            redirect('unit');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Penghapusan data dibatalkan, data sedang digunakan oleh system!</div>');
            redirect('unit');
        }
    }
    public function ubah($id)
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'id_error' => form_error('id'),
                'unit_error' => form_error('unit'),
                'institusi_error' => form_error('institusi_id')
            );
        } else {
            $this->Unit_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    private function _validate()
    {
        $this->form_validation->set_rules('id', 'kode', 'required|trim', [
            'required' => 'Kode harap diisi!'
        ]);
        $this->form_validation->set_rules('unit', 'unit', 'required|trim', [
            'required' => 'Nama unit harap diisi!'
        ]);
        $this->form_validation->set_rules('institusi_id', 'Institusi_id', 'required|trim', [
            'required' => 'Harap pilih institusi!'
        ]);
    }
}
