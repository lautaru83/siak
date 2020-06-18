<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pembukuanaktif_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function ambil_data()
    {
        return $this->db2->get('tahunanggarans')->result_array();
    }
    // public function ambil_data_id($id)
    // {
    //     return $this->db2->get_where('tahunanggarans', ['id' => $id])->row_array();
    // }
    // public function ambil_anggaran_aktif()
    // {
    //     return $this->db2->get_where('tahunanggarans', ['is_active' => 1])->row_array();
    // }
    // public function cek_hapus($id)
    // {
    //     return $this->db2->get_where('saldoanggarans', ['tahunanggaran_id' => $id])->num_rows();
    // }
    // public function hapus($id, $info)
    // {
    //     $this->db2->delete('tahunanggarans', ['id' => $id]);
    //     $log_type = "hapus";
    //     $log_desc = "hapus tahun anggaran $info";
    //     userLog($log_type, $log_desc);
    // }
    public function ubahpembukuan()
    {
        $pembukuan_id = $this->input->post('pembukuan_id');
        $buku_awal = $this->input->post('buku_awal');
        $buku_akhir = $this->input->post('buku_akhir');
        $anggaran_id = $this->input->post('anggaran_id');
        $anggaran_awal = $this->input->post('anggaran_awal');
        $anggaran_akhir = $this->input->post('anggaran_akhir');
        $perak_id = $this->input->post('perak_id');
        $semester_awal = $this->input->post('semester_awal');
        $semester_akhir = $this->input->post('semester_akhir');
        $akademik_id = $this->input->post('tahunakademik_id');



        $nonactive = 0;
        $active = 0;
        $data = array(
            'is_active' => 1
        );
        $this->db2->set('is_active', $nonactive);
        $this->db2->update('tahun_pembukuans');
        $this->db3->set('is_active', $nonactive);
        $this->db3->update('tahunakademiks');
        $this->db2->set('is_active', $nonactive);
        $this->db2->update('tahunanggarans');
        $this->db3->set('is_active', $nonactive);
        $this->db3->update('periodeakademiks');

        $this->db2->set('is_active', $active);
        $this->db2->where('id', $pembukuan_id);
        $this->db2->update('tahun_pembukuans', $data);
        $this->db3->set('is_active', $active);
        $this->db3->where('id', $akademik_id);
        $this->db3->update('tahunakademiks', $data);
        $this->db2->set('is_active', $active);
        $this->db2->where('id', $anggaran_id);
        $this->db2->update('tahunanggarans', $data);
        $this->db3->set('is_active', $active);
        $this->db3->where('id', $perak_id);
        $this->db3->update('periodeakademiks', $data);

        $data2 = [
            'tahun_buku' => $pembukuan_id,
            'buku_awal' => $buku_awal,
            'buku_akhir' => $buku_akhir,
            'anggaran_awal' => $anggaran_awal,
            'anggaran_akhir' => $anggaran_akhir,
            'idTahan' => $anggaran_id,
            // 'tahun_anggaran' => $Tahun_Anggaran,
            // 'tahun_akademik' => $tahunAkademik,
            // 'periode_akademik' => $periodeAkademik,
            'idPerak' => $perak_id,
            'idTakad' => $akademik_id,
            // 'akademik_awal' => $akademik_awal,
            // 'akademik_akhir' => $akademik_akhir,
            'semester_awal' => $semester_awal,
            'semester_akhir' => $semester_akhir,

        ];
        $this->session->set_userdata($data2);

        // $this->db2->get_where('tahunanggarans', ['is_active' => 1])->row_array();
        // $this->db->set('field', 'field+1');
        // $this->db->where('id', 2);
        // $this->db->update('mytable');
        // $data = array(
        //     'tahunanggaran' => $tahunanggaran,
        //     'awal_periode' => $awal_periode,
        //     'akhir_periode' => $akhir_periode,
        //     'keterangan' => $keterangan,
        //     'is_active' => 0
        // );
        // $this->db2->insert('tahunanggarans', $data);
        // $log_type = "tambah";
        // $log_desc = "tambah tahun anggaran -" . $tahunanggaran . "-" . $awal_periode . "-" . $akhir_periode . "-";
        // userLog($log_type, $log_desc);
    }
    // public function tahunaktif($id, $info)
    // {
    //     $this->db2->update('tahunanggarans', array('is_active' => 0));
    //     $data = array(
    //         'is_active' => 1
    //     );
    //     $this->db2->where('id', $id);
    //     $this->db2->update('tahunanggarans', $data);
    //     $log_type = "aktif";
    //     $log_desc = "mengaktifkan tahun anggaran -" . $info . "-";
    //     userLog($log_type, $log_desc);
    // }
    // public function ubah($id)
    // {
    //     $tahunanggaran = $this->input->post('tahunanggaran');
    //     $awal_periode = tanggal_input($this->input->post('awal_periode'));
    //     $akhir_periode = tanggal_input($this->input->post('akhir_periode'));
    //     $keterangan = htmlspecialchars($this->input->post('keterangan'));
    //     $data = array(
    //         'tahunanggaran' => $tahunanggaran,
    //         'awal_periode' => $awal_periode,
    //         'akhir_periode' => $akhir_periode,
    //         'keterangan' => $keterangan
    //     );
    //     $this->db2->where('id', $id);
    //     $this->db2->update('tahunanggarans', $data);
    //     $log_type = "ubah";
    //     $log_desc = "ubah tahun anggaran -" . $tahunanggaran . "-" . $awal_periode . "-" . $akhir_periode . "-" . $keterangan . "-";
    //     userLog($log_type, $log_desc);
    // }
}
