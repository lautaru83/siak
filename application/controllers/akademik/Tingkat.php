<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tingkat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akademik/Tingkat_model' => 'Tingkat_model'));
    }
    public function index()
    {
        //echo "Angkatan";
        $data['kontenmenu'] = "Master Akademik";
        $data['kontensubmenu'] = "Tingkat Pendidikan";
        $data['tingkat'] = $this->Tingkat_model->ambil_data();
        $this->template->display('akademik/tingkat/index', $data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                //'kode_error' => form_error('id'),
                'tingkat_error' => form_error('tingkat')
            );
        } else {
            $this->Tingkat_model->simpan();
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
        $hasil = $this->Tingkat_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Tingkat_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Tingkat_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'tingkat' => $hasil['tingkat']
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
                //'kode_error' => form_error('id'),
                'tingkat_error' => form_error('tingkat'),
            );
        } else {
            $this->Tingkat_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    // public function cek_unik()
    // {
    //     $id = $this->input->post('id');
    //     $hasil = $this->Jenjang_model->cek_id($id);
    //     if ($hasil > 0) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }
    private function _validate()
    {
        // if (!$this->input->post('idubah')) {
        //     $this->form_validation->set_rules('id', 'Kode', 'required|trim|exact_length[2]|callback_cek_unik', [
        //         'cek_unik' => 'Kode telah digunakan oleh data lain !'
        //     ]);
        // }
        $this->form_validation->set_rules('tingkat', 'Tingkat', 'required|trim');
    }
}
