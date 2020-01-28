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
    public function cektranuser($jurnal)
    {
        $user_id = $this->session->userdata('xyz');
        $thbuku_id = $this->session->userdata('tahun_buku');
        return $this->db2->get_where('transaksis', ['tahun_buku' => $thbuku_id, 'jurnal' => $jurnal, 'user_id' => $user_id, 'is_valid' => 0])->row_array();
    }
    public function cektransaldo($thbuku_id, $unit_id)
    {
        return $this->db2->get_where('transaksis', ['tahun_buku' => $thbuku_id, 'unit_id' => $unit_id])->row_array();
    }
    public function detailtransaksi($tran_id)
    {
        return $this->db2->query("select a.id as id,a.a6level_id as a6level_id,b.level6 as level6,a.posisi_akun as posisi,a.jumlah as jumlah,a.debet as debet,a.kredit as kredit from detail_transaksis a join a6levels b on b.id=a.a6level_id where a.transaksi_id=$tran_id")->result_array();
    }
    public function detailtransaksi_by_id($id)
    {
        return $this->db2->get_where('detail_transaksis', ['id' => $id])->row_array();
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
    public function simpan()
    {
        $accounting = $this->session->userdata('nama_user');
        $user_id = $this->session->userdata('xyz');
        $unit_id = $this->input->post('unit_id');
        $tahun_buku = $this->input->post('tahun_buku');
        $jurnal = $this->input->post('jurnal');
        //$notran = $this->input->post('notran');
        $notran = notransaksi();
        $tanggal_transaksi = tanggal_input($this->input->post('tanggal_transaksi'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $nobukti = htmlspecialchars($this->input->post('nobukti'));
        $data = array(
            'tahun_buku' => $tahun_buku,
            'jurnal' => $jurnal,
            'notran' => $notran,
            'nobukti' => $nobukti,
            'tanggal_transaksi' => $tanggal_transaksi,
            'accounting' => $accounting,
            'keterangan' => $keterangan,
            'unit_id' => $unit_id,
            'total_transaksi' => 0,
            'is_valid' => 0,
            'user_id' => $user_id
        );
        $this->db2->insert('transaksis', $data);
    }
    public function ubah($id)
    {
        $unit_id = $this->input->post('unit_id');
        $tanggal_transaksi = tanggal_input($this->input->post('tanggal_transaksi'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $nobukti = htmlspecialchars($this->input->post('nobukti'));
        $data = array(
            'nobukti' => $nobukti,
            'tanggal_transaksi' => $tanggal_transaksi,
            'keterangan' => $keterangan,
            'unit_id' => $unit_id
        );
        $this->db2->where('id', $id);
        $this->db2->update('transaksis', $data);
    }
    public function cek_akunubah($akun_id, $tran_id)
    {
        return $this->db2->query("select a6level_id,transaksi_id from detail_transaksis where a6level_id='$akun_id' and transaksi_id=$tran_id")->result_array();
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
            'a6level_id' => $a6level_id,
            'posisi_akun' => $posisi,
            'debet' => $debet,
            'kredit' => $kredit,
            'jumlah' => $jumlah
        );
        $this->db2->insert('detail_transaksis', $data);
    }
    public function ubahdetail($id)
    {
        $a6level_id = $this->input->post('a6level_id');
        $posisi = $this->input->post('posisi_akun');
        $jumlah = input_uang($this->input->post('jumlah'));
        if ($posisi == "D") {
            $debet = $jumlah;
            $kredit = 0;
        } else {
            $debet = 0;
            $kredit = $jumlah;
        }
        $data = array(
            'a6level_id' => $a6level_id,
            'posisi_akun' => $posisi,
            'debet' => $debet,
            'kredit' => $kredit,
            'jumlah' => $jumlah
        );
        $this->db2->where('id', $id);
        $this->db2->update('detail_transaksis', $data);
    }
    public function simpandetail()
    {
        $tran_id = $this->input->post('transaksi_id');
        $a6level_id = $this->input->post('a6level_id');
        $posisi = $this->input->post('posisi_akun');
        $jumlah = input_uang($this->input->post('jumlah'));
        if ($posisi == "D") {
            $debet = $jumlah;
            $kredit = 0;
        } else {
            $debet = 0;
            $kredit = $jumlah;
        }
        $data = array(
            'transaksi_id' => $tran_id,
            'a6level_id' => $a6level_id,
            'posisi_akun' => $posisi,
            'debet' => $debet,
            'kredit' => $kredit,
            'jumlah' => $jumlah
        );
        $this->db2->insert('detail_transaksis', $data);
    }
    public function hapusdetailtransaksi($id)
    {
        $this->db2->delete('detail_transaksis', ['id' => $id]);
    }
    public function cektotaltransaksi($id)
    {
        return $this->db2->query("Select sum(debet)as debet,sum(kredit) as kredit from detail_transaksis where transaksi_id=$id group by transaksi_id")->row_array();
    }
    public function selesaitransaksi($id)
    {
        $data = array(
            'is_valid' => 1
        );
        $this->db2->where('id', $id);
        $this->db2->update('transaksis', $data);
    }

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
