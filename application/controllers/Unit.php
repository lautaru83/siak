<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'Unit_model' => 'Unit_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Data";
        $data['kontensubmenu'] = "Unit Management";
        $data['unit'] = $this->Unit_model->ambil_data();
        $data['institusi'] = $this->Institusi_model->ambil_data();
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('setting/unit/index', $data);
        $this->load->view('theme/sidebar-info');
        $this->load->view('theme/footer');
    }
    public function cetak()
    {
        $data['judul'] = "Data Unit";
        $data['unit'] = $this->Unit_model->ambil_data();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Data Unit";
        $this->pdf->load_view('setting/unit/cetak', $data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode_error' => form_error('id'),
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
    public function hapus($id, $info)
    {
        $hasil = $this->Unit_model->cek_hapus($id);
        if (!$hasil) {
            $this->Unit_model->hapus($id, $info);
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
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode_error' => form_error('id'),
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
        $this->form_validation->set_rules('unit', 'Unit', 'required|trim');
        $this->form_validation->set_rules('institusi_id', 'Institusi', 'required|trim');
        if (!$this->input->post('idubah')) {
            $this->form_validation->set_rules('id', 'Kode', 'required|trim|numeric|is_unique[units.id]');
        }
    }
}
