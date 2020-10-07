<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        //$this->load->model('akuntansi/Tahunbuku_model', 'Tahunbuku_model');
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'akuntansi/Tahunbuku_model' => 'Tahunbuku_model', 'akuntansi/Tahunanggaran_model' => 'Tahunanggaran_model', 'akuntansi/Saldoawal_model' => 'Saldoawal_model', 'akuntansi/Transaksi_model' => 'Transaksi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'Unit_model' => 'Unit_model', 'akuntansi/Laporan_model' => 'Laporan_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Laporan";
        $data['kontensubmenu'] = "Jurnal Transaksi";
        $institusi_id = $this->session->userdata('idInstitusi');
        $pembukuan_id = $this->session->userdata('tahun_buku');
        $data['pembukuan_id'] = $this->session->userdata('tahun_buku');

        $data['awal_periode'] = tanggal_indo($this->session->userdata('buku_awal'));
        $data['akhir_periode'] = tanggal_indo($this->session->userdata('buku_akhir'));
        $data['jurnal'] = "";
        //$data['unit'] = $this->Unit_model->ambil_data_institusi_id($institusi_id);
        $this->template->display('akuntansi/laporan/jurnal', $data);
        //$this->template->display('akuntansi/transaksi/kasmasuk');
    }
    public function ajaxcombobuku($id)
    {
        $hasil = $this->Tahunbuku_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'awal_periode' => tanggal_indo($hasil['awal_periode']),
                'akhir_periode' => tanggal_indo($hasil['akhir_periode']),
                'keterangan' => $hasil['keterangan']
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function ajaxcomboanggaran($id)
    {
        $hasil = $this->Tahunanggaran_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'awal_periode' => tanggal_indo($hasil['awal_periode']),
                'akhir_periode' => tanggal_indo($hasil['akhir_periode']),
                'keterangan' => $hasil['keterangan']
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function jurnal()
    {
        $data['kontenmenu'] = "Laporan";
        $data['kontensubmenu'] = "Jurnal Transaksi";
        $data['jurnal'] = "";
        $data['awal_periode'] = $this->input->post('awalperiode');
        $data['akhir_periode'] = $this->input->post('akhir_periode');
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
        $this->template->display('akuntansi/laporan/datajurnal', $data);
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
