<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Komponenbop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akademik/Komponenbop_model' => 'Komponenbop_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model'));
    }
    public function index()
    {
        //echo "Angkatan";
        $data['kontenmenu'] = "Master Pembukuan";
        $data['kontensubmenu'] = "Komponen BOP";
        $data['kewajiban'] = $this->Komponenbop_model->ambil_data();
        $data['akun'] = $this->Kodeperkiraan_model->akun6Institusi();
        $this->template->display('akademik/komponenbop/index', $data);
    }
    public function simpan()
    {
        $this->_komponenvalidate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode_error' => form_error('kode'),
                'komponen_error' => form_error('kewajiban'),
                'jenis_error' => form_error('jenis')
            );
        } else {
            $this->Komponenbop_model->simpan();
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
        $hasil = $this->Komponenbop_model->cek_hapus($id);
        if ($hasil > 0) {
            $data = array(
                'status' => 'gagal'
            );
        } else {
            $this->Komponenbop_model->hapus($id, $info);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ajax_edit($id)
    {
        $hasil = $this->Komponenbop_model->ambil_data_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'kode' => $hasil['kode'],
                'kewajiban' => $hasil['kewajiban'],
                'jenis' => $hasil['jenis']
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
        $this->_komponenvalidate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'kode_error' => form_error('kode'),
                'komponen_error' => form_error('kewajiban'),
                'jenis_error' => form_error('jenis')
            );
        } else {
            $this->Komponenbop_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function simpanakun()
    {
        $this->_akunvalidate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'akun_error' => form_error('a6level_id')
            );
        } else {
            $this->Komponenbop_model->simpanakun();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function hapusakun()
    {
        $id = $this->input->post('id');
        $info = $this->input->post('info');
        $this->Komponenbop_model->hapusakun($id, $info);
        $data = array(
            'status' => 'sukses'
        );
        echo json_encode($data);
    }
    public function cek_unikakun()
    {
        $hasil = $this->Komponenbop_model->cek_unikakun();
        if ($hasil > 0) {
            return false;
        } else {
            return true;
        }
    }
    private function _komponenvalidate()
    {
        $this->form_validation->set_rules('kode', 'Kode', 'required|trim');
        $this->form_validation->set_rules('kewajiban', 'Komponen BOP', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim');
    }
    private function _akunvalidate()
    {
        $this->form_validation->set_rules('a6level_id', 'Akun', 'required|trim|callback_cek_unikakun', [
            'cek_unikakun' => 'Kode perkiraan telah digunakan!'
        ]);
    }
}
