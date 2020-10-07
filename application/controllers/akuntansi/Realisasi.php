<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Realisasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        //$this->load->model('akuntansi/Tahunbuku_model', 'Tahunbuku_model');
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'akuntansi/Saldoawal_model' => 'Saldoawal_model', 'akuntansi/Tahunbuku_model' => 'Tahunbuku_model', 'akuntansi/Transaksi_model' => 'Transaksi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'Unit_model' => 'Unit_model', 'akuntansi/Laporan_model' => 'Laporan_model', 'akuntansi/Tahunanggaran_model' => 'Tahunanggaran_model', 'akuntansi/Akunanggaran_model' => 'Akunanggaran_model'));
        $this->idinstitusi = $this->session->userdata('idInstitusi');
    }
    public function index()
    {
        $data['kontenmenu'] = "Laporan";
        $data['kontensubmenu'] = "Realisasi Anggaran";
        $pembukuan_id = $this->session->userdata('tahun_buku');
        $tahunanggaran_id = $this->session->userdata('idTahan');
        $data['institusi_id'] = $this->idinstitusi;
        $data['pembukuan_id'] = $pembukuan_id;
        $data['tahunanggaran_id'] = $pembukuan_id;
        $data['pembukuan'] = $this->Tahunbuku_model->ambil_data();
        $data['tahunanggaran'] = $this->Tahunanggaran_model->ambil_data();
        $data['buku_awal'] = tanggal_indo($this->session->userdata('anggaran_awal'));
        $data['buku_akhir'] = tanggal_indo($this->session->userdata('anggaran_akhir'));
        $data['realisasi'] = null;
        $this->template->display('akuntansi/laporan/realisasi', $data);
    }
    public function viewdata()
    {
        // $jenis = $this->input->post('jenis');
        $data['tanggal'] = tanggal_input($this->input->post('akhir_periode'));
        $data['akhirbuku'] = tanggal_input($this->input->post('akhirbuku'));
        $data['awalbuku'] = tanggal_input($this->input->post('awalbuku'));
        $data['tahunanggaran_id'] = $this->input->post('idTahan');
        $data['pembukuan_id'] = $this->input->post('tahunbuku');
        $data['realisasi'] = "1";
        // $data['jenislap'] = $jenis;
        $institusi_id = $this->session->userdata('idInstitusi');
        $data['institusi'] = $this->Institusi_model->ambil_data_id($institusi_id);
        //$data['kelompok'] = $this->Akunanggaran_model->kelompok_data();
        $data['kelompok'] = $this->Laporan_model->kelompokAnggaran();
        $this->load->view('akuntansi/laporan/realisasi/institusi', $data);
        // $data['institusi'] = $this->Institusi_model->ambil_data();
        // if ($jenis == "4") {
        //     $data['pttb'] = $this->Laporan_model->pttbKomKonsolidasi();
        //     $data['badu'] = $this->Laporan_model->baduKomKonsolidasi();
        //     $data['bpdp'] = $this->Laporan_model->bpdpKomKonsolidasi();
        //     $data['bpda'] = $this->Laporan_model->bpdaKomKonsolidasi();
        //     $data['pbll'] = $this->Laporan_model->pbllKomKonsolidasi();
        //     $this->load->view('akuntansi/laporan/activitas/lengkap', $data);
        // } elseif ($jenis == "3") {
        //     $data['pttb'] = $this->Laporan_model->pttbKonsolidasi();
        //     $data['badu'] = $this->Laporan_model->baduKonsolidasi();
        //     $data['bpdp'] = $this->Laporan_model->bpdpKonsolidasi();
        //     $data['bpda'] = $this->Laporan_model->bpdaKonsolidasi();
        //     $data['pbll'] = $this->Laporan_model->pbllKonsolidasi();
        //     $this->load->view('akuntansi/laporan/activitas/konsolidasi', $data);
        // } elseif ($jenis == "2") {
        //     $data['pttb'] = $this->Laporan_model->pttbKomInstitusi();
        //     $data['badu'] = $this->Laporan_model->baduKomInstitusi();
        //     $data['bpdp'] = $this->Laporan_model->bpdpKomInstitusi();
        //     $data['bpda'] = $this->Laporan_model->bpdaKomInstitusi();
        //     $data['pbll'] = $this->Laporan_model->pbllKomInstitusi();
        //     $this->load->view('akuntansi/laporan/activitas/komparatif', $data);
        // } else {
        //     $data['pttb'] = $this->Laporan_model->pttbInstitusi();
        //     $data['badu'] = $this->Laporan_model->baduInstitusi();
        //     $data['bpdp'] = $this->Laporan_model->bpdpInstitusi();
        //     $data['bpda'] = $this->Laporan_model->bpdaInstitusi();
        //     $data['pbll'] = $this->Laporan_model->pbllInstitusi();
        //     $this->load->view('akuntansi/laporan/activitas/institusi', $data);
        // }
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
        $this->form_validation->set_rules('akhir_periode', 'Tanggal', 'required|trim|callback_cek_tanggal', [
            'cek_tanggal' => 'Diluar periode pembukuan!!'
        ]);
    }
}
