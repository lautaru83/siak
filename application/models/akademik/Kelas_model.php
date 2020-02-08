<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kelas_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        return $this->db3->query("SELECT a.id AS id, b.angkatan AS angkatan, c.prodi AS prodi, a.angkatan_id AS angkatan_id, a.prodi_id AS prodi_id, a.keterangan AS keterangan FROM kelases AS a INNER JOIN angkatans AS b ON b.id = a.angkatan_id INNER JOIN prodis AS c ON c.id = a.prodi_id order by a.id DESC")->result_array();
    }
    public function data_fk()
    {
        return $this->db3->get('kelases')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('kelases', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('mahasiswas', ['kelas_id' => $id])->num_rows();
    }
    public function cek_id($id) // cek uniq id
    {
        return $this->db3->get_where('kelases', ['id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('kelases', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus kelas - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $id = $this->input->post('id');
        $angkatan_id = $this->input->post('angkatan_id');
        $prodi_id = $this->input->post('prodi_id');
        $keterangan = $this->input->post('keterangan');
        $data = array(
            'id' => $id,
            'angkatan_id' => $angkatan_id,
            'prodi_id' => $prodi_id,
            'keterangan' => $keterangan,
        );
        $this->db3->insert('kelases', $data);
        $log_type = "tambah";
        $log_desc = "tambah kelas - $id - $angkatan_id - $prodi_id - $keterangan";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $angkatan_id = $this->input->post('angkatan_id');
        $prodi_id = $this->input->post('prodi_id');
        $keterangan = $this->input->post('keterangan');
        $data = array(
            'angkatan_id' => $angkatan_id,
            'prodi_id' => $prodi_id,
            'keterangan' => $keterangan,
        );
        $this->db3->where('id', $id);
        $this->db3->update('kelases', $data);
        $log_type = "ubah";
        $log_desc = "ubah kelas - $id - $angkatan_id - $prodi_id - $keterangan";
        userLog($log_type, $log_desc);
    }
}
