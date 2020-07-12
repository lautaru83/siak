<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rapb extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        $this->load->model(array('akuntansi/Rapb_model' => 'Rapb_model', 'akuntansi/Akunanggaran_model' => 'Akunanggaran_model', 'akuntansi/Tahunanggaran_model' => 'Tahunanggaran_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Pengaturan";
        $data['kontensubmenu'] = "RAPB";
        $data['tahunanggaran'] = $this->Tahunanggaran_model->ambil_data();
        $this->template->display('akuntansi/rapb/index', $data);
    }
    public function data($id)
    {
        $data['tahunanggaran'] = $this->Tahunanggaran_model->ambil_data_id($id);
        $data['tran_id'] = $id;
        $data['kontenmenu'] = "Pengaturan";
        $data['kontensubmenu'] = "RAPB";
        $data['kelompok'] = $this->Akunanggaran_model->kelompok_data();
        $this->template->display('akuntansi/rapb/data', $data);
    }
    public function cetakdata($id)
    {
        $hasil = $this->Tahunanggaran_model->ambil_data_id($id);
        $tahunanggaran = $hasil['tahunanggaran'];
        $data['judul'] = "Data RAPB $tahunanggaran";
        $data['tahunanggaran'] = $tahunanggaran;
        $data['idTahun'] = $id;
        $data['kelompok'] = $this->Akunanggaran_model->kelompok_data();
        //$data['kodeperkiraan'] = $this->Kodeperkiraan_model->akun_saldo();
        $this->load->library('pdf');
        $this->pdf->setPaper('legal', 'portrait');
        $this->pdf->filename = "Data RAPB $tahunanggaran";
        $this->pdf->load_view('akuntansi/rapb/cetakdata', $data);
    }
    public function anggarandata()
    {
        $id = $this->input->post('kelompok_id');
        if ($id) {
            echo $this->Akunanggaran_model->rencanasubakun($id);
        }
    }
    public function anggarandataedit()
    {
        $id = $this->input->post('kelompok_id');
        //$id = 1;
        if ($id) {
            echo $this->Akunanggaran_model->rencanasubakunedit($id);
        }
        // echo json_encode($data);
    }
    private function _validate()
    {
        // if (!$this->input->post('idubah')) {
        //     $this->form_validation->set_rules('id', 'Kode', 'required|trim|exact_length[2]|callback_cek_unik', [
        //         'cek_unik' => 'Kode telah digunakan oleh data lain !'
        //     ]);
        // }
        $this->form_validation->set_rules('rencana', 'Rencana', 'required|trim');
        $this->form_validation->set_rules('kelompok_id', 'Jenis Anggaran', 'required|trim');
        $this->form_validation->set_rules('anggaran_id', 'Jenis Kegiatan', 'required|trim');
        $this->form_validation->set_rules('resaldo', 'Besar Anggaran', 'required|trim');
        $this->form_validation->set_rules('terealisasi', 'Besar Anggaran', 'trim');
        $this->form_validation->set_rules('noref', 'No. Referensi', 'trim');
        // $this->form_validation->set_rules('resaldo', 'Besar Anggaran', 'required|trim');
    }
    // public function ubahakun()
    // {
    //     $jenis_transaksi_id = $this->input->post('jenis_transaksi_id');
    //     $a6level_id = $this->input->post('a6level_id');
    //     $data = [
    //         "jenis_transaksi_id" => $jenis_transaksi_id,
    //         "a6level_id" => $a6level_id
    //     ];
    //     $hasil = $this->Jenistransaksi_model->cek_akun($data);
    //     if ($hasil) {
    //         $this->Jenistransaksi_model->hapusakun($data);
    //     } else {
    //         $this->Jenistransaksi_model->simpanakun($data);
    //     }
    // }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'rencana_error' => form_error('rencana'),
                'kelompok_error' => form_error('kelompok_id'),
                'anggaran_error' => form_error('anggaran_id'),
                'resaldo_error' => form_error('resaldo')
            );
        } else {
            $this->Rapb_model->simpan();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function hapus()
    {
        $id = $this->input->post('id');
        $info = $this->input->post('info');
        $hasil = $this->Rapb_model->hapus($id, $info);
        if ($hasil) {
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
    public function ajax_edit()
    {
        // $kelompok_id = $idkel;
        $id = $this->input->post('id');
        $kelompok_id = $this->input->post('kelompok_id');
        $hasil = $this->Rapb_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'kelompok_id' => $kelompok_id,
                'rencana' => $hasil['rencana'],
                'tahunanggaran_id' => $hasil['tahunanggaran_id'],
                'resaldo' => rupiah($hasil['resaldo']),
                'terealisasi' => rupiah($hasil['terealisasi']),
                'anggaran_id' => $hasil['anggaran_id'],
                'noref' => $hasil['noref']
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    // public function ajax_edit2($id, $kel)
    // {
    //     $rencana_id = $id;
    //     $hasil = $this->Rapb_model->ambil_data_id($rencana_id);
    // }
    public function ubah()
    {
        $id = $this->input->post('idubah');
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'rencana_error' => form_error('rencana'),
                'kelompok_error' => form_error('kelompok_id'),
                'anggaran_error' => form_error('anggaran_id'),
                'resaldo_error' => form_error('resaldo')
            );
        } else {
            $this->Rapb_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    // public function cek_unik()
    // {
    //     $id = $this->input->post('id');
    //     $hasil = $this->Jenistransaksi_model->cek_id($id);
    //     if ($hasil > 0) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }
    // private function _validate()
    // {
    //     if (!$this->input->post('idubah')) {
    //         $this->form_validation->set_rules('id', 'Kode', 'required|trim|exact_length[2]|callback_cek_unik', [
    //             'cek_unik' => 'Kode telah digunakan oleh data lain !'
    //         ]);
    //     }
    //     $this->form_validation->set_rules('jenis_transaksi', 'Jenis Transaksi', 'required|trim');
    // }
}
