<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tahunakademik_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        return $this->db3->get('tahunakademiks')->result_array();
    }
    public function data_fk()
    {
        return $this->db3->get('tahunakademiks')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('tahunakademiks', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('periodeakademiks', ['tahunakademik_id' => $id])->num_rows();
    }
    public function cek_id($id) // cek uniq id
    {
        return $this->db3->get_where('tahunakademiks', ['id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('tahunakademiks', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus Tahun akademik - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $id = $this->input->post('id');
        // $tahunakademik = $this->input->post('tahunakademik');
        $awal_periode = tanggal_input($this->input->post('awal_periode'));
        $akhir_periode = tanggal_input($this->input->post('akhir_periode'));
        $tahunakademik = htmlspecialchars($this->input->post('tahunakademik'));
        $data = array(
            'id' => $id,
            'tahunakademik' => $tahunakademik,
            'awal_periode' => $awal_periode,
            'akhir_periode' => $akhir_periode,
            'is_active' => 0
        );
        $this->db3->insert('tahunakademiks', $data);
        $log_type = "tambah";
        $log_desc = "tambah Tahun akademik -  $id - $tahunakademik - $awal_periode - $akhir_periode";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $awal_periode = tanggal_input($this->input->post('awal_periode'));
        $akhir_periode = tanggal_input($this->input->post('akhir_periode'));
        $tahunakademik = htmlspecialchars($this->input->post('tahunakademik'));
        $data = array(
            'tahunakademik' => $tahunakademik,
            'awal_periode' => $awal_periode,
            'akhir_periode' => $akhir_periode
        );
        $this->db3->where('id', $id);
        $this->db3->update('tahunakademiks', $data);
        $log_type = "ubah";
        $log_desc = "ubah Tahun akademik -  $tahunakademik - $awal_periode - $akhir_periode";
        userLog($log_type, $log_desc);
    }
}
