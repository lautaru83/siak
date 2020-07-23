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
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'akuntansi/Saldoawal_model' => 'Saldoawal_model', 'akuntansi/Tahunbuku_model' => 'Tahunbuku_model', 'akuntansi/Transaksi_model' => 'Transaksi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'Unit_model' => 'Unit_model', 'akuntansi/Laporan_model' => 'Laporan_model'));
        $this->idinstitusi = $this->session->userdata('idInstitusi');
    }
    public function index()
    {
        $data['kontenmenu'] = "Laporan";
        $data['kontensubmenu'] = "Perubahan Aset Bersih";
        $pembukuan_id = $this->session->userdata('tahun_buku');
        $data['institusi_id'] = $this->session->userdata('idInstitusi');
        $data['pembukuan_id'] = $pembukuan_id;
        $data['pembukuan'] = $this->Tahunbuku_model->ambil_data();
        $data['buku_awal'] = tanggal_indo($this->session->userdata('buku_awal'));
        $data['buku_akhir'] = tanggal_indo($this->session->userdata('buku_akhir'));
        $this->template->display('akuntansi/laporan/perubahanaset', $data);
    }
    public function viewdata()
    {
        $jenis = $this->input->post('jenis');
        $data['tanggal'] = tanggal_input($this->input->post('akhir_periode'));
        $data['activitas'] = "1";
        $data['tahunbuku'] = $this->input->post('tahunbuku');
        $data['pembukuan_id'] = $this->input->post('tahunbuku');
        $data['awalbuku'] = tanggal_input($this->input->post('awalbuku'));
        $data['akhirbuku'] = tanggal_input($this->input->post('akhirbuku'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $data['jenislap'] = $jenis;
        $data['institusi'] = $this->Institusi_model->ambil_data_id($institusi_id);
        // $data['institusi'] = $this->Institusi_model->ambil_data();
        if ($jenis == "4") {
            $data['pttb'] = $this->Laporan_model->pttbKomKonsolidasi();
            $data['badu'] = $this->Laporan_model->baduKomKonsolidasi();
            $data['bpdp'] = $this->Laporan_model->bpdpKomKonsolidasi();
            $data['bpda'] = $this->Laporan_model->bpdaKomKonsolidasi();
            $data['pbll'] = $this->Laporan_model->pbllKomKonsolidasi();
            $this->load->view('akuntansi/laporan/perubahanaset/lengkap', $data);
        } elseif ($jenis == "3") {
            $data['pttb'] = $this->Laporan_model->pttbKonsolidasi();
            $data['badu'] = $this->Laporan_model->baduKonsolidasi();
            $data['bpdp'] = $this->Laporan_model->bpdpKonsolidasi();
            $data['bpda'] = $this->Laporan_model->bpdaKonsolidasi();
            $data['pbll'] = $this->Laporan_model->pbllKonsolidasi();
            $this->load->view('akuntansi/laporan/perubahanaset/konsolidasi', $data);
        } elseif ($jenis == "2") {
            $data['pttb'] = $this->Laporan_model->pttbKomInstitusi();
            $data['badu'] = $this->Laporan_model->baduKomInstitusi();
            $data['bpdp'] = $this->Laporan_model->bpdpKomInstitusi();
            $data['bpda'] = $this->Laporan_model->bpdaKomInstitusi();
            $data['pbll'] = $this->Laporan_model->pbllKomInstitusi();
            $this->load->view('akuntansi/laporan/perubahanaset/komparatif', $data);
        } else {
            //$data['asetLancar'] = $this->Laporan_model->asetLancarInstitusi();
            $data['pttb'] = $this->Laporan_model->pttbInstitusi();
            $data['badu'] = $this->Laporan_model->baduInstitusi();
            $data['bpdp'] = $this->Laporan_model->bpdpInstitusi();
            $data['bpda'] = $this->Laporan_model->bpdaInstitusi();
            $data['pbll'] = $this->Laporan_model->pbllInstitusi();
            $this->load->view('akuntansi/laporan/perubahanaset/institusi', $data);
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
        if ($laporan == "3") {
            $data['judul'] = "Perubahan Aset Konsolidasi";
            $data['pttb'] = $this->Laporan_model->pttbKonsolidasiCetak();
            $data['badu'] = $this->Laporan_model->baduKonsolidasiCetak();
            $data['bpdp'] = $this->Laporan_model->bpdpKonsolidasiCetak();
            $data['bpda'] = $this->Laporan_model->bpdaKonsolidasiCetak();
            $data['pbll'] = $this->Laporan_model->pbllKonsolidasiCetak();
            $this->pdf->load_view('akuntansi/laporan/perubahanaset/cetakkonsolidasi', $data);
        } elseif ($laporan == "2") {
            $data['judul'] = "Perubahan Aset Komparatif";
            $data['pttb'] = $this->Laporan_model->pttbKomInstitusiCetak();
            $data['badu'] = $this->Laporan_model->baduKomInstitusiCetak();
            $data['bpdp'] = $this->Laporan_model->bpdpKomInstitusiCetak();
            $data['bpda'] = $this->Laporan_model->bpdaKomInstitusiCetak();
            $data['pbll'] = $this->Laporan_model->pbllKomInstitusiCetak();
            $this->pdf->load_view('akuntansi/laporan/perubahanaset/cetakkomparatif', $data);
        } elseif ($laporan == "4") {
            $data['judul'] = "Perubahan Aset Komparatif Konsolidasi";
            $data['pttb'] = $this->Laporan_model->pttbKomKonsolidasiCetak();
            $data['badu'] = $this->Laporan_model->baduKomKonsolidasiCetak();
            $data['bpdp'] = $this->Laporan_model->bpdpKomKonsolidasiCetak();
            $data['bpda'] = $this->Laporan_model->bpdaKomKonsolidasiCetak();
            $data['pbll'] = $this->Laporan_model->pbllKomKonsolidasiCetak();
            $this->pdf->load_view('akuntansi/laporan/perubahanaset/cetaklengkap', $data);
        } else {
            $data['judul'] = "Perubahan Aset Institusi";
            $data['pttb'] = $this->Laporan_model->pttbInstitusiCetak();
            $data['badu'] = $this->Laporan_model->baduInstitusiCetak();
            $data['bpdp'] = $this->Laporan_model->bpdpInstitusiCetak();
            $data['bpda'] = $this->Laporan_model->bpdaInstitusiCetak();
            $data['pbll'] = $this->Laporan_model->pbllInstitusiCetak();
            $this->pdf->load_view('akuntansi/laporan/perubahanaset/cetakinstitusi', $data);
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
