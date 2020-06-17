<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembukuanaktif extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akuntansi/Tahunbuku_model' => 'Tahunbuku_model', 'akuntansi/Tahunanggaran_model' => 'Tahunanggaran_model', 'akuntansi/Pembukuanaktif_model' => 'Pembukuanaktif_model', 'akademik/Periodeakademik_model' => 'Periodeakademik_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Pengaturan";
        $data['kontensubmenu'] = "Pembukuan Aktif";
        $data['tahunbuku'] = $this->Tahunbuku_model->ambil_data();
        $data['tahunanggaran'] = $this->Tahunanggaran_model->ambil_data();
        $data['periodeakademik'] = $this->Periodeakademik_model->ambil_data();
        $pembukuan_id = $this->session->userdata['tahun_buku'];
        $awalbuku = $this->session->userdata['buku_awal'];
        $akhirbuku = $this->session->userdata['buku_akhir'];
        $anggaran_id = $this->session->userdata['idTahan'];
        $awalanggaran = $this->session->userdata['anggaran_awal'];
        $akhiranggaran = $this->session->userdata['anggaran_akhir'];
        $akademik_id = $this->session->userdata['idTakad'];
        // $awalakademik = $this->session->userdata['akademik_awal'];
        // $akhirakademik = $this->session->userdata['akademik_akhir'];
        $perak_id = $this->session->userdata['idPerak'];
        $awalsemester = $this->session->userdata['semester_awal'];
        $akhirsemester = $this->session->userdata['semester_akhir'];
        $data['awalbuku'] = $awalbuku;
        $data['akhirbuku'] = $akhirbuku;
        $data['pembukuan_id'] = $pembukuan_id;
        $data['awalanggaran'] = $awalanggaran;
        $data['akhiranggaran'] = $akhiranggaran;
        $data['anggaran_id'] = $anggaran_id;
        $data['perak_id'] = $perak_id;
        $data['awalsemester'] = $awalsemester;
        $data['akhirsemester'] = $akhirsemester;
        $data['akademik_id'] = $akademik_id;
        $data['periodeakad_id'] = $akademik_id . "/" . $perak_id;


        //$this->input->post('awalbuku')=$awalbuku;
        $this->template->display('akuntansi/pembukuanaktif/index', $data);
    }
    // public function simpan()
    // {
    //     $this->_validate();
    //     if ($this->form_validation->run() == false) {
    //         $data = array(
    //             'status' => 'gagal',
    //             'kode_error' => form_error('id'),
    //             'awal_periode_error' => form_error('awal_periode'),
    //             'akhir_periode_error' => form_error('akhir_periode'),
    //             'keterangan_error' => form_error('keterangan'),
    //             'status_error' => form_error('is_active')
    //         );
    //     } else {
    //         $this->Tahunbuku_model->simpan();
    //         $data = array(
    //             'status' => 'sukses'
    //         );
    //     }
    //     echo json_encode($data);
    // }
    // public function hapus($id, $info)
    // {
    //     $hasil = $this->Tahunbuku_model->cek_hapus($id);
    //     if ($hasil > 0) {
    //         $data = array(
    //             'status' => 'gagal'
    //         );
    //     } else {
    //         $this->Tahunbuku_model->hapus($id, $info);
    //         $data = array(
    //             'status' => 'sukses'
    //         );
    //     }
    //     echo json_encode($data);
    // }
    public function ajaxcombobuku($id)
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
    public function ajaxcomboanggaran($id)
    {
        $hasil = $this->Tahunanggaran_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                // 'id' => $hasil['id'],
                // 'tahunanggaran' => $hasil['tahunanggaran'],
                'awal_periode' => tanggal_indo($hasil['awal_periode']),
                'akhir_periode' => tanggal_indo($hasil['akhir_periode'])
                // 'keterangan' => $hasil['keterangan']
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function ajaxcomboperak($id)
    {
        $hasil = $this->Periodeakademik_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                // 'id' => $hasil['id'],
                'tahunakademik_id' => $hasil['tahunakademik_id'],
                // 'semester_id' => $hasil['semester_id'],
                // 'keterangan' => $hasil['keterangan'],
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
    // public function tahunaktif($id)
    // {
    //     $this->Tahunbuku_model->tahunaktif($id);
    // }
    // public function ubah($id)
    // {
    //     $this->_validate();
    //     if ($this->form_validation->run() == false) {
    //         $data = array(
    //             'status' => 'gagal',
    //             'awal_periode_error' => form_error('awal_periode'),
    //             'akhir_periode_error' => form_error('akhir_periode'),
    //             'keterangan_error' => form_error('keterangan')
    //         );
    //     } else {
    //         $this->Tahunbuku_model->ubah($id);
    //         $data = array(
    //             'status' => 'sukses'
    //         );
    //     }
    //     echo json_encode($data);
    // }
    // public function cek_unik()
    // {
    //     $id = $this->input->post('id');
    //     $hasil = $this->Tahunbuku_model->cek_id($id);
    //     if ($hasil > 0) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }
    private function _validate()
    {
        // if (!$this->input->post('idubah')) {
        //     $this->form_validation->set_rules('id', 'Kode', 'required|trim|numeric|exact_length[4]|callback_cek_unik', [
        //         'cek_unik' => 'Kode telah digunakan oleh data lain !'
        //     ]);
        // }
        // $this->form_validation->set_rules('awal_periode', 'Awal Periode', 'required|trim');
        // $this->form_validation->set_rules('akhir_periode', 'Akhir Periode', 'required|trim');
        // $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
    }
}
