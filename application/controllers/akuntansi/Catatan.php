<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Catatan extends CI_Controller
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
        $data['kontensubmenu'] = "Catatan Atas Laporan Keuangan";
        $pembukuan_id = $this->session->userdata('tahun_buku');
        $data['institusi_id'] = $this->idinstitusi;
        $data['pembukuan_id'] = $pembukuan_id;
        $data['pembukuan'] = $this->Tahunbuku_model->ambil_data();
        $data['buku_awal'] = tanggal_indo($this->session->userdata('buku_awal'));
        $data['buku_akhir'] = tanggal_indo($this->session->userdata('buku_akhir'));
        $this->template->display('akuntansi/laporan/catatan', $data);
    }
    public function viewdata()
    {
        $jenis = $this->input->post('jenis');
        // $data['tanggal'] = tanggal_input($this->input->post('akhir_periode'));
        $data['jenislap'] = $jenis;
        $data['tanggal'] = tanggal_input($this->input->post('akhir_periode'));
        $data['awalbuku'] = tanggal_input($this->input->post('awalbuku'));
        $data['akhirbuku'] = tanggal_input($this->input->post('akhirbuku'));
        $data['pembukuan_id'] = $this->input->post('tahunbuku');
        $data['calk'] = "1";
        $institusi_id = $this->session->userdata('idInstitusi');
        $data['institusi'] = $this->Institusi_model->ambil_data_id($institusi_id);
        // $data['institusi'] = $this->Institusi_model->ambil_data();
        if ($jenis == "4") {
            //lengkap
            $data['calkAkun3'] = $this->Laporan_model->calkAkun3KomKonsolidasi();
            $data['calkAb'] = $this->Laporan_model->calkAbKomKonsolidasi();
            $data['calkPd'] = $this->Laporan_model->calkPdKomKonsolidasi();
            // $data['calkPd'] = $this->Laporan_model->calkPdKomKonsolidasi();
            $this->load->view('akuntansi/laporan/catatan/lengkap', $data);
        } elseif ($jenis == "3") {
            $data['calkAkun3'] = $this->Laporan_model->calkAkun3Konsolidasi();
            $data['calkAb'] = $this->Laporan_model->calkAbKonsolidasi();
            $data['calkPd'] = $this->Laporan_model->calkPdKonsolidasi();
            $this->load->view('akuntansi/laporan/catatan/konsolidasi', $data);
        } elseif ($jenis == "2") {
            $data['calkAkun3'] = $this->Laporan_model->calkAkun3KomInstitusi();
            $data['calkAb'] = $this->Laporan_model->calkAbKomInstitusi();
            $data['calkPd'] = $this->Laporan_model->calkPdKomInstitusi();
            $this->load->view('akuntansi/laporan/catatan/komparatif', $data);
        } else {
            $data['calkAkun3'] = $this->Laporan_model->calkAkun3Institusi();
            $data['calkAb'] = $this->Laporan_model->calkAbInstitusi();
            $data['calkPd'] = $this->Laporan_model->calkPdInstitusi();
            $this->load->view('akuntansi/laporan/catatan/institusi', $data);
        }
    }
    public function cetakdata()
    {
        $institusi_id = $this->session->userdata('idInstitusi');
        $data['institusi'] = $this->Institusi_model->ambil_data_id($institusi_id);
        $data['awalbuku'] = tanggal_input($this->input->post('bukuawal'));
        $data['akhirbuku'] = tanggal_input($this->input->post('bukuakhir'));
        $data['tanggalawal'] = tanggal_input($this->input->post('tgl1'));
        // $data['neracasaldo'] = null;
        // $data['neracasaldo'] = $this->Laporan_model->neracasaldocetak();
        $data['awal_periode'] = $this->input->post('tgl1');
        $data['akhir_periode'] = $this->input->post('tgl2');
        $data['tanggal'] = $this->input->post('tgl2');
        $data['pembukuan_id'] = $this->input->post('pembukuan_id');
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename = "CALK.pdf";
        $laporan = $this->input->post('laporan');
        if ($laporan == "3") {
            $data['judul'] = "CALK Konsolidasi";
            $data['calkAkun3'] = $this->Laporan_model->calkAkun3KonsolidasiCetak();
            $data['calkAb'] = $this->Laporan_model->calkAbKonsolidasiCetak();
            $data['calkPd'] = $this->Laporan_model->calkPdKonsolidasiCetak();
            $this->pdf->load_view('akuntansi/laporan/catatan/cetakkonsolidasi', $data);
        } elseif ($laporan == "2") {
            $data['judul'] = "CALK Komparatif";
            $this->pdf->load_view('akuntansi/laporan/catatan/cetakkomparatif', $data);
        } elseif ($laporan == "4") {
            $data['judul'] = "CALK Konsolidasi Komparatif";
            $this->pdf->load_view('akuntansi/laporan/catatan/cetaklengkap', $data);
        } else {
            $data['judul'] = "CALK Institusi";
            $data['calkAkun3'] = $this->Laporan_model->calkAkun3InstitusiCetak();
            $data['calkAb'] = $this->Laporan_model->calkAbInstitusiCetak();
            $data['calkPd'] = $this->Laporan_model->calkPdInstitusiCetak();
            $this->pdf->load_view('akuntansi/laporan/catatan/cetakinstitusi', $data);
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
