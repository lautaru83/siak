<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Periodeakademik_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        return $this->db3->query("SELECT a.id AS id, a.tahunakademik_id AS tahunakademik_id, a.awal_semester AS awal_semester, a.akhir_semester AS akhir_semester, a.keterangan AS keterangan, a.is_active AS is_active, b.tahunakademik AS tahunakademik, c.semester AS semester FROM periodeakademiks AS a INNER JOIN tahunakademiks AS b ON b.id = a.tahunakademik_id INNER JOIN semesters AS c ON c.id = a.semester_id order by b.id desc")->result_array();
    }
    public function data_fk()
    {
        return $this->db3->get('periodeakademiks')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('periodeakademiks', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('detailkelases', ['perak_id' => $id])->num_rows();
    }
    public function cek_id($id) // cek uniq id
    {
        return $this->db3->get_where('periodeakademiks', ['id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('periodeakademiks', ['id' => $id]);
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
        $this->db3->insert('periodeakademiks', $data);
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
        $this->db3->update('periodeakademiks', $data);
        $log_type = "ubah";
        $log_desc = "ubah Periode akademik -  $id - $tahunakademik_id - $semester_id - $keterangan - $awal_periode - $akhir_periode";
        userLog($log_type, $log_desc);
    }
}
