<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahunbuku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        $this->load->model('akuntansi/Tahunbuku_model', 'Tahunbuku_model');
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Pembukuan";
        $data['kontensubmenu'] = "Tahun Pembukuan";
        $data['tahunbuku'] = $this->Tahunbuku_model->ambil_data();
        $this->template->display('akuntansi/tahunbuku/index', $data);
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
                'keterangan_error' => form_error('keterangan'),
                'status_error' => form_error('is_active')
            );
        } else {
            $this->Tahunbuku_model->simpan();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function hapus($id, $info)
    {
        $hasil = $this->Tahunbuku_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Tahunbuku_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Tahunbuku_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'awal_periode' => tanggal_indo($hasil['awal_periode']),
                'akhir_periode' => tanggal_indo($hasil['akhir_periode']),
                'keterangan' => $hasil['keterangan']
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function tahunaktif($id)
    {
        $this->Tahunbuku_model->tahunaktif($id);
    }
    public function ubah($id)
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'awal_periode_error' => form_error('awal_periode'),
                'akhir_periode_error' => form_error('akhir_periode'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Tahunbuku_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function cek_unik()
    {
        $id = $this->input->post('id');
        $hasil = $this->Tahunbuku_model->cek_id($id);
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _validate()
    {
        if (!$this->input->post('idubah')) {
            $this->form_validation->set_rules('id', 'Kode', 'required|trim|numeric|exact_length[4]|callback_cek_unik', [
                'cek_unik' => 'Kode telah digunakan oleh data lain !'
            ]);
        }
        $this->form_validation->set_rules('awal_periode', 'Awal Periode', 'required|trim');
        $this->form_validation->set_rules('akhir_periode', 'Akhir Periode', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
    }
}
