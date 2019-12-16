<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Transaksi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('akuntansi', TRUE);
    }
    public function ceksaldo($thbuku_id, $a6level_id)
    {
        return $this->db2->get_where('saldoawals', ['tahun_pembukuan_id' => $thbuku_id, 'a6level_id' => $a6level_id])->row_array();
    }
    public function cek_hapus($thbuku_id, $akun_id)
    {
        return $this->db2->get_where('saldoawals', ['tahun_pembukuan_id' => $thbuku_id, 'a6level_id' => $akun_id])->num_rows();
    }
    public function hapus($thbuku_id, $akun_id, $info)
    {
        $this->db2->delete('saldoawals', ['tahun_pembukuan_id' => $thbuku_id, 'a6level_id' => $akun_id]);
        $log_type = "hapus";
        $log_desc = "hapus saldo awal $akun_id - $info - $thbuku_id";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $thbuku_id = $this->input->post('tahun_pembukuan_id');
        $akun_id = $this->input->post('a6level_id');
        $saldo = input_uang($this->input->post('saldoawal'));
        $data = array(
            'tahun_pembukuan_id' => $thbuku_id,
            'a6level_id' => $akun_id,
            'saldoawal' => $saldo,
            'is_valid' => 0
        );
        $this->db2->insert('saldoawals', $data);
        $log_type = "tambah";
        $log_desc = "tambah saldoawal -" . $thbuku_id . "-" . $akun_id . "-" . $saldo . "-";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $thbuku_id = $this->input->post('tahun_pembukuan_id');
        $a6level_id = $this->input->post('a6level_id');
        $saldo = input_uang($this->input->post('saldoawal'));
        $data = array(
            'tahun_pembukuan_id' => $thbuku_id,
            'a6level_id' => $a6level_id,
            'saldoawal' => $saldo,
            'is_valid' => 0
        );
        $this->db2->where('id', $id);
        $this->db2->update('saldoawals', $data);
        $log_type = "ubah";
        $log_desc = "ubah saldoawal -" . $thbuku_id . "-" . $a6level_id . "-" . $saldo . "-";
        userLog($log_type, $log_desc);
    }
}
