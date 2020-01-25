<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jenjang_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        return $this->db3->get('jenjangs')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db3->get_where('jenjangs', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db3->get_where('prodis', ['jenjang_id' => $id])->num_rows();
    }
    public function cek_id($id) // cek uniq id
    {
        return $this->db3->get_where('jenjangs', ['id' => $id])->num_rows();
    }
    public function hapus($id, $info)
    {
        $this->db3->delete('jenjangs', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus jenjang - $info";
        userLog($log_type, $log_desc);
    }
    public function simpan()
    {
        $id = $this->input->post('id');
        $jenjang = htmlspecialchars($this->input->post('jenjang'));
        $data = array(
            'id' => $id,
            'jenjang' => $jenjang
        );
        $this->db3->insert('jenjangs', $data);
        $log_type = "tambah";
        $log_desc = "tambah jenjang -" . $id . "-" . $jenjang . "-";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $jenjang = $this->input->post('jenjang');
        $data = array(
            'jenjang' => $jenjang
        );
        $this->db3->where('id', $id);
        $this->db3->update('jenjangs', $data);
        $log_type = "ubah";
        $log_desc = "ubah jenjang -" . $jenjang . "-";
        userLog($log_type, $log_desc);
    }
}
