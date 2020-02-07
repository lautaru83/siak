<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rapb_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('akuntansi', TRUE);
    }
    public function rapbdata_kelompok_id($id, $th)
    {
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.id AS id, a.rencana AS rencana, a.anggaran_id AS anggaran_id, a.tahunanggaran_id AS tahunanggaran_id, a.resaldo AS resaldo, a.terealisasi AS terealisasi,b.kelompok_id as kelompok_id, a.noref AS noref FROM rencanas AS a INNER JOIN anggarans AS b ON b.id = a.anggaran_id WHERE b.kelompok_id = $id AND a.tahunanggaran_id='$th' AND b.institusi_id = '$institusi_id' order by a.id,b.id ASC ")->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db2->get_where('rencanas', ['id' => $id])->row_array();
    }
    public function hapus($id, $info)
    {
        $this->db2->delete('rencanas', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus RAPB - $info";
        userLog($log_type, $log_desc);
        return "OK";
    }
    public function simpan()
    {
        $anggaran_id = $this->input->post('anggaran_id');
        $tahunanggaran_id = $this->input->post('tahunanggaran_id');
        $resaldo = input_uang($this->input->post('resaldo'));
        $terealisasi = input_uang($this->input->post('terealisasi'));
        $noref = htmlspecialchars($this->input->post('noref'));
        $rencana = htmlspecialchars($this->input->post('rencana'));
        $data = array(
            'rencana' => $rencana,
            'anggaran_id' => $anggaran_id,
            'tahunanggaran_id' => $tahunanggaran_id,
            'resaldo' => $resaldo,
            'terealisasi' => $terealisasi,
            'noref' => $noref
        );
        $this->db2->insert('rencanas', $data);
        $log_type = "tambah";
        $log_desc = "tambah RAPB - $rencana - $anggaran_id - $tahunanggaran_id - $resaldo - $terealisasi - $noref - ";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $anggaran_id = $this->input->post('anggaran_id');
        $tahunanggaran_id = $this->input->post('tahunanggaran_id');
        $resaldo = input_uang($this->input->post('resaldo'));
        $terealisasi = input_uang($this->input->post('terealisasi'));
        $noref = htmlspecialchars($this->input->post('noref'));
        $rencana = htmlspecialchars($this->input->post('rencana'));
        $data = array(
            'rencana' => $rencana,
            'anggaran_id' => $anggaran_id,
            'tahunanggaran_id' => $tahunanggaran_id,
            'resaldo' => $resaldo,
            'terealisasi' => $terealisasi,
            'noref' => $noref
        );
        $this->db2->where('id', $id);
        $this->db2->update('rencanas', $data);
        $log_type = "ubah";
        $log_desc = "ubah RAPB - $id- $rencana - $anggaran_id - $tahunanggaran_id - $resaldo - $terealisasi - $noref -";
        userLog($log_type, $log_desc);
    }
}
