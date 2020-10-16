<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        $this->db3 = $this->load->database('akademik', TRUE);
        //$this->load->model('akuntansi/Tahunbuku_model', 'Tahunbuku_model');
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Transaksi_model' => 'Transaksi_model', 'akuntansi/Laporan_model' => 'Laporan_model', 'akademik/Periodeakademik_model' => 'Periodeakademik_model', 'akademik/Kelas_model' => 'Kelas_model', 'akademik/Kelasaktif_model' => 'Kelasaktif_model'));
        // $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'akuntansi/Saldoawal_model' => 'Saldoawal_model', 'akuntansi/Tahunbuku_model' => 'Tahunbuku_model', 'akuntansi/Transaksi_model' => 'Transaksi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'Unit_model' => 'Unit_model', 'akuntansi/Laporan_model' => 'Laporan_model', 'akuntansi/Tahunanggaran_model' => 'Tahunanggaran_model', 'akuntansi/Akunanggaran_model' => 'Akunanggaran_model'));
        $this->idinstitusi = $this->session->userdata('idInstitusi');
    }
    public function index()
    {
        $data['kontenmenu'] = "Laporan";
        $data['kontensubmenu'] = "Pembayaran Mahasiswa";
        // $pembukuan_id = $this->session->userdata('tahun_buku');
        $perak_id = $this->session->userdata('idPerak');
        $data['institusi_id'] = $this->idinstitusi;
        // $data['pembukuan_id'] = $pembukuan_id;
        $data['perak_id'] = $perak_id;

        $data['perak'] = $this->Periodeakademik_model->ambil_data();
        $data['buku_awal'] = tanggal_indo($this->session->userdata('semester_awal'));
        $data['buku_akhir'] = tanggal_indo($this->session->userdata('semester_akhir'));
        $data['pembayaran'] = null;
        $this->_validate();
        if ($this->form_validation->run() == false) {
            //$data['pembayaran'] = null;
            $data['lapkelas'] = null;
        } else {
            $data['lapkelas'] = 1;
            $data['institusi'] = $this->Institusi_model->ambil_data_id($this->idinstitusi);
            $kelas_id = $this->input->post('kelas_id');
            $perak_id = $this->input->post('akd_pembukuan_id');
            $data['periode'] = $this->Periodeakademik_model->ambil_data_id($perak_id);
            $data['detail'] = $this->Kelas_model->detail_kelas_by_id($kelas_id);
            $data['rekap'] = $this->Laporan_model->daftarRekapKelas();
            $this->Kelasaktif_model->comboKelasAktif($perak_id);
        }
        $data['kelas'] = $this->Kelasaktif_model->detailkelas_by_perakId($perak_id);
        $this->template->display('akuntansi/laporan/pembayaran', $data);
    }
    public function kelasdata()
    {
        $perak_id = $this->input->post('perak_id');
        if ($perak_id) {
            echo $this->Kelasaktif_model->comboKelasAktif($perak_id);
        }
    }
    public function viewdata()
    {
        $kelas_id = $this->input->post('kelas_id');
        $perak_id = $this->input->post('perak_id');
        // $data['tanggal'] = tanggal_input($this->input->post('akhir_periode'));
        $data['akhirbuku'] = tanggal_input($this->input->post('akhirbuku'));
        $data['awalbuku'] = tanggal_input($this->input->post('awalbuku'));
        // $data['tahunanggaran_id'] = $this->input->post('idTahan');
        $jenislap = $this->input->post('jenislap');
        $data['pembayaran'] = "1";
        // $data['jenislap'] = $jenis;
        $institusi_id = $this->session->userdata('idInstitusi');
        $data['institusi'] = $this->Institusi_model->ambil_data_id($institusi_id);
        //$data['kelompok'] = $this->Akunanggaran_model->kelompok_data();
        $data['periode'] = $this->Periodeakademik_model->ambil_data_id($perak_id);
        $data['detail'] = $this->Kelas_model->detail_kelas_by_id($kelas_id);
        if ($jenislap == 1) {
            if ($institusi_id == "01") {
                $data['rekap'] = $this->Laporan_model->daftarRekapKelas();
                $this->load->view('akuntansi/laporan/pembayaran/kelasinstitusi', $data);
            } else {
                $data['rekap'] = $this->Laporan_model->daftarRekapKelas();
                $this->load->view('akuntansi/laporan/pembayaran/kelasunit', $data);
            }
        }
    }
    public function cekinput()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $response = array(
                'status' => 'gagal',
                // 'tanggal_error' => form_error('akhir_periode'),
                'kelas_error' => form_error('kelas_id'),
                'perak_error' => form_error('perak_id')
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
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('akd_pembukuan_id', 'Periode', 'required|trim');
        // $this->form_validation->set_rules('akhir_periode', 'Tanggal', 'required|trim|callback_cek_tanggal', [
        //     'cek_tanggal' => 'Diluar periode pembukuan!!'
        // ]);
    }
}
