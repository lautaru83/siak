<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jalur_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        return $this->db3->get('jalurs')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('jalurs', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('prodis', ['jalur_id' => $id])->num_rows();
    }
    public function cek_id($id) // cek uniq id
    {
        return $this->db3->get_where('jalurs', ['id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('jalurs', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus jalur pendidikan  - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $id = $this->input->post('id');
        $jalur = htmlspecialchars($this->input->post('jalur'));
        $data = array(
            //'id' => $id,
            'jalur' => $jalur
        );
        $this->db3->insert('jalurs', $data);
        $log_type = "tambah";
        $log_desc = "tambah jalur pendidikan -" . $jalur . "-";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $jalur = $this->input->post('jalur');
        $data = array(
            'jalur' => $jalur
        );
        $this->db3->where('id', $id);
        $this->db3->update('jalurs', $data);
        $log_type = "ubah";
        $log_desc = "ubah jalur pendidikan -" . $jalur . "-";
        userLog($log_type, $log_desc);
    }
}
