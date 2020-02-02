<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Neraca extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        //$this->load->model('akuntansi/Tahunbuku_model', 'Tahunbuku_model');
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'akuntansi/Saldoawal_model' => 'Saldoawal_model', 'akuntansi/Transaksi_model' => 'Transaksi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'Unit_model' => 'Unit_model', 'akuntansi/Laporan_model' => 'Laporan_model'));
        $this->idinstitusi = $this->session->userdata('idInstitusi');
    }
    public function index()
    {
        $data['kontenmenu'] = "Laporan";
        $data['kontensubmenu'] = "Neraca";
        $pembukuan_id = $this->session->userdata('tahun_buku');
        $data['institusi_id'] = $this->idinstitusi;
        $data['pembukuan_id'] = $this->session->userdata('tahun_buku');
        $data['buku_awal'] = tanggal_indo($this->session->userdata('buku_awal'));
        $data['buku_akhir'] = tanggal_indo($this->session->userdata('buku_akhir'));
        $data['jurnal'] = "";
        $tanggal = $this->input->post('tanggal');
        if ($tanggal) {
            $data['kontensubmenu'] = "OK";
        }
        //$data['unit'] = $this->Unit_model->ambil_data_institusi_id($institusi_id);
        $this->template->display('akuntansi/laporan/neraca', $data);
        //$this->template->display('akuntansi/transaksi/kasmasuk');
    }
    public function data()
    {
        $data['kontenmenu'] = "Laporan";
        $data['kontensubmenu'] = "Neraca Saldo";
        $data['neracasaldo'] = "";
        //$data['neracasaldo'] = "";
        $data['awal_periode'] = $this->input->post('awal_periode');
        $data['akhir_periode'] = $this->input->post('akhir_periode');
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                //'awal_error' => form_error('awal_periode'),
                'akhir_error' => form_error('akhir_periode')
            );
        } else {
            $data['neracasaldo'] = $this->Laporan_model->neracasaldo();
        }
        $this->template->display('akuntansi/laporan/neracasaldodata', $data);
    }
    public function viewdata()
    {
        $jenis = $this->input->post('jenis');
        $data['tanggal'] = tanggal_input($this->input->post('akhir_periode'));
        $data['neraca'] = "1";
        //$data['jurnal'] = $this->Institusi_model->ambil_data();
        if ($jenis == "4") {
            $this->load->view('akuntansi/laporan/neraca/lengkap', $data);
        } elseif ($jenis == "3") {
            $this->load->view('akuntansi/laporan/neraca/konsolidasi', $data);
        } elseif ($jenis == "2") {
            $this->load->view('akuntansi/laporan/neraca/komparatif', $data);
        } else {
            $data['asetLancar'] = $this->Laporan_model->asetLancarInstitusi();
            $data['asetTidakLancar'] = $this->Laporan_model->asetTidakLancarInstitusi();
            $data['kewajiban'] = $this->Laporan_model->kewajibanInstitusi();
            $data['bersihTidakTerikat'] = $this->Laporan_model->bersihTidakTerikatInstitusi();
            $data['bersihTerikat'] = $this->Laporan_model->bersihTerikatInstitusi();
            $this->load->view('akuntansi/laporan/neraca/institusi', $data);
        }
    }
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
    public function cek_tanggal()
    {
        $akhir_periode = strtotime($this->input->post('akhir_periode'));
        $buku_awal = strtotime($this->session->userdata['buku_awal']);
        $buku_akhir = strtotime($this->session->userdata['buku_akhir']);
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
        //$this->form_validation->set_rules('awal_periode', 'Tanggal', 'required|trim');
        //$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
        // $this->form_validation->set_rules('akhir_periode', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('akhir_periode', 'Tanggal', 'required|trim|callback_cek_tanggal', [
            'cek_tanggal' => 'Diluar periode pembukuan!!'
        ]);
        // $this->form_validation->set_rules('keterangan', 'uraian', 'required|trim');
        // $this->form_validation->set_rules('unit_id', 'Unit Usaha', 'required|trim');
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
