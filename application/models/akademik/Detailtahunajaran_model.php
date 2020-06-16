<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Detailtahunajaran_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        //return $this->db3->get('akademiks')->result_array();
        $sql = "select a.id as id,a.awal_semester as awal_semester, a.akhir_semester as akhir_semester,a.keterangan as keterangan,a.is_active as is_active,b.id as tahunakademik_id,b.tahunakademik as tahunakademik,c.id as semester_id,c.semester as semester from periodeakademiks a join tahunakademiks b on b.id=a.tahunakademik_id join semesters c on c.id=a.semester_id order by b.tahunakademik ASC";
        $data = $this->db3->query($sql);
        return $data->result_array();
    }
    public function data_fk()
    {
        return $this->db3->get('akademiks')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('akademiks', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('kelases', ['akademik_id' => $id])->num_rows();
    }
    // public function cek_id($id) // cek uniq id
    // {
    //     return $this->db3->get_where('akademiks', ['id' => $id])->num_rows();
    // }
    public function cekunikdetail() // cek uniq id
    {
        $tahun_ajaran_id = $this->input->post('tahun_ajaran_id');
        $semester_id = $this->input->post('semester_id');
        return $this->db3->get_where('akademiks', ['tahun_ajaran_id' => $tahun_ajaran_id, 'semester_id' => $semester_id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('akademiks', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus detail tahun ajaran - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $tahun_ajaran_id = $this->input->post('tahun_ajaran_id');
        $semester_id = $this->input->post('semester_id');
        $awal_periode = tanggal_input($this->input->post('awal_periode'));
        $akhir_periode = tanggal_input($this->input->post('akhir_periode'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $data = array(
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'semester_id' => $semester_id,
            'awal_periode' => $awal_periode,
            'akhir_periode' => $akhir_periode,
            'keterangan' => $keterangan,
            'is_active' => 0
        );
        $this->db3->insert('akademiks', $data);
        $log_type = "tambah";
        $log_desc = "tambah detail tahun ajaran - $tahun_ajaran_id - $semester_id - $awal_periode - $akhir_periode - $keterangan ";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $tahun_ajaran_id = $this->input->post('tahun_ajaran_id');
        $semester_id = $this->input->post('semester_id');
        $awal_periode = tanggal_input($this->input->post('awal_periode'));
        $akhir_periode = tanggal_input($this->input->post('akhir_periode'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $data = array(
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'semester_id' => $semester_id,
            'awal_periode' => $awal_periode,
            'akhir_periode' => $akhir_periode,
            'keterangan' => $keterangan
        );
        $this->db3->where('id', $id);
        $this->db3->update('akademiks', $data);
        $log_type = "ubah";
        $log_desc = "ubah detail tahun ajaran - $tahun_ajaran_id - $semester_id - $awal_periode - $akhir_periode - $keterangan";
        userLog($log_type, $log_desc);
    }
}
