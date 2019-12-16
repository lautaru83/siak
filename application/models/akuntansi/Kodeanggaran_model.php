<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kodeanggaran_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('akuntansi', TRUE);
    }
    public function ambil_data_unit($id)
    {
        return $this->db2->get_where('unitanggarans', ['id' => $id])->row_array();
    }
    public function ambil_data_anggaran($id)
    {
        return $this->db2->get_where('anggarans', ['id' => $id])->row_array();
    }
    public function kelompokanggaran_data()
    {
        return $this->db2->get("kelompokanggarans")->result_array();
    }
    public function unitanggaran($id)
    {
        return $this->db2->get_where('unitanggarans', ['subanggaran_id' => $id])->result_array();
    }
    public function subanggaran($id)
    {
        return $this->db2->get_where('subanggarans', ['kelompokanggaran_id' => $id])->result_array();
    }
    public function anggaran($id)
    {
        return $this->db2->query("select a.id as id,a.unitanggaran_id as unitanggaran_id,a.nama_anggaran as nama_anggaran,a.posisi as posisi,b.institusi as institusi from siak_akuntansi.anggarans a join siak_setting.institusis b on b.id=a.institusi_id where a.unitanggaran_id='$id' order by a.id asc")->result_array();
    }
    // public function ambil_data_id($id)
    // {
    //     return $this->db2->get_where('jenis_transaksis', ['id' => $id])->row_array();
    // }
    public function cek_hapusunit($id)
    {
        return $this->db2->get_where('anggarans', ['unitanggaran_id' => $id])->num_rows();
    }
    public function cek_hapusanggaran($id)
    {
        return $this->db2->get_where('akun_anggarans', ['anggaran_id' => $id])->num_rows();
    }
    public function cek_idunit($id)
    {
        return $this->db2->get_where('unitanggarans', ['id' => $id])->num_rows();
    }
    public function cek_idanggaran($id)
    {
        return $this->db2->get_where('anggarans', ['id' => $id])->num_rows();
    }
    public function hapusunit($id, $info)
    {
        $this->db2->delete('unitanggarans', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus unit anggaran - $info";
        userLog($log_type, $log_desc);
    }
    public function hapusanggaran($id, $info)
    {
        $this->db2->delete('anggarans', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus anggaran - $info";
        userLog($log_type, $log_desc);
    }
    public function simpanunit()
    {
        $id = $this->input->post('id');
        $kelompokanggaran_id = $this->input->post('kelompokanggaran_id');
        $unit_anggaran = htmlspecialchars($this->input->post('unit_anggaran'));
        $data = array(
            'id' => $id,
            'kelompokanggaran_id' => $kelompokanggaran_id,
            'unit_anggaran' => $unit_anggaran
        );
        $this->db2->insert('unitanggarans', $data);
        $log_type = "simpan";
        $log_desc = "tambah unitanggaran -" . $id . "-" . $kelompokanggaran_id . "-" . $unit_anggaran . "-";
        userLog($log_type, $log_desc);
    }
    public function simpananggaran()
    {
        $id = $this->input->post('id');
        $unitanggaran_id = $this->input->post('unitanggaran_id');
        $kode = $this->input->post('kodeanggaran');
        $nama_anggaran = htmlspecialchars($this->input->post('nama_anggaran'));
        $posisi = $this->input->post('posisi');
        $institusi_id = $this->input->post('institusi_id');
        $data = array(
            'id' => $id,
            'unitanggaran_id' => $unitanggaran_id,
            'kode' => $kode,
            'nama_anggaran' => $nama_anggaran,
            'posisi' => $posisi,
            'institusi_id' => $institusi_id
        );
        $this->db2->insert('anggarans', $data);
        $log_type = "simpan";
        $log_desc = "tambah akun anggaran -" . $id . "-" . $unitanggaran_id . "-" . $kode . "-" . $nama_anggaran . "-" . $posisi . "-" . $institusi_id . "-";
        userLog($log_type, $log_desc);
    }
    public function ubahunit($id)
    {
        $unit_anggaran = $this->input->post('unit_anggaran');
        $data = array(
            'unit_anggaran' => $unit_anggaran
        );
        $this->db2->where('id', $id);
        $this->db2->update('unitanggarans', $data);
        $log_type = "ubah";
        $log_desc = "ubah unitanggaran -" . $id . "-" . $unit_anggaran . "-";
        userLog($log_type, $log_desc);
    }
    public function ubahanggaran($id)
    {
        $nama_anggaran = htmlspecialchars($this->input->post('nama_anggaran'));
        $posisi = $this->input->post('posisi');
        $institusi_id = $this->input->post('institusi_id');
        $data = array(
            'nama_anggaran' => $nama_anggaran,
            'posisi' => $posisi,
            'institusi_id' => $institusi_id
        );
        $this->db2->where('id', $id);
        $this->db2->update('anggarans', $data);
        $log_type = "ubah";
        $log_desc = "ubah anggaran -" . $id . "-" . $nama_anggaran . "-" . $posisi . "-" . $institusi_id . "-";
        userLog($log_type, $log_desc);
    }
}
