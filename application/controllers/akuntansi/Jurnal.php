<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurnal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        //$this->load->model('akuntansi/Tahunbuku_model', 'Tahunbuku_model');
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Tahunbuku_model' => 'Tahunbuku_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'akuntansi/Saldoawal_model' => 'Saldoawal_model', 'akuntansi/Transaksi_model' => 'Transaksi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'Unit_model' => 'Unit_model', 'akuntansi/Laporan_model' => 'Laporan_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Laporan";
        $data['kontensubmenu'] = "Jurnal Transaksi";
        $institusi_id = $this->session->userdata('idInstitusi');
        $pembukuan_id = $this->session->userdata('tahun_buku');
        $data['pembukuan_id'] = $pembukuan_id;
        $data['pembukuan'] = $this->Tahunbuku_model->ambil_data();
        $data['awal_periode'] = tanggal_indo($this->session->userdata('buku_awal'));
        $data['akhir_periode'] = tanggal_indo($this->session->userdata('buku_akhir'));
        $data['jurnal_id'] = "";
        $data['cmbjurnal'] = array(
            '0' => array('id' => 'KM', 'jurnal' => 'KM'),
            '1' => array('id' => 'KK', 'jurnal' => 'KK'),
            '2' => array('id' => 'BM', 'jurnal' => 'BM'),
            '3' => array('id' => 'BK', 'jurnal' => 'BK'),
            '4' => array('id' => 'NN', 'jurnal' => 'NN'),
            '5' => array('id' => 'PM', 'jurnal' => 'PM')
        );
        //$data['unit'] = $this->Unit_model->ambil_data_institusi_id($institusi_id);
        $this->template->display('akuntansi/laporan/jurnal', $data);
        //$this->template->display('akuntansi/transaksi/kasmasuk');
    }
    public function data()
    {
        $data['kontenmenu'] = "Laporan";
        $data['kontensubmenu'] = "Jurnal Transaksi";
        $data['jurnal'] = "";
        $pembukuan_id = $this->input->post('jt_pembukuan_id');
        $data['pembukuan_id'] = $pembukuan_id;
        $data['pembukuan'] = $this->Tahunbuku_model->ambil_data();
        $data['awal_periode'] = $this->input->post('awal_periode');
        $data['jurnal_id'] = $this->input->post('jurnal');
        $data['akhir_periode'] = $this->input->post('akhir_periode');
        $data['cmbjurnal'] = array(
            '0' => array('id' => 'KM', 'jurnal' => 'KM'),
            '1' => array('id' => 'KK', 'jurnal' => 'KK'),
            '2' => array('id' => 'BM', 'jurnal' => 'BM'),
            '3' => array('id' => 'BK', 'jurnal' => 'BK'),
            '4' => array('id' => 'NN', 'jurnal' => 'NN'),
            '5' => array('id' => 'PM', 'jurnal' => 'PM')
        );
        $this->_validatejurnal();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'awal_error' => form_error('awal_periode'),
                'akhir_error' => form_error('akhir_periode')
            );
        } else {
            $data['jurnal'] = $this->Laporan_model->jurnal();
        }
        $this->template->display('akuntansi/laporan/jurnaldata', $data);
    }
    public function cetakdata()
    {
        $data['judul'] = "Data Jurnal Transaksi";
        $data['bop2'] = null;
        $data['jurnal'] = $this->Laporan_model->jurnalcetak();
        $data['awalperiode'] = $this->input->post('tgl1');
        $data['akhirperiode'] = $this->input->post('tgl2');
        $data['jurnal_id'] = $this->input->post('jurnal_id');
        $data['pembukuan'] = $this->input->post('pembukuan_id');
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "Data Jurnal Transaksi";
        $this->pdf->load_view('akuntansi/laporan/jurnal/cetakdata', $data);
    }
    private function _validatejurnal()
    {
        $this->form_validation->set_rules('awal_periode', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('akhir_periode', 'Tanggal', 'required|trim');
        // $this->form_validation->set_rules('akhir_periode', 'Tanggal', 'required|trim');
        // $this->form_validation->set_rules('awal_periode', 'Tanggal', 'required|trim|callback_cek_tanggal', [
        //     'cek_tanggal' => 'Diluar periode pembukuan!!'
        // ]);
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
