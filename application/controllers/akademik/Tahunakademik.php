<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahunakademik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akademik/Tahunakademik_model' => 'Tahunakademik_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Akademik";
        $data['kontensubmenu'] = "Tahun Akademik";
        $data['tahunakademik'] = $this->Tahunakademik_model->ambil_data();
        $this->template->display('akademik/tahunakademik/index', $data);
    }
    public function cetak()
    {
        $data['judul'] = "Data Tahun Akademik";
        $data['tahunakademik'] = $this->Tahunakademik_model->ambil_data();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Data Tahun Akademik";
        $this->pdf->load_view('akademik/tahunakademik/cetak', $data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode_error' => form_error('id'),
                'awal_periode_error' => form_error('awal_periode'),
                'akhir_periode_error' => form_error('akhir_periode'),
                'tahunakademik_error' => form_error('tahunakademik')
            );
        } else {
            $this->Tahunakademik_model->simpan();
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
        $hasil = $this->Tahunakademik_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Tahunakademik_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Tahunakademik_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'awal_periode' => tanggal_indo($hasil['awal_periode']),
                'akhir_periode' => tanggal_indo($hasil['akhir_periode']),
                'tahunakademik' => $hasil['tahunakademik']
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
                'awal_periode_error' => form_error('awal_periode'),
                'akhir_periode_error' => form_error('akhir_periode'),
                'tahunakademik_error' => form_error('tahunakademik')
            );
        } else {
            $this->Tahunakademik_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function cek_unik()
    {
        $id = $this->input->post('id');
        $hasil = $this->Tahunakademik_model->cek_id($id);
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _validate()
    {
        if (!$this->input->post('idubah')) {
            $this->form_validation->set_rules('id', 'Kode', 'required|trim|exact_length[4]|callback_cek_unik', [
                'cek_unik' => 'Kode telah digunakan oleh data lain !'
            ]);
        }
        $this->form_validation->set_rules('tahunakademik', 'Tahun Akademik', 'required|trim');
        $this->form_validation->set_rules('awal_periode', 'Awal Periode', 'required|trim');
        $this->form_validation->set_rules('akhir_periode', 'Akhir Periode', 'required|trim');
    }
}
