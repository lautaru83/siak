<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Transaksi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        //$this->db2 = $this->load->database('akuntansi', TRUE);
    }
    public function cektransaldo($thbuku_id, $unit_id)
    {
        return $this->db2->get_where('transaksis', ['tahun_buku' => $thbuku_id, 'unit_id' => $unit_id])->row_array();
    }
    public function simpantransaksi($thbuku_id, $notran, $unit_id)
    {
        $jurnal = "SA";
        $keterangan = "Saldo Awal";
        $accounting = "system";
        $tanggal_transaksi = $thbuku_id . "-01-01";
        $user_id = $this->session->userdata('xyz');
        //$notran="";
        $data = array(
            'tahun_buku' => $thbuku_id,
            'jurnal' => $jurnal,
            'notran' => $notran,
            'nobukti' => $notran,
            'tanggal_transaksi' => $tanggal_transaksi,
            'accounting' => $accounting,
            'keterangan' => $keterangan,
            'unit_id' => $unit_id,
            'total_transaksi' => 0,
            'is_valid' => 2,
            'user_id' => $user_id
        );
        $this->db2->insert('transaksis', $data);
        // endforeach
    }
    public function hapusdetailsaldo($id)
    {
        $this->db2->delete('detail_transaksis', ['transaksi_id' => $id]);
    }
    public function simpandetailsaldo($tran_id, $a6level_id, $posisi, $jumlah)
    {
        if ($posisi == "D") {
            $debet = $jumlah;
            $kredit = 0;
        } else {
            $debet = 0;
            $kredit = $jumlah;
        }
        $data = array(
            'transaksi_id' => $tran_id,
            'a6levels_id' => $a6level_id,
            'posisi_akun' => $posisi,
            'debet' => $debet,
            'kredit' => $kredit,
            'jumlah' => $jumlah
        );
        $this->db2->insert('detail_transaksis', $data);
    }
    public function simpandetailtransaksi($idtahun)
    {
    }
    // public function cek_hapus($thbuku_id, $akun_id)
    // {
    //     return $this->db2->get_where('saldoawals', ['tahun_pembukuan_id' => $thbuku_id, 'a6level_id' => $akun_id])->num_rows();
    // }
    // public function hapus($thbuku_id, $akun_id, $info)
    // {
    //     $this->db2->delete('saldoawals', ['tahun_pembukuan_id' => $thbuku_id, 'a6level_id' => $akun_id]);
    //     $log_type = "hapus";
    //     $log_desc = "hapus saldo awal $akun_id - $info - $thbuku_id";
    //     userLog($log_type, $log_desc);
    // }
    // public function simpan()
    // {
    //     $thbuku_id = $this->input->post('tahun_pembukuan_id');
    //     $akun_id = $this->input->post('a6level_id');
    //     $saldo = input_uang($this->input->post('saldoawal'));
    //     $data = array(
    //         'tahun_pembukuan_id' => $thbuku_id,
    //         'a6level_id' => $akun_id,
    //         'saldoawal' => $saldo,
    //         'is_valid' => 0
    //     );
    //     $this->db2->insert('saldoawals', $data);
    //     $log_type = "tambah";
    //     $log_desc = "tambah saldoawal -" . $thbuku_id . "-" . $akun_id . "-" . $saldo . "-";
    //     userLog($log_type, $log_desc);
    // }
    // public function ubah($id)
    // {
    //     $thbuku_id = $this->input->post('tahun_pembukuan_id');
    //     $a6level_id = $this->input->post('a6level_id');
    //     $saldo = input_uang($this->input->post('saldoawal'));
    //     $data = array(
    //         'tahun_pembukuan_id' => $thbuku_id,
    //         'a6level_id' => $a6level_id,
    //         'saldoawal' => $saldo,
    //         'is_valid' => 0
    //     );
    //     $this->db2->where('id', $id);
    //     $this->db2->update('saldoawals', $data);
    //     $log_type = "ubah";
    //     $log_desc = "ubah saldoawal -" . $thbuku_id . "-" . $a6level_id . "-" . $saldo . "-";
    //     userLog($log_type, $log_desc);
    // }
}
