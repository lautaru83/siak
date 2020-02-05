<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Akunanggaran_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('akuntansi', TRUE);
    }
    // public function ambil_data_unit($id)
    // {
    //     return $this->db2->get_where('unitanggarans', ['id' => $id])->row_array();
    // }
    public function ambil_data_anggaran($id)
    {
        return $this->db2->get_where('anggarans', ['id' => $id])->row_array();
    }
    public function kelompok_data()
    {
        return $this->db2->get("kelompoks")->result_array();
    }
    // public function unitanggaran($id)
    // {
    //     return $this->db2->get_where('unitanggarans', ['subanggaran_id' => $id])->result_array();
    // }
    public function subakun($id)
    {
        return $this->db2->get_where('anggarans', ['kelompok_id' => $id])->result_array();
    }
    public function cek_unikakun()
    {
        $anggaran_id = $this->input->post('anggaran_id');
        $a6level_id = $this->input->post('a6level_id');
        return $this->db2->query("select * from akun_anggarans where anggaran_id=$anggaran_id and a6level_id='$a6level_id'")->num_rows();
    }
    public function daftarAkun($anggaran_id)
    {
        return $this->db2->query("select a.id as anggaran_id,b.id as id,c.id as a6level_id, c.level6 as level6 from anggarans a join akun_anggarans b on a.id=b.anggaran_id join a6levels c on c.id=b.a6level_id where b.anggaran_id=$anggaran_id")->result_array();
    }
    // public function ambil_data_id($id)
    // {
    //     return $this->db2->get_where('jenis_transaksis', ['id' => $id])->row_array();
    // }
    // public function cek_hapusunit($id)
    // {
    //     return $this->db2->get_where('anggarans', ['unitanggaran_id' => $id])->num_rows();
    // }
    public function cek_hapusanggaran($id)
    {
        return $this->db2->get_where('akun_anggarans', ['anggaran_id' => $id])->num_rows();
    }
    // public function cek_idunit($id)
    // {
    //     return $this->db2->get_where('unitanggarans', ['id' => $id])->num_rows();
    // }
    public function cek_idanggaran($id)
    {
        return $this->db2->get_where('anggarans', ['id' => $id])->num_rows();
    }
    // public function hapusunit($id, $info)
    // {
    //     $this->db2->delete('unitanggarans', ['id' => $id]);
    //     $log_type = "hapus";
    //     $log_desc = "hapus unit anggaran - $info";
    //     userLog($log_type, $log_desc);
    // }
    public function hapusanggaran($id, $info)
    {
        $this->db2->delete('anggarans', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus anggaran - $info";
        userLog($log_type, $log_desc);
    }
    public function simpanakun()
    {
        $anggaran_id = $this->input->post('anggaran_id');
        $a6level_id = $this->input->post('a6level_id');
        $data = array(
            'anggaran_id' => $anggaran_id,
            'a6level_id' => $a6level_id
        );
        $this->db2->insert('akun_anggarans', $data);
        $log_type = "simpan";
        $log_desc = "tambah akunanggaran -" . $anggaran_id . "-" . $a6level_id . "-";
        userLog($log_type, $log_desc);
    }
    public function simpananggaran()
    {
        // $id = $this->input->post('id');
        $kelompok_id = $this->input->post('kelompok_id');
        $anggaran = htmlspecialchars($this->input->post('anggaran'));
        $posisi = $this->input->post('posisi');
        $institusi_id = $this->input->post('institusi_id');
        $data = array(
            'anggaran' => $anggaran,
            'kelompok_id' => $kelompok_id,
            'posisi' => $posisi,
            'institusi_id' => $institusi_id
        );
        $this->db2->insert('anggarans', $data);
        $log_type = "simpan";
        $log_desc = "tambah akun anggaran -" . $anggaran . "-" . $posisi . "-" . $institusi_id . "-";
        userLog($log_type, $log_desc);
    }
    // public function ubahunit($id)
    // {
    //     $unit_anggaran = $this->input->post('unit_anggaran');
    //     $data = array(
    //         'unit_anggaran' => $unit_anggaran
    //     );
    //     $this->db2->where('id', $id);
    //     $this->db2->update('unitanggarans', $data);
    //     $log_type = "ubah";
    //     $log_desc = "ubah unitanggaran -" . $id . "-" . $unit_anggaran . "-";
    //     userLog($log_type, $log_desc);
    // }
    public function ubahanggaran($id)
    {
        $anggaran = htmlspecialchars($this->input->post('anggaran'));
        $posisi = $this->input->post('posisi');
        $institusi_id = $this->input->post('institusi_id');
        $data = array(
            'anggaran' => $anggaran,
            'posisi' => $posisi,
            'institusi_id' => $institusi_id
        );
        $this->db2->where('id', $id);
        $this->db2->update('anggarans', $data);
        $log_type = "ubah";
        $log_desc = "ubah anggaran -" . $anggaran . "-" . $posisi . "-" . $institusi_id . "-";
        userLog($log_type, $log_desc);
    }
}
