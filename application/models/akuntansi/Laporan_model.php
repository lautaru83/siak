<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Laporan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('akuntansi', TRUE);

        $pembukuan_id = $this->session->userdata('tahun_buku');
        //$this->db2 = $this->load->database('akuntansi', TRUE);
    }
    public function jurnal()
    {
        $jurnal = $this->input->post('jurnal');
        $tgl1 = tanggal_input($this->input->post('awal_periode'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        if (!$jurnal) {
            return $this->db2->query("select a.id as id,a.tanggal_transaksi as tanggal,a.nobukti as nobukti,a.keterangan as keterangan,a.accounting as accounting from siak_akuntansi.transaksis a join siak_setting.units b on b.id=a.unit_id where a.tanggal_transaksi BETWEEN '$tgl1' and '$tgl2' and b.id='$institusi_id' and a.tahun_buku='$thbuku' and a.is_valid=1 order by a.tanggal_transaksi asc")->result_array();
        } else {
            return $this->db2->query("select a.id as id,a.tanggal_transaksi as tanggal,a.nobukti as nobukti,a.keterangan as keterangan,a.accounting as accounting from siak_akuntansi.transaksis a join siak_setting.units b on b.id=a.unit_id where a.tanggal_transaksi BETWEEN '$tgl1' and '$tgl2' and b.id='$institusi_id' and a.tahun_buku='$thbuku' and a.jurnal='$jurnal' and a.is_valid=1 order by a.tanggal_transaksi asc")->result_array();
        }
    }
    public function detailjurnal($id)
    {
        return $this->db2->get_where('detail_transaksis', ['transaksi_id' => $id])->result_array();
    }
    public function neracasaldo()
    {
        $tgl1 = $this->session->userdata('buku_awal');
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.id as id,a.level6 as level6,a.posisi as posisi,a.institusi_id as institusi_id,c.tanggal_transaksi as tanggal_transaksi,SUM(b.debet) as debet,SUM(b.kredit) as kredit,c.is_valid as is_valid,c.jurnal as jurnal FROM a6levels a JOIN detail_transaksis b  ON a.id = b.a6level_id JOIN transaksis c ON c.id = b.transaksi_id WHERE a.institusi_id='$institusi_id' AND c.tahun_buku='$thbuku' AND c.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND  c.is_valid BETWEEN 1 AND 2 GROUP BY a.id ORDER BY a.id ASC
        ")->result_array();
    }
    public function bukubesar()
    {
        $tgl1 = tanggal_input($this->input->post('awal_periode'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $akun_id = $this->input->post('a6level_id');
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.id as id,a.level6 as level6,a.posisi as posisi,a.institusi_id as institusi_id,c.tanggal_transaksi as tanggal_transaksi,b.debet as debet,b.kredit as kredit,c.is_valid as is_valid,c.jurnal as jurnal,c.nobukti as nobukti,c.keterangan as keterangan FROM a6levels a JOIN detail_transaksis b  ON a.id = b.a6level_id JOIN transaksis c ON c.id = b.transaksi_id WHERE a.institusi_id='$institusi_id' AND a.id='$akun_id' AND c.tahun_buku='$thbuku' AND c.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND  c.is_valid BETWEEN 1 AND 2 ORDER BY c.tanggal_transaksi ASC
        ")->result_array();
    }

    // -------------------------------------NERACA INST------------------------------------
    public function asetLancarInstitusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='110' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function asetTidakLancarInstitusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='120' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function kewajibanInstitusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='210' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function bersihTidakTerikatInstitusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='310' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function bersihTerikatInstitusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='320' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    // ------------------------------------/NERACA  INS----------------------------------------

    // -------------------------------------AKTIVITAS INST------------------------------------
    public function pttbInstitusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='110' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function baduInstitusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='120' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function bpdpInstitusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='210' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function bpdaInstitusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='310' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function pbnoInstitusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='320' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    // ------------------------------------/AKTIVITAS  INS----------------------------------------







    // public function cektranuser($jurnal)
    // {
    //     $user_id = $this->session->userdata('xyz');
    //     $thbuku_id = $this->session->userdata('tahun_buku');
    //     return $this->db2->get_where('transaksis', ['tahun_buku' => $thbuku_id, 'jurnal' => $jurnal, 'user_id' => $user_id, 'is_valid' => 0])->row_array();
    // }
    // public function ambil_data_id5($id)
    // {
    //     return $this->db2->get_where('a5levels', ['id' => $id])->row_array();
    // }
    // public function akunjurnal($jenis)
    // {
    //     $idinstitusi = $this->session->userdata('idInstitusi');
    //     return $this->db2->query("select a.id as id,a.level6 as level6 from a6levels a join akun_transaksis b on a.id=b.a6level_id where b.jenis_transaksi_id='$jenis' and a.institusi_id='$idinstitusi' ")->result_array();
    // }



}
