<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bukubesar extends CI_Controller
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
        $data['kontensubmenu'] = "Buku Besar";
        $institusi_id = $this->session->userdata('idInstitusi');
        $pembukuan_id = $this->session->userdata('tahun_buku');
        $data['pembukuan_id'] = $pembukuan_id;
        $data['pembukuan'] = $this->Tahunbuku_model->ambil_data();
        $awal_periode = tanggal_indo($this->session->userdata('buku_awal'));
        $akhir_periode = tanggal_indo($this->session->userdata('buku_akhir'));
        $data['awal_periode'] = $awal_periode;
        $data['akhir_periode'] = $akhir_periode;
        $data['awalbuku'] = $awal_periode;
        $data['akhirbuku'] = $akhir_periode;
        $data['laporan'] = null;
        //$data['unit'] = $this->Unit_model->ambil_data_institusi_id($institusi_id);
        $data['akunbuku'] = $this->Kodeperkiraan_model->akun_bukubesar();
        $this->template->display('akuntansi/laporan/bukubesar', $data);
        //$this->template->display('akuntansi/transaksi/kasmasuk');
    }
    public function viewdata()
    {
        $data['laporan'] = 1;
        $data['awalbuku'] = tanggal_input($this->input->post('awalbuku'));
        $data['pembukuan_id'] = $this->input->post('tahunbuku');
        $data['tanggalawal'] = tanggal_input($this->input->post('awal_periode'));
        $data['awal_periode'] = tanggal_input($this->input->post('awal_periode'));
        $data['akhir_periode'] = tanggal_input($this->input->post('akhir_periode'));
        $data['a6level_id'] = $this->input->post('a6level_id');
        $data['bukubesar'] = $this->Laporan_model->bukubesar();
        $this->load->view('akuntansi/laporan/bukubesar/institusi', $data);
    }
    public function cetakdata()
    {
        $data['judul'] = "Buku Besar";
        $data['awalbuku'] = tanggal_input($this->input->post('bukuawal'));
        $data['tanggalawal'] = tanggal_input($this->input->post('tgl1'));
        $data['bukubesar'] = $this->Laporan_model->bukubesarcetak();
        $data['awal_periode'] = $this->input->post('tgl1');
        $data['akhir_periode'] = $this->input->post('tgl2');
        $data['a6level_id'] = $this->input->post('akun_id');
        $data['pembukuan_id'] = $this->input->post('pembukuan_id');
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename = "Buku Besar";
        $this->pdf->load_view('akuntansi/laporan/bukubesar/cetakdata', $data);
    }
    public function cekinput()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $response = array(
                'status' => 'gagal',
                'akun_error' => form_error('a6level_id'),
                'akhir_error' => form_error('akhir_periode'),
                'awal_error' => form_error('awal_periode')
            );
        } else {
            $response = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($response);
    }
    public function data()
    {
        $data['kontenmenu'] = "Laporan";
        $data['kontensubmenu'] = "Buku Besar";
        $data['bukubesar'] = "";
        //$data['neracasaldo'] = "";
        $pembukuan_id = $this->input->post('bb_pembukuan_id');
        $data['pembukuan_id'] = $pembukuan_id;
        $data['pembukuan'] = $this->Tahunbuku_model->ambil_data();
        $data['awalbuku'] = $this->input->post('awalbuku');
        $data['tanggalawal'] = $this->input->post('awal_periode');
        $data['awal_periode'] = $this->input->post('awal_periode');
        $data['akhir_periode'] = $this->input->post('akhir_periode');
        $data['a6level_id'] = $this->input->post('a6level_id');

        $this->_validatejurnal();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'awal_error' => form_error('awal_periode'),
                'akhir_error' => form_error('akhir_periode')
            );
        } else {
            $data['bukubesar'] = $this->Laporan_model->bukubesar();
        }
        $data['akunbuku'] = $this->Kodeperkiraan_model->akun_bukubesar();
        $this->template->display('akuntansi/laporan/bukubesardata', $data);
    }
    public function cek_tanggalawal()
    {
        $awal_periode = strtotime($this->input->post('awal_periode'));
        $buku_awal = strtotime($this->input->post('awalbuku'));
        $buku_akhir = strtotime($this->input->post('akhirbuku'));
        if ($awal_periode < $buku_awal) {
            return false;
        } elseif ($awal_periode > $buku_akhir) {
            return false;
        } else {
            return true;
        }
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
        $this->form_validation->set_rules('a6level_id', 'Akun', 'required|trim');
        $this->form_validation->set_rules('akhir_periode', 'Akhir periode', 'required|trim|callback_cek_tanggalakhir', [
            'cek_tanggalakhir' => 'Tanggal tidak valid!!'
        ]);
        $this->form_validation->set_rules('awal_periode', 'Awal periode', 'required|trim|callback_cek_tanggalawal', [
            'cek_tanggalawal' => 'Tanggal tidak valid!!'
        ]);
    }

    private function _validatejurnal()
    {
        //$this->form_validation->set_rules('awal_periode', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('akhir_periode', 'Tanggal', 'required|trim');
        // $this->form_validation->set_rules('akhir_periode', 'Tanggal', 'required|trim');
        // $this->form_validation->set_rules('awal_periode', 'Tanggal', 'required|trim|callback_cek_tanggal', [
        //     'cek_tanggal' => 'Diluar periode pembukuan!!'
        // ]);
        // $this->form_validation->set_rules('keterangan', 'uraian', 'required|trim');
        // $this->form_validation->set_rules('unit_id', 'Unit Usaha', 'required|trim');
    }
}
