<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detailtahunajaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akademik/Tahunajaran_model' => 'Tahunajaran_model', 'akademik/Detailtahunajaran_model' => 'Detailtahunajaran_model', 'akademik/Semester_model' => 'Semester_model'));
    }
    public function index()
    {
        //echo "Angkatan";
        $data['kontenmenu'] = "Pengaturan";
        $data['kontensubmenu'] = "Detail Tahun Ajaran";
        $data['detailtahun'] = $this->Detailtahunajaran_model->ambil_data();
        $data['tahunajaran'] = $this->Tahunajaran_model->data_fk();
        $data['semester'] = $this->Semester_model->data_fk();
        $this->template->display('akademik/detailtahunajaran/index', $data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'tahun_ajaran_error' => form_error('tahun_ajaran_id'),
                'semester_error' => form_error('semester_id'),
                'awal_periode_error' => form_error('awal_periode_id'),
                'akhir_periode_error' => form_error('akhir_periode_id'),
                'keterangan_error' => form_error('keterangan'),
            );
        } else {
            $hasil = $this->Detailtahunajaran_model->cekunikdetail();
            if ($hasil == 0) {
                $this->Detailtahunajaran_model->simpan();
                $data = array(
                    'status' => 'sukses'
                );
            } else {
                $data = array(
                    'status' => 'batal'
                );
            }
        }
        echo json_encode($data);
    }
    public function hapus()
    {
        $id = $this->input->post('id');
        $info = $this->input->post('info');
        $hasil = $this->Detailtahunajaran_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Detailtahunajaran_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Detailtahunajaran_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'tahun_ajaran_id' => $hasil['tahun_ajaran_id'],
                'semester_id' => $hasil['semester_id'],
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
    public function ubah($id)
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'tahun_ajaran_error' => form_error('tahun_ajaran_id'),
                'semester_error' => form_error('semester_id'),
                'awal_periode_error' => form_error('awal_periode_id'),
                'akhir_periode_error' => form_error('akhir_periode_id'),
                'keterangan_error' => form_error('keterangan'),
            );
        } else {
            $hasil = $this->Detailtahunajaran_model->cekunikdetail();
            if ($hasil == 0) {
                $this->Detailtahunajaran_model->ubah($id);
                $data = array(
                    'status' => 'sukses'
                );
            } else {
                $data = array(
                    'status' => 'batal'
                );
            }
        }
        echo json_encode($data);
    }
    // public function cek_unik()
    // {
    //     $id = $this->input->post('id');
    //     $hasil = $this->Detailtahunajaran_model->cek_id($id);
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
        $this->form_validation->set_rules('tahun_ajaran_id', 'Tahun ajaran', 'required|trim');
        $this->form_validation->set_rules('semester_id', 'Semester', 'required|trim');
        $this->form_validation->set_rules('awal_periode', 'Awal periode', 'required|trim');
        $this->form_validation->set_rules('akhir_periode', 'akhir_periode', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required|trim');
    }
}
