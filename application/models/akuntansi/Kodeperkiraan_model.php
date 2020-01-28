<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kodeperkiraan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('akuntansi', TRUE);
    }
    public function ambil_data_id5($id)
    {
        return $this->db2->get_where('a5levels', ['id' => $id])->row_array();
    }
    public function akunjurnal()
    {
        return $this->db2->get('a6levels')->result_array();
    }
    public function ambil_data_id6($id)
    {
        return $this->db2->get_where('a6levels', ['id' => $id])->row_array();
    }
    public function ambil_data()
    {
        return $this->db2->query("select a3levels.id as id,a1levels.level1 as level1,a2levels.level2 as level2, a3levels.level3 as level3 from a1levels join a2levels on a1levels.id=a2levels.a1level_id join a3levels on a2levels.id=a3levels.a2level_id order by a3levels.id asc")->result_array();
    }
    public function akun_saldo()
    {
        return $this->db2->query("select a3levels.id as id,a1levels.level1 as level1,a2levels.level2 as level2, a3levels.level3 as level3 from a1levels join a2levels on a1levels.id=a2levels.a1level_id join a3levels on a2levels.id=a3levels.a2level_id where a1levels.id IN(100,200,300) order by a3levels.id asc")->result_array();
    }
    public function akunsaldoawal($idtahun, $institusi_id)
    {
        return $this->db2->query("select a.id as id,a.posisi as posisi,b.saldoawal as saldoawal from a6levels a join saldoawals b on a.id=b.a6level_id where a.institusi_id=$institusi_id and b.tahun_pembukuan_id=$idtahun ")->result_array();
    }
    public function level4($id)
    {
        return $this->db2->get_where('a4levels', ['a3level_id' => $id])->result_array();
    }
    public function level4institusi($id)
    {
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("select distinct a.id as id,a.level4 as level4,a.a3level_id as a3level_id from a4levels a join a5levels b on a.id=b.a4level_id join a6levels c on b.id=c.a5level_id where a.a3level_id=$id and c.institusi_id=$institusi_id group by a.id")->result_array();
    }
    public function level5($id)
    {
        return $this->db2->get_where('a5levels', ['a4level_id' => $id])->result_array();
    }
    public function level5institusi($id)
    {
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("select distinct a.id as id,a.level5 as level5,a.a4level_id as a4level_id from a5levels a join a6levels b on a.id=b.a5level_id where a.a4level_id=$id and b.institusi_id=$institusi_id")->result_array();
        //return $this->db2->get_where('a5levels', ['a4level_id' => $id])->result_array();
    }
    public function level6($id)
    {
        return $this->db2->query("select siak_akuntansi.a6levels.id as id,siak_akuntansi.a6levels.a5level_id as a5level_id,siak_akuntansi.a6levels.kode6 as kode6,siak_akuntansi.a6levels.level6 as level6, siak_akuntansi.a6levels.posisi as posisi,siak_setting.institusis.institusi as institusi from siak_akuntansi.a6levels join siak_setting.institusis on siak_setting.institusis.id=siak_akuntansi.a6levels.institusi_id  where siak_akuntansi.a6levels.a5level_id='$id' order by siak_akuntansi.a6levels.id ASC  ")->result_array();
    }
    public function level6institusi($id)
    {
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("select siak_akuntansi.a6levels.id as id,siak_akuntansi.a6levels.a5level_id as a5level_id,siak_akuntansi.a6levels.kode6 as kode6,siak_akuntansi.a6levels.level6 as level6, siak_akuntansi.a6levels.posisi as posisi,siak_setting.institusis.institusi as institusi from siak_akuntansi.a6levels join siak_setting.institusis on siak_setting.institusis.id=siak_akuntansi.a6levels.institusi_id  where siak_akuntansi.a6levels.a5level_id='$id' and siak_akuntansi.a6levels.institusi_id='$institusi_id' order by siak_akuntansi.a6levels.id ASC  ")->result_array();
    }
    // public function ambil_data_id($id)
    // {
    //     return $this->db2->get_where('jenis_transaksis', ['id' => $id])->row_array();
    // }
    public function cek_hapusakun5($id)
    {
        return $this->db2->get_where('a6levels', ['a5level_id' => $id])->num_rows();
    }
    public function cek_hapusakun6($id)
    {
        return $this->db2->get_where('akun_transaksis', ['a6level_id' => $id])->num_rows();
    }
    public function cek_id5($id)
    {
        return $this->db2->get_where('a5levels', ['id' => $id])->num_rows();
    }
    public function cek_id6($id)
    {
        return $this->db2->get_where('a6levels', ['id' => $id])->num_rows();
    }
    public function hapusakun5($id, $info)
    {
        $this->db2->delete('a5levels', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus akun5 - $info";
        userLog($log_type, $log_desc);
    }
    public function hapusakun6($id, $info)
    {
        $this->db2->delete('a6levels', ['id' => $id]);
        $log_type = "hapus";
        $log_desc = "hapus akun6 - $info";
        userLog($log_type, $log_desc);
    }
    public function simpanakun5()
    {
        $id = $this->input->post('id');
        $a4level_id = $this->input->post('a4level_id');
        $kode5 = $this->input->post('kode5');
        $level5 = htmlspecialchars($this->input->post('level5'));
        $data = array(
            'id' => $id,
            'a4level_id' => $a4level_id,
            'kode5' => $kode5,
            'level5' => $level5
        );
        $this->db2->insert('a5levels', $data);
        $log_type = "simpan";
        $log_desc = "tambah akun level 5 -" . $id . "-" . $a4level_id . "-" . $kode5 . "-" . $level5 . "-";
        userLog($log_type, $log_desc);
    }
    public function simpanakun6()
    {
        $id = $this->input->post('id');
        $a5level_id = $this->input->post('a5level_id');
        $kode6 = $this->input->post('kode6');
        $level6 = htmlspecialchars($this->input->post('level6'));
        $posisi = $this->input->post('posisi');
        $institusi_id = $this->input->post('institusi_id');
        $data = array(
            'id' => $id,
            'a5level_id' => $a5level_id,
            'kode6' => $kode6,
            'level6' => $level6,
            'posisi' => $posisi,
            'institusi_id' => $institusi_id
        );
        $this->db2->insert('a6levels', $data);
        $log_type = "simpan";
        $log_desc = "tambah akun level 6 -" . $id . "-" . $a5level_id . "-" . $kode6 . "-" . $level6 . "-" . $posisi . "-" . $institusi_id . "-";
        userLog($log_type, $log_desc);
    }
    public function ubahakun5($id)
    {
        $level5 = $this->input->post('level5');
        $data = array(
            'level5' => $level5
        );
        $this->db2->where('id', $id);
        $this->db2->update('a5levels', $data);
        $log_type = "ubah";
        $log_desc = "ubah akun 5 -" . $level5 . "-";
        userLog($log_type, $log_desc);
    }
    public function ubahakun6($id)
    {
        $level6 = $this->input->post('level6');
        $posisi = $this->input->post('posisi');
        $institusi_id = $this->input->post('institusi_id');
        $data = array(
            'level6' => $level6,
            'posisi' => $posisi,
            'institusi_id' => $institusi_id
        );
        $this->db2->where('id', $id);
        $this->db2->update('a6levels', $data);
        $log_type = "ubah";
        $log_desc = "ubah akun 6 -" . $level6 . "-" . $posisi . "-" . $institusi_id . "-";
        userLog($log_type, $log_desc);
    }
}
