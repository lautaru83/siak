<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Bop_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        $institusi_id = $this->session->userdata('idInstitusi');
        //$this->db3->order_by('id', 'DESC');
        return $this->db3->get_where('bops', ['institusi_id' => $institusi_id])->result_array();
    }
    public function ambil_detail_data($id)
    {
        return $this->db3->query("SELECT a.id AS id, b.kode AS kode, b.kewajiban AS kewajiban, a.jumlah AS jumlah, a.bop_id AS bop_id FROM detailbops AS a INNER JOIN kewajibans AS b ON b.id = a.kewajiban_id where a.bop_id=$id order by b.id ASC")->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('bops', ['id' => $id])->row_array();
    }
    public function ambil_detail_id($id)
    {
        return $this->db3->get_where('detailbops', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('detailbops', ['bop_id' => $id])->num_rows();
    }
    public function cek_unikdetail()
    {
        $bop_id = $this->input->post('bop_id');
        $kewajiban_id = $this->input->post('kewajiban_id');
        return $this->db3->query("select * from detailbops where kewajiban_id='$kewajiban_id' and bop_id='$bop_id'")->num_rows();
    }
    public function daftarAkun($kewajiban_id)
    {
        return $this->db3->query("SELECT a.id AS id, a.kewajiban_id AS kewajiban_id, a.a6level_id AS a6level_id, b.level6 AS level6 FROM siak_akademik.akunkewajibans AS a INNER JOIN siak_akuntansi.a6levels AS b ON b.id = a.a6level_id where a.kewajiban_id=$kewajiban_id ORDER BY b.id ASC")->result_array();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('bops', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus Bop - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $institusi_id = $this->session->userdata('idInstitusi');
        $kode = $this->input->post('kode');
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $data = array(
            'kode' => $kode,
            'keterangan' => $keterangan,
            'institusi_id' => $institusi_id
        );
        $this->db3->insert('bops', $data);
        $log_type = "tambah";
        $log_desc = "tambah Bop - $kode - $keterangan - $institusi_id -";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $kode = $this->input->post('kode');
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $data = array(
            'kode' => $kode,
            'keterangan' => $keterangan
        );
        $this->db3->where('id', $id);
        $this->db3->update('bops', $data);
        $log_type = "ubah";
        $log_desc = "ubah Bop - $id - $kode - $keterangan -";
        userLog($log_type, $log_desc);
    }
    public function simpandetail()
    {
        $bop_id = $this->input->post('bop_id');
        $kewajiban_id = $this->input->post('kewajiban_id');
        $jumlah = input_uang($this->input->post('jumlah'));
        $data = array(
            'bop_id' => $bop_id,
            'kewajiban_id' => $kewajiban_id,
            'jumlah' => $jumlah
        );
        $this->db3->insert('detailbops', $data);
        $log_type = "tambah";
        $log_desc = "tambah Detail Bop - $bop_id - $kewajiban_id - $jumlah -";
        userLog($log_type, $log_desc);
    }
    public function ubahdetail($id)
    {
        $kewajiban_id = $this->input->post('kewajiban_id');
        $jumlah = input_uang($this->input->post('jumlah'));
        $data = array(
            'kewajiban_id' => $kewajiban_id,
            'jumlah' => $jumlah
        );
        $this->db3->where('id', $id);
        $this->db3->update('detailbops', $data);
        $log_type = "ubah";
        $log_desc = "ubah detail Bop - $id - $kewajiban_id - $jumlah -";
        userLog($log_type, $log_desc);
    }
    public function hapusdetail($id, $info)
    {
        $this->db3->delete('detailbops', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus Detail Bop - $id - $info";
        userLog($log_type, $log_desc);
    }
}
