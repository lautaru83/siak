<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenistransaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        $this->load->model(array('akuntansi/Jenistransaksi_model' => 'Jenistransaksi_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Master Pembukuan";
        $data['kontensubmenu'] = "Jenis Transaksi";
        $data['jenistransaksi'] = $this->Jenistransaksi_model->ambil_data();
        $this->template->display('akuntansi/jenistransaksi/index', $data);
    }
    public function data()
    {
        $data['kontenmenu'] = "Master Pembukuan";
        $data['kontensubmenu'] = "Data Akun Transaksi";
        $data['jenistransaksi'] = $this->Jenistransaksi_model->ambil_data();
        $this->template->display('akuntansi/jenistransaksi/data', $data);
    }
    public function akun($id)
    {
        $data['transaksi'] = $this->Jenistransaksi_model->ambil_data_id($id);
        $data['tran_id'] = $id;
        $data['kontenmenu'] = "Master Pembukuan";
        $data['kontensubmenu'] = "Akun Transaksi";
        $data['kodeperkiraan'] = $this->Kodeperkiraan_model->ambil_data();
        //$data['institusi'] = $this->Institusi_model->data_institusi();
        $this->template->display('akuntansi/jenistransaksi/akun', $data);
    }
    public function ubahakun()
    {
        $jenis_transaksi_id = $this->input->post('jenis_transaksi_id');
        $a6level_id = $this->input->post('a6level_id');
        $data = [
            "jenis_transaksi_id" => $jenis_transaksi_id,
            "a6level_id" => $a6level_id
        ];
        $hasil = $this->Jenistransaksi_model->cek_akun($data);
        if ($hasil) {
            $this->Jenistransaksi_model->hapusakun($data);
        } else {
            $this->Jenistransaksi_model->simpanakun($data);
        }
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode_error' => form_error('id'),
                'jenis_transaksi_error' => form_error('jenis_transaksi')
            );
        } else {
            $this->Jenistransaksi_model->simpan();
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
        $hasil = $this->Jenistransaksi_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Jenistransaksi_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Jenistransaksi_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'jenis_transaksi' => $hasil['jenis_transaksi']
            );
        } else {
            $data = array(
                'status' => 'gagal'
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
                'kode_error' => form_error('id'),
                'jenis_transaksi_error' => form_error('jenis_transaksi'),
            );
        } else {
            $this->Jenistransaksi_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function cek_unik()
    {
        $id = $this->input->post('id');
        $hasil = $this->Jenistransaksi_model->cek_id($id);
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _validate()
    {
        if (!$this->input->post('idubah')) {
            $this->form_validation->set_rules('id', 'Kode', 'required|trim|exact_length[2]|callback_cek_unik', [
                'cek_unik' => 'Kode telah digunakan oleh data lain !'
            ]);
        }
        $this->form_validation->set_rules('jenis_transaksi', 'Jenis Transaksi', 'required|trim');
    }
}
