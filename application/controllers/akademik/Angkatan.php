<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Angkatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akademik/Angkatan_model' => 'Angkatan_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model'));
    }
    public function index()
    {
        //echo "Angkatan";
        $data['kontenmenu'] = "Master Akademik";
        $data['kontensubmenu'] = "Angkatan Management";
        $data['angkatan'] = $this->Angkatan_model->ambil_data();
        $this->template->display('akademik/angkatan/index', $data);
    }
    public function cetak2()
    {
        $data['judul'] = "Data Angkatan";
        // $data['css'] = "<link href='../../assets/bootstrap2/css/bootstrap.min.css' rel='stylesheet'>";
        $this->load->view('akademik/angkatan/cetak', $data);
    }
    public function cetak()
    {
        $data['judul'] = "Data Angkatan";
        // $data['css'] = "<link href='../../assets/bootstrap2/css/bootstrap.min.css' rel='stylesheet'>";
        $data['angkatan'] = $this->Angkatan_model->ambil_data();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Data Angkatan";
        $this->pdf->load_view('akademik/angkatan/cetak', $data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode_error' => form_error('id'),
                'angkatan_error' => form_error('angkatan')
            );
        } else {
            $this->Angkatan_model->simpan();
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
        $hasil = $this->Angkatan_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Angkatan_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Angkatan_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'angkatan' => $hasil['angkatan']
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
                'angkatan_error' => form_error('angkatan'),
            );
        } else {
            $this->Angkatan_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function cek_unik()
    {
        $id = $this->input->post('id');
        $hasil = $this->Angkatan_model->cek_id($id);
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
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'required|trim');
    }
}
