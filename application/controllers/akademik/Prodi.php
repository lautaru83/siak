<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akademik/Prodi_model' => 'Prodi_model', 'akademik/Jenjang_model' => 'Jenjang_model', 'akademik/Jurusan_model' => 'Jurusan_model', 'akademik/Jalur_model' => 'Jalur_model'));
    }
    public function index()
    {
        //echo "Angkatan";
        $data['kontenmenu'] = "Master Akademik";
        $data['kontensubmenu'] = "Program Pendidikan";
        $data['prodi'] = $this->Prodi_model->ambil_data();
        $data['jurusan'] = $this->Jurusan_model->data_fk();
        $data['jenjang'] = $this->Jenjang_model->data_fk();
        $data['jalur'] = $this->Jalur_model->data_fk();
        $this->template->display('akademik/prodi/index', $data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode_error' => form_error('id'),
                'prodi_error' => form_error('prodi'),
                'jenjang_error' => form_error('jenjang_id'),
                'jurusan_error' => form_error('jurusan_id'),
                'jalur_error' => form_error('jalur_id')
            );
        } else {
            $this->Prodi_model->simpan();
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
        $hasil = $this->Prodi_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Prodi_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Prodi_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'prodi' => $hasil['prodi'],
                'jenjang_id' => $hasil['jenjang_id'],
                'jurusan_id' => $hasil['jurusan_id'],
                'jalur_id' => $hasil['jalur_id']
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
                'prodi_error' => form_error('prodi'),
                'jenjang_error' => form_error('jenjang_id'),
                'jurusan_error' => form_error('jurusan_id'),
                'jalur_error' => form_error('jalur_id')
            );
        } else {
            $this->Prodi_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function cek_unik()
    {
        $id = $this->input->post('id');
        $hasil = $this->Prodi_model->cek_id($id);
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
                'cek_unik' => 'Kode telah digunakan oleh data lain !'
            ]);
        }
        $this->form_validation->set_rules('prodi', 'Program pendidikan', 'required|trim');
        $this->form_validation->set_rules('jenjang_id', 'Jenjang', 'required|trim');
        $this->form_validation->set_rules('jurusan_id', 'Jurusan', 'required|trim');
        $this->form_validation->set_rules('jalur_id', 'Jalur', 'required|trim');
    }
}
