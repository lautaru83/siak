<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Neracasaldo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        //$this->load->model('akuntansi/Tahunbuku_model', 'Tahunbuku_model');
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'akuntansi/Saldoawal_model' => 'Saldoawal_model', 'akuntansi/Tahunbuku_model' => 'Tahunbuku_model', 'akuntansi/Transaksi_model' => 'Transaksi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'Unit_model' => 'Unit_model', 'akuntansi/Laporan_model' => 'Laporan_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Laporan";
        $data['kontensubmenu'] = "Neraca Saldo";
        $institusi_id = $this->session->userdata('idInstitusi');
        $pembukuan_id = $this->session->userdata('tahun_buku');
        $data['pembukuan_id'] = $pembukuan_id;
        $data['pembukuan'] = $this->Tahunbuku_model->ambil_data();
        //$data['neracasaldo'] = "";
        $awal_periode = tanggal_indo($this->session->userdata('buku_awal'));
        $akhir_periode = tanggal_indo($this->session->userdata('buku_akhir'));
        $data['awal_periode'] = $awal_periode;
        $data['akhir_periode'] = $akhir_periode;
        $data['awalbuku'] = $awal_periode;
        $data['akhirbuku'] = $akhir_periode;
        $data['laporan'] = "";
        $this->template->display('akuntansi/laporan/neracasaldo', $data);
    }
    public function viewdata()
    {
        $data['laporan'] = 1;
        $data['awalbuku'] = tanggal_input($this->input->post('awalbuku'));
        $data['pembukuan_id'] = $this->input->post('tahunbuku');
        $data['akhirbuku'] = tanggal_input($this->input->post('akhirbuku'));
        $data['akhir_periode'] = tanggal_input($this->input->post('akhir_periode'));
        $data['neracasaldo'] = $this->Laporan_model->neracasaldo();
        $this->load->view('akuntansi/laporan/neracasaldo/institusi', $data);
    }
    // public function data()
    // {
    //     $data['kontenmenu'] = "Laporan";
    //     $data['kontensubmenu'] = "Neraca Saldo";
    //     $data['neracasaldo'] = "";
    //     $pembukuan_id = $this->input->post('ns_pembukuan_id');
    //     $data['pembukuan_id'] = $pembukuan_id;
    //     $data['pembukuan'] = $this->Tahunbuku_model->ambil_data();
    //     $data['awal_periode'] = $this->input->post('awalperiode');
    //     $data['akhir_periode'] = $this->input->post('akhir_periode');
    //     $this->_validatejurnal();
    //     if ($this->form_validation->run() == false) {
    //         $data = array(
    //             'status' => 'gagal',
    //             //'awal_error' => form_error('awal_periode'),
    //             'akhir_error' => form_error('akhir_periode')
    //         );
    //     } else {
    //         $data['neracasaldo'] = $this->Laporan_model->neracasaldo();
    //     }
    //     $this->template->display('akuntansi/laporan/neracasaldodata', $data);
    // }
    public function cekinput()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $response = array(
                'status' => 'gagal',
                'akhir_error' => form_error('akhir_periode')
            );
        } else {
            $response = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($response);
    }
    public function cek_tanggalakhir()
    {
        $akhir_periode = strtotime($this->input->post('akhir_periode'));
        $buku_awal = strtotime($this->input->post('awalbuku'));
        $buku_akhir = strtotime($this->input->post('akhirbuku'));
        if ($akhir_periode < $buku_awal) {
            return false;
        } elseif ($akhir_periode > $buku_akhir) {
            return false;
        } else {
            return true;
        }
    }
    private function _validate()
    {
        // $this->form_validation->set_rules('a6level_id', 'Akun', 'required|trim');
        $this->form_validation->set_rules('akhir_periode', 'Akhir periode', 'required|trim|callback_cek_tanggalakhir', [
            'cek_tanggalakhir' => 'Tanggal tidak valid!!'
        ]);
        // $this->form_validation->set_rules('awal_periode', 'Awal periode', 'required|trim|callback_cek_tanggalawal', [
        //     'cek_tanggalawal' => 'Tanggal tidak valid!!'
        // ]);
    }


    // public function tampiljurnal()
    // {
    //     $this->_validatejurnal();
    //     if ($this->form_validation->run() == false) {
    //         $data = array(
    //             'status' => 'gagal',
    //             'awal_error' => form_error('a6level_id'),
    //             'posisi_error' => form_error('posisi_akun'),
    //             'jumlah_error' => form_error('jumlah')
    //         );
    //     } else {
    //         $this->Laporan_model->jurnal();
    //         $data = array(
    //             'status' => 'sukses'
    //         );
    //     }
    // }
}
