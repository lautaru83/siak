<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tingkat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        return $this->db3->get('tingkats')->result_array();
    }
    public function data_fk()
    {
        return $this->db3->get('tingkats')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('tingkats', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('kelases', ['tingkat_id' => $id])->num_rows();
    }
    public function cek_id($id) // cek uniq id
    {
        return $this->db3->get_where('tingkats', ['id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('tingkats', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus tingkat - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $id = $this->input->post('id');
        $tingkat = htmlspecialchars($this->input->post('tingkat'));
        $data = array(
            'id' => $id,
            'tingkat' => $tingkat
        );
        $this->db3->insert('tingkats', $data);
        $log_type = "tambah";
        $log_desc = "tambah tingkat -" . $id . "-" . $tingkat . "-";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $tingkat = $this->input->post('tingkat');
        $data = array(
            'tingkat' => $tingkat
        );
        $this->db3->where('id', $id);
        $this->db3->update('tingkats', $data);
        $log_type = "ubah";
        $log_desc = "ubah tingkat -" . $tingkat . "-";
        userLog($log_type, $log_desc);
    }
}
