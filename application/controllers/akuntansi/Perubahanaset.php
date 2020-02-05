<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perubahanaset extends CI_Controller
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
        $data['kontensubmenu'] = "Perubahan Aset Bersih";
        $pembukuan_id = $this->session->userdata('tahun_buku');
        $data['institusi_id'] = $this->idinstitusi;
        $data['pembukuan_id'] = $this->session->userdata('tahun_buku');
        $data['buku_awal'] = tanggal_indo($this->session->userdata('buku_awal'));
        $data['buku_akhir'] = tanggal_indo($this->session->userdata('buku_akhir'));
        $this->template->display('akuntansi/laporan/perubahanaset', $data);
    }
    public function viewdata()
    {
        $jenis = $this->input->post('jenis');
        $data['tanggal'] = tanggal_input($this->input->post('akhir_periode'));
        $data['activitas'] = "1";
        $institusi_id = $this->session->userdata('idInstitusi');
        $data['institusi'] = $this->Institusi_model->ambil_data_id($institusi_id);
        // $data['institusi'] = $this->Institusi_model->ambil_data();
        if ($jenis == "4") {
            $this->load->view('akuntansi/laporan/perubahanaset/institusi', $data);
        } elseif ($jenis == "3") {
            $data['pttb'] = $this->Laporan_model->pttbKonsolidasi();
            $data['badu'] = $this->Laporan_model->baduKonsolidasi();
            $data['bpdp'] = $this->Laporan_model->bpdpKonsolidasi();
            $data['bpda'] = $this->Laporan_model->bpdaKonsolidasi();
            $data['pbll'] = $this->Laporan_model->pbllKonsolidasi();
            $this->load->view('akuntansi/laporan/perubahanaset/konsolidasi', $data);
        } elseif ($jenis == "2") {
            $this->load->view('akuntansi/laporan/perubahanaset/institusi', $data);
        } else {
            $data['asetLancar'] = $this->Laporan_model->asetLancarInstitusi();
            $data['pttb'] = $this->Laporan_model->pttbInstitusi();
            $data['badu'] = $this->Laporan_model->baduInstitusi();
            $data['bpdp'] = $this->Laporan_model->bpdpInstitusi();
            $data['bpda'] = $this->Laporan_model->bpdaInstitusi();
            $data['pbll'] = $this->Laporan_model->pbllInstitusi();
            $this->load->view('akuntansi/laporan/perubahanaset/institusi', $data);
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
}
