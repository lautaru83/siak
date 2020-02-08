<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akademik/Kelas_model' => 'Kelas_model', 'akademik/Detailtahunajaran_model' => 'Detailtahunajaran_model', 'akademik/Prodi_model' => 'Prodi_model', 'akademik/Tingkat_model' => 'Tingkat_model', 'akademik/Angkatan_model' => 'Angkatan_model'));
    }
    public function index()
    {
        //echo "Angkatan";
        $data['kontenmenu'] = "Master Akademik";
        $data['kontensubmenu'] = "Kelas";
        $data['kelas'] = $this->Kelas_model->ambil_data();
        $data['prodi'] = $this->Prodi_model->data_fk();
        $data['tingkat'] = $this->Tingkat_model->data_fk();
        $data['angkatan'] = $this->Angkatan_model->data_fk();
        $this->template->display('akademik/kelas/index', $data);
    }
    // public function detail($id)
    // {
    //     //echo "Angkatan";
    //     $data['kontenmenu'] = "Master Akademik";
    //     $data['kontensubmenu'] = "Kelas";
    //     $data['kelas'] = $this->Kelas_model->ambil_data();
    //     $this->template->display('akademik/kelas/detail', $data);
    // }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode_error' => form_error('id'),
                'angkatan_error' => form_error('angkatan_id'),
                'prodi_error' => form_error('prodi_id'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Kelas_model->simpan();
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
        $hasil = $this->Kelas_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Kelas_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Kelas_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'angkatan_id' => $hasil['angkatan_id'],
                'prodi_id' => $hasil['prodi_id'],
                'keterangan' => $hasil['keterangan']
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function ubah()
    {
        $id = $this->input->post('idubah');
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode_error' => form_error('id'),
                'angkatan_error' => form_error('angkatan_id'),
                'prodi_error' => form_error('prodi_id'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Kelas_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function cek_unik()
    {
        $id = $this->input->post('id');
        $hasil = $this->Kelas_model->cek_id($id);
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _validate()
    {
        if (!$this->input->post('idubah')) {
            $this->form_validation->set_rules('id', 'Kode kelas', 'required|trim|exact_length[5]|callback_cek_unik', [
                'cek_unik' => 'Kode telah digunakan oleh data lain !'
            ]);
        }
        $this->form_validation->set_rules('angkatan_id', 'Angkatan', 'required|trim');
        $this->form_validation->set_rules('prodi_id', 'Prodi', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
    }
}
