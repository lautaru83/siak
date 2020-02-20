<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akademik/Komponenbop_model' => 'Komponenbop_model', 'akademik/Bop_model' => 'Bop_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Pengaturan";
        $data['kontensubmenu'] = "BOP";
        $data['bop'] = $this->Bop_model->ambil_data();
        //$data['akun'] = $this->Kodeperkiraan_model->akun6Institusi();
        $this->template->display('akademik/bop/index', $data);
    }
    public function data($id)
    {
        $data['kontenmenu'] = "Pengaturan";
        $data['kontensubmenu'] = "Detail BOP";
        $data['bop'] = $this->Bop_model->ambil_data_id($id);
        $data['detail'] = $this->Bop_model->ambil_detail_data($id);
        $data['komponen'] = $this->Komponenbop_model->data_fk();
        $this->template->display('akademik/bop/data', $data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode_error' => form_error('kode'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Bop_model->simpan();
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
        $hasil = $this->Bop_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Bop_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Bop_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'kode' => $hasil['kode'],
                'keterangan' => $hasil['keterangan']
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function ubah()
    {
        $id = $this->input->post('idubah');
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode_error' => form_error('kode'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Bop_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function simpandetail()
    {
        $this->_detailvalidate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'komponen_error' => form_error('kewajiban_id'),
                'jumlah_error' => form_error('jumlah')
            );
        } else {
            $this->Bop_model->simpandetail();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function edit_detail($id)
    {
        $hasil = $this->Bop_model->ambil_detail_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'kewajiban_id' => $hasil['kewajiban_id'],
                'jumlah' => $hasil['jumlah']
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function ubahdetail()
    {
        $id = $this->input->post('idubah');
        $this->_detailvalidate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'komponen_error' => form_error('kewajiban_id'),
                'jumlah_error' => form_error('jumlah')
            );
        } else {
            $this->Bop_model->ubahdetail($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function hapusdetail()
    {
        $id = $this->input->post('id');
        $info = $this->input->post('info');
        $this->Bop_model->hapusdetail($id, $info);
        $data = array(
            'status' => 'sukses'
        );
        echo json_encode($data);
    }
    public function cek_unik()
    {
        $hasil = $this->Bop_model->cek_unikdetail();
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    public function cek_jumlah()
    {
        $jumlah = $this->input->post('jumlah');
        //$hasil = $this->Transaksi_model->cek_id($id);
        if ($jumlah < 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _validate()
    {
        $this->form_validation->set_rules('kode', 'Kode', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Jenis', 'required|trim');
    }
    private function _detailvalidate()
    {
        if (!$this->input->post('idubah')) {
            $this->form_validation->set_rules('kewajiban_id', 'Komponen BOP', 'required|trim|callback_cek_unik', [
                'cek_unik' => 'Data Komponen sudah ada!!'
            ]);
        } else {
            $this->form_validation->set_rules('kewajiban_id', 'Komponen', 'required|trim');
        }
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required|trim|callback_cek_jumlah', [
            'cek_jumlah' => 'Jumlah tidak valid!!'
        ]);
    }
    // private function _akunvalidate()
    // {
    //     $this->form_validation->set_rules('a6level_id', 'Akun', 'required|trim|callback_cek_unikakun', [
    //         'cek_unikakun' => 'Kode perkiraan telah digunakan!'
    //     ]);
    // }
}
