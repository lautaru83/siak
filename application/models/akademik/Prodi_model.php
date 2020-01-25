<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Prodi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        //return $this->db3->get('prodis')->result_array();
        $sql = "select a.id as id,a.prodi as prodi, b.id as jenjang_id,b.jenjang as jenjang,c.id as jurusan_id,c.jurusan as jurusan,d.id as jalur_id,d.jalur as jalur from prodis a join jenjangs b on b.id=a.jenjang_id join jurusans c on c.id=a.jurusan_id join jalurs d on d.id=a.jalur_id order by a.id ASC";
        $data = $this->db3->query($sql);
        return $data->result_array();
    }
    public function data_fk()
    {
        return $this->db3->get('prodis')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('prodis', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('kelases', ['prodi_id' => $id])->num_rows();
    }
    public function cek_id($id) // cek uniq id
    {
        return $this->db3->get_where('prodis', ['id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('prodis', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus prodi - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $id = $this->input->post('id');
        $prodi = htmlspecialchars($this->input->post('prodi'));
        $jenjang_id = $this->input->post('jenjang_id');
        $jurusan_id = $this->input->post('jurusan_id');
        $jalur_id = $this->input->post('jalur_id');
        $data = array(
            'id' => $id,
            'prodi' => $prodi,
            'jenjang_id' => $jenjang_id,
            'jurusan_id' => $jurusan_id,
            'jalur_id' => $jalur_id
        );
        $this->db3->insert('prodis', $data);
        $log_type = "tambah";
        $log_desc = "tambah prodi - $id - $prodi - $jenjang_id - $jurusan_id - $jalur_id ";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $prodi = htmlspecialchars($this->input->post('prodi'));
        $jenjang_id = $this->input->post('jenjang_id');
        $jurusan_id = $this->input->post('jurusan_id');
        $jalur_id = $this->input->post('jalur_id');
        $data = array(
            'prodi' => $prodi,
            'jenjang_id' => $jenjang_id,
            'jurusan_id' => $jurusan_id,
            'jalur_id' => $jalur_id
        );
        $this->db3->where('id', $id);
        $this->db3->update('prodis', $data);
        $log_type = "ubah";
        $log_desc = "ubah prodi - $id - $prodi - $jenjang_id - $jurusan_id - $jalur_id";
        userLog($log_type, $log_desc);
    }
}
