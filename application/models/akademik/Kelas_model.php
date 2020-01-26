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
        $sql = "select a.id as id,a.kelas as kelas,b.id as akademik_id,b.keterangan as keterangan,c.id as prodi_id,c.prodi as prodi,d.id as tingkat_id,d.tingkat as tingkat from kelases a join akademiks b on b.id=a.akademik_id join prodis c on c.id=a.prodi_id join tingkats d on d.id=a.tingkat_id order by a.id ASC";
        $data = $this->db3->query($sql);
        return $data->result_array();
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
        return $this->db3->get_where('detail_kelases', ['kelas_id' => $id])->num_rows();
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
        $kelas = $this->input->post('kelas');
        $akademik_id = $this->input->post('akademik_id');
        $prodi_id = $this->input->post('prodi_id');
        $tingkat_id = $this->input->post('tingkat_id');
        $data = array(
            'kelas' => $kelas,
            'akademik_id' => $akademik_id,
            'prodi_id' => $prodi_id,
            'tingkat_id' => $tingkat_id,
        );
        $this->db3->insert('kelases', $data);
        $log_type = "tambah";
        $log_desc = "tambah kelas - $kelas - $akademik_id - $prodi_id - $tingkat_id";
        userLog($log_type, $log_desc);
    }
    public function ubah($id)
    {
        $kelas = $this->input->post('kelas');
        $akademik_id = $this->input->post('akademik_id');
        $prodi_id = $this->input->post('prodi_id');
        $tingkat_id = $this->input->post('tingkat_id');
        $data = array(
            'kelas' => $kelas,
            'akademik_id' => $akademik_id,
            'prodi_id' => $prodi_id,
            'tingkat_id' => $tingkat_id,
        );
        $this->db3->where('id', $id);
        $this->db3->update('kelases', $data);
        $log_type = "ubah";
        $log_desc = "ubah kelas - $kelas - $akademik_id - $prodi_id - $tingkat_id";
        userLog($log_type, $log_desc);
    }
}
