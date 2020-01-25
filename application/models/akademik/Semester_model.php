<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Semester_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        return $this->db3->get('semesters')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('semesters', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('akademiks', ['semester_id' => $id])->num_rows();
    }
    public function cek_id($id) // cek uniq id
    {
        return $this->db3->get_where('semesters', ['id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('semesters', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus semester - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $id = $this->input->post('id');
        $semester = htmlspecialchars($this->input->post('semester'));
        $data = array(
            'semester' => $semester
        );
        $this->db3->insert('semesters', $data);
        $log_type = "tambah";
        $log_desc = "tambah semester -" . $semester . "-";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $semester = $this->input->post('semester');
        $data = array(
            'semester' => $semester
        );
        $this->db3->where('id', $id);
        $this->db3->update('semesters', $data);
        $log_type = "ubah";
        $log_desc = "ubah semester -" . $semester . "-";
        userLog($log_type, $log_desc);
    }
}
