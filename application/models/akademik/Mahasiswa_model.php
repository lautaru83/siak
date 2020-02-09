<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mahasiswa_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        return $this->db3->get('mahasiswas')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('mahasiswas', ['id' => $id])->row_array();
    }
    public function ambil_data_by_kelas_id($id)
    {
        return $this->db3->get_where('mahasiswas', ['kelas_id' => $id])->result_array();
    }
    public function cek_hapus($id)
    {
        //return $this->db3->get_where('detail_kelases', ['mahasiswa_id' => $id])->num_rows();
        return "";
    }
    public function cek_nim($nim) // cek uniq nim
    {
        return $this->db3->get_where('mahasiswas', ['nim' => $nim])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('mahasiswas', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus mahasiswa - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $nim = $this->input->post('nim');
        $nama = htmlspecialchars($this->input->post('nama'));
        $is_active = $this->input->post('is_active');
        $kelas_id = $this->input->post('kelas_id');
        $data = array(
            'nim' => $nim,
            'nama' => $nama,
            'is_active' => $is_active,
            'kelas_id' => $kelas_id
        );
        $this->db3->insert('mahasiswas', $data);
        $log_type = "tambah";
        $log_desc = "tambah Mahasiswa - $nim - $nama - $kelas_id - $is_active";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $nim = $this->input->post('nim');
        $nama = htmlspecialchars($this->input->post('nama'));
        $is_active = $this->input->post('is_active');
        $data = array(
            'nama' => $nama,
            'is_active' => $is_active
        );
        $this->db3->where('id', $id);
        $this->db3->update('mahasiswas', $data);
        $log_type = "ubah";
        $log_desc = "ubah mahasiswa $nim - $nama - $is_active ";
        userLog($log_type, $log_desc);
    }
}
