<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Angkatan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        return $this->db3->get('angkatans')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('angkatans', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('mahasiswas', ['angkatan_id' => $id])->num_rows();
    }
    public function cek_id($id) // cek uniq id
    {
        return $this->db3->get_where('angkatans', ['id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('angkatans', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus Angkatan - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $id = $this->input->post('id');
        $angkatan = htmlspecialchars($this->input->post('angkatan'));
        $data = array(
            'id' => $id,
            'angkatan' => $angkatan
        );
        $this->db3->insert('angkatans', $data);
        $log_type = "tambah";
        $log_desc = "tambah Angkatan -" . $id . "-" . $angkatan . "-";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $angkatan = $this->input->post('angkatan');
        $data = array(
            'angkatan' => $angkatan
        );
        $this->db3->where('id', $id);
        $this->db3->update('angkatans', $data);
        $log_type = "ubah";
        $log_desc = "ubah angkatan -" . $angkatan . "-";
        userLog($log_type, $log_desc);
    }
    public function cek_akun($data = array())
    {
        return $this->db3->get_where('akun_transaksis', $data)->row_array();
    }
}
