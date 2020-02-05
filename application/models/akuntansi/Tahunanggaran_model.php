<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tahunanggaran_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('akuntansi', TRUE);
    }
    public function ambil_data()
    {
        return $this->db2->get('tahunanggarans')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db2->get_where('tahunanggarans', ['id' => $id])->row_array();
    }
    public function ambil_anggaran_aktif()
    {
        return $this->db2->get_where('tahunanggarans', ['is_active' => 1])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db2->get_where('saldoanggarans', ['tahunanggaran_id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db2->delete('tahunanggarans', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus tahun anggaran $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $tahunanggaran = $this->input->post('tahunanggaran');
        $awal_periode = tanggal_input($this->input->post('awal_periode'));
        $akhir_periode = tanggal_input($this->input->post('akhir_periode'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $data = array(
            'tahunanggaran' => $tahunanggaran,
            'awal_periode' => $awal_periode,
            'akhir_periode' => $akhir_periode,
            'keterangan' => $keterangan,
            'is_active' => 0
        );
        $this->db2->insert('tahunanggarans', $data);
        $log_type = "tambah";
        $log_desc = "tambah tahun anggaran -" . $tahunanggaran . "-" . $awal_periode . "-" . $akhir_periode . "-";
        userLog($log_type, $log_desc);
    }
    public function tahunaktif($id, $info)
    {
        $this->db2->update('tahunanggarans', array('is_active' => 0));
        $data = array(
            'is_active' => 1
        );
        $this->db2->where('id', $id);
        $this->db2->update('tahunanggarans', $data);
        $log_type = "aktif";
        $log_desc = "mengaktifkan tahun anggaran -" . $info . "-";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $tahunanggaran = $this->input->post('tahunanggaran');
        $awal_periode = tanggal_input($this->input->post('awal_periode'));
        $akhir_periode = tanggal_input($this->input->post('akhir_periode'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $data = array(
            'tahunanggaran' => $tahunanggaran,
            'awal_periode' => $awal_periode,
            'akhir_periode' => $akhir_periode,
            'keterangan' => $keterangan
        );
        $this->db2->where('id', $id);
        $this->db2->update('tahunanggarans', $data);
        $log_type = "ubah";
        $log_desc = "ubah tahun anggaran -" . $tahunanggaran . "-" . $awal_periode . "-" . $akhir_periode . "-" . $keterangan . "-";
        userLog($log_type, $log_desc);
    }
}
