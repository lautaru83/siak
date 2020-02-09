<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kelasaktif_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        return $this->db3->query("")->result_array();
    }
    public function data_fk()
    {
        return $this->db3->get('detailkelases')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('detailkelases', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('detailkelases', ['perak_id' => $id])->num_rows();
    }
    public function ambil_akademik_aktif()
    {
        return $this->db3->query("SELECT a.id AS tahunakademik_id, a.awal_periode AS awal_periode, a.akhir_periode AS akhir_periode, a.tahunakademik AS tahunakademik,b.id AS periodeakademik_id,b.awal_semester AS awal_semester, b.akhir_semester AS akhir_semester, b.keterangan AS periodeakademik FROM tahunakademiks AS a INNER JOIN detailkelases AS b ON a.id = b.tahunakademik_id WHERE b.is_active = 1")->row_array();
    }
    public function cek_id($id) // cek uniq id
    {
        return $this->db3->get_where('detailkelases', ['id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('detailkelases', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus Tahun akademik - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $id = $this->input->post('id');
        $tahunakademik_id = $this->input->post('tahunakademik_id');
        $semester_id = $this->input->post('semester_id');
        $awal_periode = tanggal_input($this->input->post('awal_periode'));
        $akhir_periode = tanggal_input($this->input->post('akhir_periode'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $data = array(
            'id' => $id,
            'tahunakademik_id' => $tahunakademik_id,
            'semester_id' => $semester_id,
            'keterangan' => $keterangan,
            'awal_semester' => $awal_periode,
            'akhir_semester' => $akhir_periode,
            'is_active' => 0
        );
        $this->db3->insert('detailkelases', $data);
        $log_type = "tambah";
        $log_desc = "tambah periode akademik -  $id - $tahunakademik_id - $semester_id - $keterangan - $awal_periode - $akhir_periode";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $tahunakademik_id = $this->input->post('tahunakademik_id');
        $semester_id = $this->input->post('semester_id');
        $awal_periode = tanggal_input($this->input->post('awal_periode'));
        $akhir_periode = tanggal_input($this->input->post('akhir_periode'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $data = array(
            'tahunakademik_id' => $tahunakademik_id,
            'semester_id' => $semester_id,
            'keterangan' => $keterangan,
            'awal_semester' => $awal_periode,
            'akhir_semester' => $akhir_periode
        );
        $this->db3->where('id', $id);
        $this->db3->update('detailkelases', $data);
        $log_type = "ubah";
        $log_desc = "ubah Periode akademik -  $id - $tahunakademik_id - $semester_id - $keterangan - $awal_periode - $akhir_periode";
        userLog($log_type, $log_desc);
    }
}
