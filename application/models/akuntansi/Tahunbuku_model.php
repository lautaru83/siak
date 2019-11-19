<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tahunbuku_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('akuntansi', TRUE);
    }
    public function ambil_data()
    {
        return $this->db2->get('tahun_pembukuans')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db2->get_where('tahun_pembukuans', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db2->get_where('saldoawals', ['tahun_pembukuan_id' => $id])->num_rows();
    }
    public function cek_id($id) // cek uniq id
    {
        return $this->db2->get_where('tahun_pembukuans', ['id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db2->delete('tahun_pembukuans', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus tahun pembukuan $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $id = $this->input->post('id');
        $awal_periode = tanggal_input($this->input->post('awal_periode'));
        $akhir_periode = tanggal_input($this->input->post('akhir_periode'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $data = array(
            'id' => $id,
            'awal_periode' => $awal_periode,
            'akhir_periode' => $akhir_periode,
            'keterangan' => $keterangan,
            'is_active' => 0
        );
        $this->db2->insert('tahun_pembukuans', $data);
        $log_type = "tambah";
        $log_desc = "tambah tahun pembukuan -" . $id . "-" . $awal_periode . "-" . $akhir_periode . "-";
        userLog($log_type, $log_desc);
    }
    public function tahunaktif($id)
    {
        $this->db2->update('tahun_pembukuans', array('is_active' => 0));
        $data = array(
            'is_active' => 1
        );
        $this->db2->where('id', $id);
        $this->db2->update('tahun_pembukuans', $data);
        $log_type = "aktif";
        $log_desc = "mengaktifkan tahun pembukuan -" . $id . "-";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $awal_periode = tanggal_input($this->input->post('awal_periode'));
        $akhir_periode = tanggal_input($this->input->post('akhir_periode'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $data = array(
            'awal_periode' => $awal_periode,
            'akhir_periode' => $akhir_periode,
            'keterangan' => $keterangan
        );
        $this->db2->where('id', $id);
        $this->db2->update('tahun_pembukuans', $data);
        $log_type = "ubah";
        $log_desc = "ubah tahun pembukuan -" . $awal_periode . "-" . $akhir_periode . "-" . $keterangan . "-";
        userLog($log_type, $log_desc);
    }
}
