<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahunanggaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        $this->load->model('akuntansi/Tahunanggaran_model', 'Tahunanggaran_model');
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Pembukuan";
        $data['kontensubmenu'] = "Tahun Anggaran";
        $data['tahunanggaran'] = $this->Tahunanggaran_model->ambil_data();
        $this->template->display('akuntansi/tahunanggaran/index', $data);
    }
    public function cetak()
    {
        $data['judul'] = "Data Tahun Anggaran";
        $data['tahunanggaran'] = $this->Tahunanggaran_model->ambil_data();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Data Tahun Anggaran";
        $this->pdf->load_view('akuntansi/tahunanggaran/cetak', $data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'tahunanggaran_error' => form_error('tahunanggaran'),
                'awal_periode_error' => form_error('awal_periode'),
                'akhir_periode_error' => form_error('akhir_periode'),
                'keterangan_error' => form_error('keterangan')
                //'status_error' => form_error('is_active')
            );
        } else {
            $this->Tahunanggaran_model->simpan();
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
        $hasil = $this->Tahunanggaran_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Tahunanggaran_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Tahunanggaran_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'tahunanggaran' => $hasil['tahunanggaran'],
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
    public function tahunaktif()
    {
        $id = $this->input->post('id');
        $info = $this->input->post('info');
        $this->Tahunanggaran_model->tahunaktif($id, $info);
    }
    public function ubah($id)
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'tahunanggaran_error' => form_error('tahunanggaran'),
                'awal_periode_error' => form_error('awal_periode'),
                'akhir_periode_error' => form_error('akhir_periode'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Tahunanggaran_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    private function _validate()
    {
        $this->form_validation->set_rules('tahunanggaran', 'Tahun Anggaran', 'required|trim');
        $this->form_validation->set_rules('awal_periode', 'Awal Periode', 'required|trim');
        $this->form_validation->set_rules('akhir_periode', 'Akhir Periode', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
    }
}
