<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Semester extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akademik/Semester_model' => 'Semester_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Akademik";
        $data['kontensubmenu'] = "Semester Pendidikan";
        $data['semester'] = $this->Semester_model->ambil_data();
        $this->template->display('akademik/semester/index', $data);
    }
    public function cetak()
    {
        $data['judul'] = "Data Semester";
        $data['semester'] = $this->Semester_model->ambil_data();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Data Semester";
        $this->pdf->load_view('akademik/semester/cetak', $data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'semester_error' => form_error('semester')
            );
        } else {
            $this->Semester_model->simpan();
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
        $hasil = $this->Semester_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Semester_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Semester_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'semester' => $hasil['semester']
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
                'semester_error' => form_error('semester'),
            );
        } else {
            $this->Semester_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    private function _validate()
    {
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim');
    }
}
