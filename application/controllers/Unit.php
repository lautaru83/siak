<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Unit_model');
    }
    public function index()
    {
        $data['unit'] = $this->Unit_model->unit_data();
        $data['institusi'] = $this->db->get('institusis')->result_array();
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('unit/index', $data);
        $this->load->view('theme/footer');
    }

    public function add()
    {
        $data = [
            'id' => $this->input->post('idunit'),
            'institusi_id' => $this->input->post('institusi_id'),
            'unit' => htmlspecialchars($this->input->post('unit', true))
        ];
        $this->db->insert('units', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data berhasil disimpan!</div>');
        redirect('unit');
    }
    public function ajax_ubah($id)
    {
        $data = $this->Unit_model->getUnitById($id);
        echo json_encode($data);
    }
    public function hapus()
    {
        $id = $this->input->post('idhapus');
        $this->Unit_model->hapusUnit($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data berhasil dihapus!</div>');
        redirect('unit');
    }
}
