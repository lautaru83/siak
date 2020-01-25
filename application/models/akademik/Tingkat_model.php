<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tingkat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        return $this->db3->get('tingkats')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('angkatans', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db2->get_where('akun_transaksis', ['jenis_transaksi_id' => $id])->num_rows();
    }
    public function cek_id($id) // cek uniq id
    {
        return $this->db2->get_where('jenis_transaksis', ['id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db2->delete('jenis_transaksis', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus jenis transaksi - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $id = $this->input->post('id');
        $jenis_transaksi = htmlspecialchars($this->input->post('jenis_transaksi'));
        $data = array(
            'id' => $id,
            'jenis_transaksi' => $jenis_transaksi
        );
        $this->db2->insert('jenis_transaksis', $data);
        $log_type = "tambah";
        $log_desc = "tambah jenis transaksi -" . $id . "-" . $jenis_transaksi . "-";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $jenis_transaksi = $this->input->post('jenis_transaksi');
        $data = array(
            'jenis_transaksi' => $jenis_transaksi
        );
        $this->db2->where('id', $id);
        $this->db2->update('jenis_transaksis', $data);
        $log_type = "ubah";
        $log_desc = "ubah jenis transaksi -" . $jenis_transaksi . "-";
        userLog($log_type, $log_desc);
    }
    // public function simpanakun($data = array())
    // {
    //     $tran_id = $this->input->post('jenis_transaksi_id');
    //     $level6_id = $this->input->post('a6level_id');
    //     $this->db2->insert('akun_transaksis', $data);
    //     $log_type = "simpan";
    //     $log_desc = "simpan akun transaksi -" . $tran_id . "-" . $level6_id . "-";
    //     userLog($log_type, $log_desc);
    // }
    // public function hapusakun($data = array())
    // {
    //     $tran_id = $this->input->post('jenis_transaksi_id');
    //     $level6_id = $this->input->post('a6level_id');
    //     $this->db2->delete('akun_transaksis', $data);
    //     $log_type = "hapus";
    //     $log_desc = "hapus akun transaksi -" . $tran_id . "-" . $level6_id . "-";
    //     userLog($log_type, $log_desc);
    // }
    public function cek_akun($data = array())
    {
        return $this->db2->get_where('akun_transaksis', $data)->row_array();
    }
}
