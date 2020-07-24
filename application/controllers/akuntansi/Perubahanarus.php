<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perubahanarus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        //$this->load->model('akuntansi/Tahunbuku_model', 'Tahunbuku_model');
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'akuntansi/Saldoawal_model' => 'Saldoawal_model', 'akuntansi/Tahunbuku_model' => 'Tahunbuku_model', 'akuntansi/Transaksi_model' => 'Transaksi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'Unit_model' => 'Unit_model', 'akuntansi/Laporan_model' => 'Laporan_model'));
        $this->idinstitusi = $this->session->userdata('idInstitusi');
    }
    public function index()
    {
        $data['kontenmenu'] = "Laporan";
        $data['kontensubmenu'] = "Perubahan Arus Kas";
        $pembukuan_id = $this->session->userdata('tahun_buku');
        $data['institusi_id'] = $this->session->userdata('idInstitusi');
        $data['pembukuan_id'] = $pembukuan_id;
        $data['pembukuan'] = $this->Tahunbuku_model->ambil_data();
        $data['buku_awal'] = tanggal_indo($this->session->userdata('buku_awal'));
        $data['buku_akhir'] = tanggal_indo($this->session->userdata('buku_akhir'));
        $this->template->display('akuntansi/laporan/perubahanarus', $data);
    }
    public function viewdata()
    {
        $jenis = $this->input->post('jenis');
        $data['tanggal'] = tanggal_input($this->input->post('akhir_periode'));
        $data['arus'] = "1";
        $data['tahunbuku'] = $this->input->post('tahunbuku');
        $data['pembukuan_id'] = $this->input->post('tahunbuku');
        $data['awalbuku'] = tanggal_input($this->input->post('awalbuku'));
        $data['akhirbuku'] = tanggal_input($this->input->post('akhirbuku'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $data['jenislap'] = $jenis;
        $data['institusi'] = $this->Institusi_model->ambil_data_id($institusi_id);
        // $data['institusi'] = $this->Institusi_model->ambil_data();
        if ($jenis == "2") {
            $data['kasOp'] = $this->Laporan_model->kasOpKonsolidasi();
            $data['kasInves'] = $this->Laporan_model->kasInvesKonsolidasi();
            $this->load->view('akuntansi/laporan/perubahanarus/konsolidasi', $data);
        } else {
            $data['kasOp'] = $this->Laporan_model->kasOpInstitusi();
            $data['kasInves'] = $this->Laporan_model->kasInvesInstitusi();
            $this->load->view('akuntansi/laporan/perubahanarus/institusi', $data);
        }
    }
    public function cetakdata()
    {
        $institusi_id = $this->session->userdata('idInstitusi');
        $data['institusi'] = $this->Institusi_model->ambil_data_id($institusi_id);
        $data['awalbuku'] = tanggal_input($this->input->post('bukuawal'));
        $data['akhirbuku'] = tanggal_input($this->input->post('bukuakhir'));
        $data['tanggalawal'] = tanggal_input($this->input->post('tgl1'));
        $data['neracasaldo'] = null;
        $data['awal_periode'] = $this->input->post('tgl1');
        $data['akhir_periode'] = $this->input->post('tgl2');
        $data['pembukuan_id'] = $this->input->post('pembukuan_id');
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename = "Aktivitas.pdf";
        $laporan = $this->input->post('laporan');
        if ($laporan == "2") {
            $data['judul'] = "Perubahan Arus Kas Konsolidasi";
            $data['kasOp'] = $this->Laporan_model->kasOpKonsolidasiCetak();
            $data['kasInves'] = $this->Laporan_model->kasInvesKonsolidasiCetak();
            $this->pdf->load_view('akuntansi/laporan/perubahanarus/cetakkonsolidasi', $data);
        } else {
            $data['judul'] = "Perubahan Arus Kas Institusi";
            $data['kasOp'] = $this->Laporan_model->kasOpInstitusiCetak();
            $data['kasInves'] = $this->Laporan_model->kasInvesInstitusiCetak();
            $this->pdf->load_view('akuntansi/laporan/perubahanarus/cetakinstitusi', $data);
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
