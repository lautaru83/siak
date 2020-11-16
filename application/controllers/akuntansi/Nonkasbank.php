<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nonkasbank extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        //$this->load->model('akuntansi/Tahunbuku_model', 'Tahunbuku_model');
        $this->load->model(array('Institusi_model' => 'Institusi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'akuntansi/Saldoawal_model' => 'Saldoawal_model', 'akuntansi/Transaksi_model' => 'Transaksi_model', 'Unit_model' => 'Unit_model'));
    }
    public function index()
    {
        $institusi_id = $this->session->userdata('idInstitusi');
        $data['pembukuan_id'] = $this->session->userdata('tahun_buku');
        $data['kontenmenu'] = "Transaksi";
        $jrnl = "NN";
        $data['jurnal'] = $jrnl;
        $data['kontensubmenu'] = "Jurnal Umum (Non Kas)";
        $data['unit'] = $this->Unit_model->ambil_data_institusi_id($institusi_id);
        $hasil = $this->Transaksi_model->cektranuser($jrnl);
        $data['totaltransaksi'] = "";
        $data['detail'] = "";
        //$idtransaksi = "";
        if ($hasil) {
            $idtransaksi = $hasil['id'];
            $data['status'] = "1";
            $data['tran_id'] = $idtransaksi;
            $data['noref'] = $hasil['noref'];
            $data['keterangan'] = $hasil['keterangan'];
            $data['nobukti'] = $hasil['nobukti'];
            $data['unit_id'] = $hasil['unit_id'];
            $data['notran'] = $hasil['notran'];
            $data['tanggal_transaksi'] = tanggal_indo($hasil['tanggal_transaksi']);
            $data['totaltransaksi'] = $this->Transaksi_model->cektotaltransaksi($idtransaksi);
            $data['detail'] = $this->Transaksi_model->detailtransaksi($idtransaksi);
        } else {
            $data['status'] = "0";
            $data['tran_id'] = "";
            $data['nobukti'] = "";
            $data['noref'] = "";
            $data['unit_id'] = "";
            $data['transaksi_id'] = "";
            $data['keterangan'] = "";
            $data['notran'] = no_tran($jrnl);
            $data['tanggal_transaksi'] = date("d/m/Y");
        }
        $data['akun'] = $this->Kodeperkiraan_model->akunjurnal($jrnl);
        $data['riwayat'] = $this->Transaksi_model->riwayat_transaksi($jrnl);
        $this->template->display('akuntansi/nonkasbank/index', $data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'nobukti_error' => form_error('nobukti'),
                'keterangan_error' => form_error('keterangan'),
                'unit_error' => form_error('unit_id'),
                'tanggal_error' => form_error('tanggal_transaksi')
            );
        } else {
            $this->Transaksi_model->simpan();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ubah($id)
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'nobukti_error' => form_error('nobukti'),
                'keterangan_error' => form_error('keterangan'),
                'unit_error' => form_error('unit_id'),
                'tanggal_error' => form_error('tanggal_transaksi')
            );
        } else {
            $this->Transaksi_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function selesaitransaksi()
    {
        //$tran_id = $this->input->post('transaksi_id');
        $hasil = $this->Transaksi_model->selesaitransaksi();
        if (!$hasil) {
            $data = array(
                'status' => 'sukses'
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function simpandetail()
    {
        $this->_validatedetail();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'akun_error' => form_error('a6level_id'),
                'posisi_error' => form_error('posisi_akun'),
                'jumlah_error' => form_error('jumlah')
            );
        } else {
            $this->Transaksi_model->simpandetail();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ubahdetail($id)
    {
        $this->_validatedetail();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'akun_error' => form_error('a6level_id'),
                'posisi_error' => form_error('posisi_akun'),
                'jumlah_error' => form_error('jumlah')
            );
        } else {
            //$idtransaksi = $this->input->post('transaksi_id');
            $this->Transaksi_model->ubahdetail($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function hapusrincian()
    {
        $id = $this->input->post('id');
        //$info = $this->input->post('info');
        $this->Transaksi_model->hapusdetailtransaksi($id);
        $data = array(
            'status' => 'sukses'
        );
        echo json_encode($data);
    }
    public function ajax_editrincian($id)
    {
        $hasil = $this->Transaksi_model->detailtransaksi_by_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'a6level_id' => $hasil['a6level_id'],
                'posisi_akun' => $hasil['posisi_akun'],
                'anggaran' => $hasil['is_anggaran'],
                'jumlah' => rupiah($hasil['jumlah'])
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function cek_jumlah()
    {
        $jumlah = $this->input->post('jumlah');
        //$hasil = $this->Transaksi_model->cek_id($id);
        if ($jumlah <= 0) {
            return false;
        } else {
            return true;
        }
    }
    public function cek_uniknobukti()
    {
        $nobukti = $this->input->post('nobukti');
        $hasil = $this->Transaksi_model->cek_nobukti($nobukti);
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    public function cek_akun()
    {
        $a6level_id = $this->input->post('a6level_id');
        $tran_id = $this->input->post('transaksi_id');
        $idakun = $this->input->post('idakun');
        $idubah = $this->input->post('idubah');
        if ($idubah == "") {
            $hasil = $this->Transaksi_model->cek_akunubah($a6level_id, $tran_id);
            if ($hasil) {
                return false;
            } else {
                return true;
            }
        } elseif ($idakun == $a6level_id) {
            return true;
        } else {
            $hasil = $this->Transaksi_model->cek_akunubah($a6level_id, $tran_id);
            if ($hasil) {
                return false;
            } else {
                return true;
            }
        }
    }
    public function cek_saldo()
    {
        $jumlah = 0;
        $jumlah = input_uang($this->input->post('jumlah'));
        $akun_id = $this->input->post('a6level_id');
        $posisiakun = $this->Kodeperkiraan_model->cek_posisiakun($akun_id);
        $posakun = $posisiakun['posisi'];
        $postran = $this->input->post('posisi_akun');
        $hasil = $this->Transaksi_model->ceksaldotransaksi($akun_id);
        $saldo = 0;
        if ($hasil) {
            foreach ($hasil as $dataHasil) :
                $posisi = $dataHasil['posisi'];
                $debet = $dataHasil['debet'];
                $kredit = $dataHasil['kredit'];
                if ($posisi == "D") {
                    $sal = $debet - $kredit;
                } else {
                    $sal = $kredit - $debet;
                }
            endforeach;
            $saldo = input_uang($sal);
        } else {
            $saldo = 0;
        }
        if ($posakun == "D") {
            if ($postran == "D") {
                return true;
            } else {
                if ($jumlah > $saldo) {
                    return false;
                } else {
                    return true;
                }
            }
        } else {
            if ($postran == "K") {
                return true;
            } else {
                if ($jumlah > $saldo) {
                    return false;
                } else {
                    return true;
                }
            }
        }
    }
    public function cek_tanggal()
    {
        $tanggal = tanggal_input($this->input->post('tanggal_transaksi'));
        $awal_periode = $this->session->userdata['buku_awal'];
        $akhir_periode = $this->session->userdata['buku_akhir'];
        if ($tanggal < $awal_periode) {
            return false;
        } elseif ($tanggal > $akhir_periode) {
            return false;
        } else {
            return true;
        }
    }
    private function _validate()
    {
        $this->form_validation->set_rules('nobukti', 'nobukti', 'required|trim|callback_cek_uniknobukti', [
            'cek_uniknobukti' => 'No Bukti telah digunakan!!'
        ]);
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal', 'required|trim|callback_cek_tanggal', [
            'cek_tanggal' => 'Diluar periode pembukuan!!'
        ]);
        $this->form_validation->set_rules('keterangan', 'uraian', 'required|trim');
        $this->form_validation->set_rules('unit_id', 'Unit Usaha', 'required|trim');
    }
    private function _validatedetail()
    {
        $this->form_validation->set_rules('a6level_id', 'Kodeperkiraan', 'required|trim|callback_cek_akun', [
            'cek_akun' => 'Akun telah digunakan sebelumnya!!'
        ]);
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim|callback_cek_jumlah', [
            'cek_jumlah' => 'Jumlah transaksi tidak valid!!'
        ]);
        $this->form_validation->set_rules('posisi_akun', 'Posisi', 'required|trim');
    }
}
