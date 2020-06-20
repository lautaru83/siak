<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelasaktif extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akademik/Tahunakademik_model' => 'Tahunakademik_model', 'akademik/Periodeakademik_model' => 'Periodeakademik_model', 'akademik/Kelas_model' => 'Kelas_model', 'akademik/Kelasaktif_model' => 'Kelasaktif_model', 'akademik/Mahasiswa_model' => 'Mahasiswa_model', 'akademik/Bop_model' => 'Bop_model'));
    }
    public function index()
    {
        //echo "Angkatan";
        $idPerak = $this->session->userdata('idPerak');
        $data['kontenmenu'] = "Pengaturan";
        $data['kontensubmenu'] = "Kelas Aktif";
        $data['kelasaktif'] = "";
        $data['periode'] = $this->Periodeakademik_model->ambil_data_id($idPerak);
        $data['kelas'] = $this->Kelas_model->data_fk();
        $data['bop'] = $this->Bop_model->data_fk();
        $data['kelasaktif'] = $this->Kelasaktif_model->ambil_data();
        $this->template->display('akademik/kelasaktif/index', $data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'periode_error' => form_error('perak_id'),
                'kelas_error' => form_error('kelas_id')
            );
        } else {
            $this->Kelasaktif_model->simpan();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function mahasiswa($id)
    {
        $data['kontenmenu'] = "Pengaturan";
        $data['kontensubmenu'] = "Mahasiswa Aktif";
        $data['dekelas_id'] = $id;
        $data['detailkelas'] = $this->Kelasaktif_model->detail_data_id($id);
        $data['mahasiswaaktif'] = $this->Kelasaktif_model->mahasiswa_active_id($id); //id detail kelas
        $this->template->display('akademik/kelasaktif/mahasiswa', $data);
    }
    public function hapus()
    {
        $id = $this->input->post('id');
        $info = $this->input->post('info');
        $hasil = $this->Kelasaktif_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Kelasaktif_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Kelasaktif_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'kelas_id' => $hasil['kelas_id'],
                'bop_id' => $hasil['bop_id']
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
                'kelas_error' => form_error('kelas_id'),
                'bop_error' => form_error('bop_id')
            );
        } else {
            $this->Kelasaktif_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function hapusdetail()
    {
        $id = $this->input->post('id'); //id mahasiswaactives
        $info = $this->input->post('info');
        $this->Kelasaktif_model->hapusdetail($id, $info);
        $data = array(
            'status' => 'sukses'
        );
        echo json_encode($data);
    }
    public function ubahmhs()
    {
        $dekelas_id = $this->input->post('dekelas_id');
        $mhs_id = $this->input->post('mhs_id');
        $data = [
            "detailkelas_id" => $dekelas_id,
            "mahasiswa_id" => $mhs_id
        ];
        $hasil = $this->Kelasaktif_model->cek_active($data);
        if ($hasil) {
            $this->Kelasaktif_model->hapusmhs($data);
        } else {
            $this->Kelasaktif_model->simpanmhs($data);
        }
    }
    public function cek_unik()
    {
        $kelas_id = $this->input->post('kelas_id');
        $perak_id = $this->input->post('perak_id');
        $hasil = $this->Kelasaktif_model->cek_id($perak_id, $kelas_id);
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _validate()
    {
        // if (!$this->input->post('idubah')) {
        //     $this->form_validation->set_rules('id', 'Kode', 'required|trim|exact_length[6]|callback_cek_unik', [
        //         'cek_unik' => 'Kode telah digunakan oleh data lain !'
        //     ]);
        // }
        $this->form_validation->set_rules('perak_id', 'Periode Akademik', 'required|trim');
        // $this->form_validation->set_rules('bop_id', 'BOP', 'required|trim');
        if (!$this->input->post('idubah')) {
            $this->form_validation->set_rules('kelas_id', 'Kelas', 'required|trim|callback_cek_unik', [
                'cek_unik' => 'Kelas sudah ada!'
            ]);
        }
    }
}
