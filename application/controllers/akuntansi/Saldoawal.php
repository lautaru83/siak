<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Saldoawal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        //$this->load->model('akuntansi/Tahunbuku_model', 'Tahunbuku_model');
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'akuntansi/Saldoawal_model' => 'Saldoawal_model', 'akuntansi/Tahunbuku_model' => 'Tahunbuku_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'akuntansi/Transaksi_model' => 'Transaksi_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Pengaturan";
        $data['kontensubmenu'] = "Saldo Awal";
        $data['tahunbuku'] = $this->Tahunbuku_model->ambil_data();
        $this->template->display('akuntansi/saldoawal/index', $data);
    }
    public function konfirmasi($idtahun)
    {
        $unit_id = $this->session->userdata('idInstitusi');
        $th = substr($idtahun, 2, 2);
        $notran = $th . $unit_id . "000000";
        $hasil = $this->Transaksi_model->cektransaldo($idtahun, $unit_id);
        if ($hasil) {
            $idtransaksi = $hasil['id'];
            $this->Transaksi_model->hapusdetailsaldo($idtransaksi);
            $akunsaldo = $this->Kodeperkiraan_model->akunsaldoawal($idtahun, $unit_id);
            foreach ($akunsaldo as $dataAkunsaldo) :
                $a6level_id = $dataAkunsaldo['id'];
                $posisi = $dataAkunsaldo['posisi'];
                $saldoawal = $dataAkunsaldo['saldoawal'];
                $this->Transaksi_model->simpandetailsaldo($idtransaksi, $a6level_id, $posisi, $saldoawal);
            endforeach;
            $akunKhusus = $this->Kodeperkiraan_model->akunkhusus($unit_id);
            if ($akunKhusus) {
                foreach ($akunKhusus as $dataAkunKhusus) :
                    $a6level_id = $dataAkunKhusus['id'];
                    $posisi = "K";
                    $saldoawal = 0;
                    $this->Transaksi_model->simpandetailsaldo($idtransaksi, $a6level_id, $posisi, $saldoawal);
                endforeach;
            }
            // $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            // Pengaturan saldo awal berhasil!</div>');
            // redirect('akuntansi/saldoawal/saldo/' . $idtahun);
        } else {
            $this->Transaksi_model->simpantransaksi($idtahun, $notran, $unit_id);
            $transaksi = $this->Transaksi_model->cektransaldo($idtahun, $unit_id);
            $idtransaksi = $transaksi['id'];
            $akunsaldo = $this->Kodeperkiraan_model->akunsaldoawal($idtahun, $unit_id);
            foreach ($akunsaldo as $dataAkunsaldo) :
                $a6level_id = $dataAkunsaldo['id'];
                $posisi = $dataAkunsaldo['posisi'];
                $saldoawal = $dataAkunsaldo['saldoawal'];
                $this->Transaksi_model->simpandetailsaldo($idtransaksi, $a6level_id, $posisi, $saldoawal);
            endforeach;
            $akunKhusus = $this->Kodeperkiraan_model->akunkhusus($unit_id);
            if ($akunKhusus) {
                foreach ($akunKhusus as $dataAkunKhusus) :
                    $a6level_id = $dataAkunKhusus['id'];
                    $posisi = "K";
                    $saldoawal = 0;
                    $this->Transaksi_model->simpandetailsaldo($idtransaksi, $a6level_id, $posisi, $saldoawal);
                endforeach;
            }
            //$this->Transaksi_model->simpandetailsaldo($idtahun);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
            Pengaturan saldo awal berhasil!</div>');
        redirect('akuntansi/saldoawal/saldo/' . $idtahun);
    }
    public function saldo($idtahun)
    {
        $data['idtahun'] = $idtahun;
        $data['kontenmenu'] = "Pengaturan";
        $data['kontensubmenu'] = "Saldo Awal";
        $data['tahunbuku'] = $this->Tahunbuku_model->ambil_data();
        $data['kodeperkiraan'] = $this->Kodeperkiraan_model->akun_saldo();
        $this->template->display('akuntansi/saldoawal/saldo', $data);
    }
    public function ubah()
    {
        $id = $this->input->post('id');
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'saldoawal_error' => form_error('saldoawal')
            );
        } else {
            $this->Saldoawal_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'saldoawal_error' => form_error('saldoawal')
            );
        } else {
            $this->Saldoawal_model->simpan();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function hapus()
    {
        $akun_id = $this->input->post('a6level_id');
        $thbuku_id = $this->input->post('tahun_pembukuan_id');
        $info = $this->input->post('info');
        $hasil = $this->Saldoawal_model->cek_hapus($thbuku_id, $akun_id);
        if ($hasil == 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Saldoawal_model->hapus($thbuku_id, $akun_id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit()
    {
        $thbuku_id = $this->input->post('tahun_pembukuan_id');
        $a6level_id = $this->input->post('a6level_id');
        $level6 = $this->input->post('level6');
        $hasil = $this->Saldoawal_model->ceksaldo($thbuku_id, $a6level_id);
        if ($hasil) {
            $data = array(
                'status' => 'ubah',
                'id' => $hasil['id'],
                'tahun_pembukuan_id' => $thbuku_id,
                'a6level_id' => $a6level_id,

                'level6' => $level6,
                'saldoawal' => $hasil['saldoawal']
            );
        } else {
            $data = array(
                'status' => 'simpan',
                'tahun_pembukuan_id' => $thbuku_id,
                'level6' => $level6,
                'a6level_id' => $a6level_id
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
        $this->form_validation->set_rules('saldoawal', 'Saldo Awal', 'required|trim');
    }
}
