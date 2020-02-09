<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelasaktif extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akademik/Tahunakademik_model' => 'Tahunakademik_model', 'akademik/Periodeakademik_model' => 'Periodeakademik_model', 'akademik/Kelas_model' => 'Kelas_model'));
    }
    public function index()
    {
        //echo "Angkatan";
        $data['kontenmenu'] = "Pengaturan";
        $data['kontensubmenu'] = "Kelas Aktif";
        $data['kelasaktif'] = "";
        // $data['tahunakademik'] = $this->Tahunakademik_model->data_fk();
        $data['kelas'] = $this->Semester_model->data_fk();
        $data['periodeakademik'] = $this->Periodeakademik_model->data_fk();
        $this->template->display('akademik/kelasaktif/index', $data);
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
                'semester_error' => form_error('semester_id'),
                'tahunakademik_error' => form_error('tahunakademik_id'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Periodeakademik_model->simpan();
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
        $hasil = $this->Periodeakademik_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Periodeakademik_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Periodeakademik_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'tahunakademik_id' => $hasil['tahunakademik_id'],
                'semester_id' => $hasil['semester_id'],
                'keterangan' => $hasil['keterangan'],
                'awal_periode' => tanggal_indo($hasil['awal_semester']),
                'akhir_periode' => tanggal_indo($hasil['akhir_semester'])
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
                'semester_error' => form_error('semester_id'),
                'tahunakademik_error' => form_error('tahunakademik_id'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Periodeakademik_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function cek_unik()
    {
        $id = $this->input->post('id');
        $hasil = $this->Periodeakademik_model->cek_id($id);
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _validate()
    {
        if (!$this->input->post('idubah')) {
            $this->form_validation->set_rules('id', 'Kode', 'required|trim|exact_length[6]|callback_cek_unik', [
                'cek_unik' => 'Kode telah digunakan oleh data lain !'
            ]);
        }
        $this->form_validation->set_rules('tahunakademik_id', 'Tahun Akademik', 'required|trim');
        $this->form_validation->set_rules('semester_id', 'Semester', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('awal_periode', 'Awal Periode', 'required|trim');
        $this->form_validation->set_rules('akhir_periode', 'Akhir Periode', 'required|trim');
    }
}
