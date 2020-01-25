<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        //$this->load->model('akuntansi/Tahunbuku_model', 'Tahunbuku_model');
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'akuntansi/Saldoawal_model' => 'Saldoawal_model', 'akuntansi/Transaksi_model' => 'Transaksi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'Unit_model' => 'Unit_model'));
    }
    public function kasmasuk()
    {
        $institusi_id = $this->session->userdata('idInstitusi');
        $data['pembukuan_id'] = $this->session->userdata('tahun_buku');
        $data['kontenmenu'] = "Transaksi";
        $data['kontensubmenu'] = "Jurnal Kas Masuk";
        $data['unit'] = $this->Unit_model->ambil_data_institusi_id($institusi_id);
        $this->template->display('akuntansi/transaksi/kasmasuk', $data);
        //$this->template->display('akuntansi/transaksi/kasmasuk');
    }
    // public function saldo($idtahun)
    // {
    //     $data['idtahun'] = $idtahun;
    //     $data['kontenmenu'] = "Pengaturan";
    //     $data['kontensubmenu'] = "Saldo Awal";
    //     $data['tahunbuku'] = $this->Tahunbuku_model->ambil_data();
    //     $data['kodeperkiraan'] = $this->Kodeperkiraan_model->akun_saldo();
    //     $this->template->display('akuntansi/saldoawal/saldo', $data);
    // }
    // public function ubah()
    // {
    //     $id = $this->input->post('id');
    //     $this->_validate();
    //     if ($this->form_validation->run() == false) {
    //         $data = array(
    //             'status' => 'gagal',
    //             'saldoawal_error' => form_error('saldoawal')
    //         );
    //     } else {
    //         $this->Saldoawal_model->ubah($id);
    //         $data = array(
    //             'status' => 'sukses'
    //         );
    //     }
    //     echo json_encode($data);
    // }
    // public function simpan()
    // {
    //     $this->_validate();
    //     if ($this->form_validation->run() == false) {
    //         $data = array(
    //             'status' => 'gagal',
    //             'saldoawal_error' => form_error('saldoawal')
    //         );
    //     } else {
    //         $this->Saldoawal_model->simpan();
    //         $data = array(
    //             'status' => 'sukses'
    //         );
    //     }
    //     echo json_encode($data);
    // }
    // public function hapus()
    // {
    //     $akun_id = $this->input->post('a6level_id');
    //     $thbuku_id = $this->input->post('tahun_pembukuan_id');
    //     $info = $this->input->post('info');
    //     $hasil = $this->Saldoawal_model->cek_hapus($thbuku_id, $akun_id);
    //     if ($hasil == 0) {
    //         $data = array(
    //             'status' => 'gagal'
    //         );
    //     } else {
    //         $this->Saldoawal_model->hapus($thbuku_id, $akun_id, $info);
    //         $data = array(
    //             'status' => 'sukses'
    //         );
    //     }
    //     echo json_encode($data);
    // }
    // public function ajax_edit()
    // {
    //     $thbuku_id = $this->input->post('tahun_pembukuan_id');
    //     $a6level_id = $this->input->post('a6level_id');
    //     $level6 = $this->input->post('level6');
    //     $hasil = $this->Saldoawal_model->ceksaldo($thbuku_id, $a6level_id);
    //     if ($hasil) {
    //         $data = array(
    //             'status' => 'ubah',
    //             'id' => $hasil['id'],
    //             'tahun_pembukuan_id' => $thbuku_id,
    //             'a6level_id' => $a6level_id,

    //             'level6' => $level6,
    //             'saldoawal' => $hasil['saldoawal']
    //         );
    //     } else {
    //         $data = array(
    //             'status' => 'simpan',
    //             'tahun_pembukuan_id' => $thbuku_id,
    //             'level6' => $level6,
    //             'a6level_id' => $a6level_id
    //         );
    //     }
    //     echo json_encode($data);
    // }
    // private function _validate()
    // {
    //     $this->form_validation->set_rules('saldoawal', 'Saldo Awal', 'required|trim');
    // }
}
