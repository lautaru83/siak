<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tahunajaran_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        return $this->db3->get('tahun_ajarans')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('tahun_ajarans', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('akademiks', ['tahun_ajaran_id' => $id])->num_rows();
    }
    public function cek_id($id) // cek uniq id
    {
        return $this->db3->get_where('tahun_ajarans', ['id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('tahun_ajarans', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus Tahun ajaran - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        //$id = $this->input->post('id');
        $awal_periode = tanggal_input($this->input->post('awal_periode'));
        $akhir_periode = tanggal_input($this->input->post('akhir_periode'));
        $tahun_ajaran = htmlspecialchars($this->input->post('tahun_ajaran'));
        $data = array(
            'tahun_ajaran' => $tahun_ajaran,
            'awal_periode' => $awal_periode,
            'akhir_periode' => $akhir_periode,
            'is_active' => 0
        );
        $this->db3->insert('tahun_ajarans', $data);
        $log_type = "tambah";
        $log_desc = "tambah Tahun ajaran -  $tahun_ajaran - $awal_periode - $akhir_periode";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $awal_periode = tanggal_input($this->input->post('awal_periode'));
        $akhir_periode = tanggal_input($this->input->post('akhir_periode'));
        $tahun_ajaran = htmlspecialchars($this->input->post('tahun_ajaran'));
        $data = array(
            'tahun_ajaran' => $tahun_ajaran,
            'awal_periode' => $awal_periode,
            'akhir_periode' => $akhir_periode
        );
        $this->db3->where('id', $id);
        $this->db3->update('tahun_ajarans', $data);
        $log_type = "ubah";
        $log_desc = "ubah Tahun ajaran -  $tahun_ajaran - $awal_periode - $akhir_periode";
        userLog($log_type, $log_desc);
    }
}
