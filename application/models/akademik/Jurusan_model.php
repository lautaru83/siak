<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jurusan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        //return $this->db3->get('jurusans')->result_array();
        $sql = "select a.id as id,a.jurusan as jurusan, b.id as unit_id,b.unit as unit from siak_akademik.jurusans a join siak_setting.units b on b.id=a.unit_id order by a.id ASC";
        $data = $this->db3->query($sql);
        return $data->result_array();
    }
    public function data_fk()
    {
        return $this->db3->get('jurusans')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('jurusans', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('prodis', ['jurusan_id' => $id])->num_rows();
    }
    public function cek_id($id) // cek uniq id
    {
        return $this->db3->get_where('jurusans', ['id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('jurusans', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus jurusan - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $id = $this->input->post('id');
        $unit_id = $this->input->post('unit_id');
        $jurusan = htmlspecialchars($this->input->post('jurusan'));
        $data = array(
            'id' => $id,
            'jurusan' => $jurusan,
            'unit_id' => $unit_id
        );
        $this->db3->insert('jurusans', $data);
        $log_type = "tambah";
        $log_desc = "tambah jurusan - $id - $jurusan - $unit_id";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $jurusan = $this->input->post('jurusan');
        $unit_id = $this->input->post('unit_id');
        $data = array(
            'jurusan' => $jurusan,
            'unit_id' => $unit_id
        );
        $this->db3->where('id', $id);
        $this->db3->update('jurusans', $data);
        $log_type = "ubah";
        $log_desc = "ubah jurusan - $id - $jurusan - $unit_id ";
        userLog($log_type, $log_desc);
    }
}
