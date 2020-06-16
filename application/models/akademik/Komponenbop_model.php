<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Komponenbop_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db3->get_where('kewajibans', ['institusi_id' => $institusi_id])->result_array();
    }
    public function data_fk()
    {
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db3->get_where('kewajibans', ['institusi_id' => $institusi_id])->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('kewajibans', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('akunkewajibans', ['kewajiban_id' => $id])->num_rows();
    }
    public function cek_unikakun()
    {
        $kewajiban_id = $this->input->post('kewajiban_id');
        $a6level_id = $this->input->post('a6level_id');
        return $this->db3->query("select * from akunkewajibans where kewajiban_id=$kewajiban_id and a6level_id='$a6level_id'")->num_rows();
    }
    public function daftarAkun($kewajiban_id)
    {
        return $this->db3->query("SELECT a.id AS id, a.kewajiban_id AS kewajiban_id, a.a6level_id AS a6level_id,a.posisi AS posisi, b.level6 AS level6 FROM siak_akademik.akunkewajibans AS a INNER JOIN siak_akuntansi.a6levels AS b ON b.id = a.a6level_id where a.kewajiban_id=$kewajiban_id ORDER BY b.id ASC")->result_array();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('kewajibans', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus kewajiban - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $institusi_id = $this->session->userdata('idInstitusi');
        $kode = $this->input->post('kode');
        $jenis = $this->input->post('jenis');
        $kewajiban = htmlspecialchars($this->input->post('kewajiban'));
        $data = array(
            'kode' => $kode,
            'kewajiban' => $kewajiban,
            'jenis' => $jenis,
            'institusi_id' => $institusi_id
        );
        $this->db3->insert('kewajibans', $data);
        $log_type = "tambah";
        $log_desc = "tambah kewajiban - $kode - $kewajiban - $jenis - $institusi_id -";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $kode = $this->input->post('kode');
        $jenis = $this->input->post('jenis');
        $kewajiban = htmlspecialchars($this->input->post('kewajiban'));
        $data = array(
            'kode' => $kode,
            'kewajiban' => $kewajiban,
            'jenis' => $jenis
        );
        $this->db3->where('id', $id);
        $this->db3->update('kewajibans', $data);
        $log_type = "ubah";
        $log_desc = "ubah kewajiban - $kode - $kewajiban - $jenis -";
        userLog($log_type, $log_desc);
    }
    public function simpanakun()
    {
        $kewajiban_id = $this->input->post('kewajiban_id');
        $a6level_id = $this->input->post('a6level_id');
        $posisi = $this->input->post('posisi');
        $data = array(
            'kewajiban_id' => $kewajiban_id,
            'a6level_id' => $a6level_id,
            'posisi' => $posisi
        );
        $this->db3->insert('akunkewajibans', $data);
        $log_type = "simpan";
        $log_desc = "tambah akunbop -" . $kewajiban_id . "-" . $a6level_id . "-" . $posisi . "-";
        userLog($log_type, $log_desc);
    }
    public function hapusakun($id, $info)
    {
        $this->db3->delete('akunkewajibans', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus akunbop - $info";
        userLog($log_type, $log_desc);
    }
}
