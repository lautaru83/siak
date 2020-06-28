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
        $thbuku = $this->input->post('jt_pembukuan_id');
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
        // $tgl1 = $this->session->userdata('buku_awal');
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->input->post('tahunbuku');
        return $this->db2->query("SELECT a.id as id,a.level6 as level6,a.posisi as posisi,a.institusi_id as institusi_id,c.tanggal_transaksi as tanggal_transaksi,SUM(b.debet) as debet,SUM(b.kredit) as kredit,c.is_valid as is_valid,c.jurnal as jurnal FROM a6levels a JOIN detail_transaksis b  ON a.id = b.a6level_id JOIN transaksis c ON c.id = b.transaksi_id WHERE a.institusi_id='$institusi_id' AND c.tahun_buku='$thbuku' AND c.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND  c.is_valid IN ('1','2','3') GROUP BY a.id ORDER BY a.id ASC
        ")->result_array();
    }
    public function bukubesar()
    {
        $tgl1 = tanggal_input($this->input->post('awal_periode'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $akun_id = $this->input->post('a6level_id');
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->input->post('tahunbuku');
        return $this->db2->query("SELECT a.id as id,a.level6 as level6,a.posisi as posisi,a.institusi_id as institusi_id,c.tanggal_transaksi as tanggal_transaksi,b.debet as debet,b.kredit as kredit,c.is_valid as is_valid,c.jurnal as jurnal,c.nobukti as nobukti,c.keterangan as keterangan FROM a6levels a JOIN detail_transaksis b  ON a.id = b.a6level_id JOIN transaksis c ON c.id = b.transaksi_id WHERE a.institusi_id='$institusi_id' AND a.id='$akun_id' AND c.tahun_buku='$thbuku' AND  c.is_valid IN('1','2','3') AND c.jurnal!='SA' AND c.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ORDER BY c.tanggal_transaksi,c.notran ASC
        ")->result_array();
    }
    // -------------------------------------NERACA INST------------------------------------
    public function asetLancarInstitusi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='110' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function asetLancarKomInstitusi()
    {
        // $tgl1 = tanggal_input($this->session->userdata['buku_awal']);
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $tahunbuku = $this->session->userdata['tahun_buku'];
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a2level_id = '110' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a2level_id = '110' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function asetLancarKonsolidasi()
    {
        // $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // //$institusi_id = $this->session->userdata('idInstitusi');
        // $thbuku = $this->session->userdata('tahun_buku');
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='110' AND b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function asetLancarKomKonsolidasi()
    {
        // $tgl1 = tanggal_input($this->session->userdata['buku_awal']);
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $tahunbuku = $this->session->userdata['tahun_buku'];
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a2level_id = '110' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a2level_id = '110' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function asetTidakLancarInstitusi()
    {
        // $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $thbuku = $this->session->userdata('tahun_buku');
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='120' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function asetTidakLancarKomInstitusi()
    {
        // $tgl1 = tanggal_input($this->session->userdata['buku_awal']);
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $tahunbuku = $this->session->userdata['tahun_buku'];
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a2level_id = '120' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a2level_id = '120' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function asetTidakLancarKonsolidasi()
    {
        // $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $thbuku = $this->session->userdata('tahun_buku');
        //$institusi_id = $this->session->userdata('idInstitusi');
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='120' AND b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function asetTidakLancarKomKonsolidasi()
    {
        // $tgl1 = tanggal_input($this->session->userdata['buku_awal']);
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $tahunbuku = $this->session->userdata['tahun_buku'];
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a2level_id = '120' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a2level_id = '120' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function kewajibanInstitusi()
    {
        // $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $thbuku = $this->session->userdata('tahun_buku');
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='210' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function kewajibanKomInstitusi()
    {
        // $tgl1 = tanggal_input($this->session->userdata['buku_awal']);
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $tahunbuku = $this->session->userdata['tahun_buku'];
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a2level_id = '210' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a2level_id = '210' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function kewajibanKonsolidasi()
    {
        // $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $thbuku = $this->session->userdata('tahun_buku');
        // $institusi_id = $this->session->userdata('idInstitusi');
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='210' AND b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function kewajibanKomKonsolidasi()
    {
        // $tgl1 = tanggal_input($this->session->userdata['buku_awal']);
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $tahunbuku = $this->session->userdata['tahun_buku'];
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a2level_id = '210' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a2level_id = '210' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function bersihTidakTerikatInstitusi()
    {
        // $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $thbuku = $this->session->userdata('tahun_buku');
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='310' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function bersihTidakTerikatKomInstitusi()
    {
        // $tgl1 = tanggal_input($this->session->userdata['buku_awal']);
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $tahunbuku = $this->session->userdata['tahun_buku'];
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a2level_id = '310' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a2level_id = '310' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function bersihTidakTerikatKonsolidasi()
    {
        // $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $thbuku = $this->session->userdata('tahun_buku');
        //$institusi_id = $this->session->userdata('idInstitusi');
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='310' AND b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function bersihTidakTerikatKomKonsolidasi()
    {
        // $tgl1 = tanggal_input($this->session->userdata['buku_awal']);
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $tahunbuku = $this->session->userdata['tahun_buku'];
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE 
        a2level_id = '310' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a2level_id = '310' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function bersihTerikatInstitusi()
    {
        // $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $thbuku = $this->session->userdata('tahun_buku');
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='320' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function bersihTerikatKomInstitusi()
    {
        // $tgl1 = tanggal_input($this->session->userdata['buku_awal']);
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $tahunbuku = $this->session->userdata['tahun_buku'];
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a2level_id = '320' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a2level_id = '320' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function bersihTerikatKonsolidasi()
    {
        // $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        // $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        // $thbuku = $this->session->userdata('tahun_buku');
        //$institusi_id = $this->session->userdata('idInstitusi');
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='320' AND b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function bersihTerikatKomKonsolidasi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a2level_id = '320' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a2level_id = '320' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function abttTbInstitusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit,b.tanggal_transaksi as tanggal_transaksi FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a1level_id BETWEEN '400' AND '700' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY b.tahun_buku")->result_array();
    }
    public function abttTbKonsolidasi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        //$institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit,b.tanggal_transaksi as tanggal_transaksi FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a1level_id BETWEEN '400' AND '700' AND b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY b.tahun_buku")->result_array();
    }
    // ------------------------------------/NERACA  INS----------------------------------------

    // ----------------------------AKTIVITAS/PERUBAHAN ASET INST------------------------------------
    public function pttbInstitusi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a3level_id IN('411','421','511') AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function pttbKomInstitusi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a3level_id IN('411','421','511') AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a3level_id IN('411','421','511') AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function pttbKonsolidasi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        //$institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a3level_id IN('411','421','511') AND b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function pttbKomKonsolidasi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a3level_id IN('411','421','511') AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a3level_id IN('411','421','511') AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function baduInstitusi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.level4 as level4,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a3level_id='521' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 GROUP BY a.a4level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function baduKomInstitusi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level4,a4level_id,level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a3level_id='521' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a3level_id='521' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a4level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function baduKonsolidasi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        //$institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.level4 as level4,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a3level_id='521' AND b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 GROUP BY a.a4level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function baduKomKonsolidasi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level4,a4level_id,level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a3level_id='521' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a3level_id='521' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a4level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function bpdpInstitusi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a3level_id='531' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 GROUP BY b.tahun_buku")->result_array();
    }
    public function bpdpKomInstitusi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level4,a4level_id,level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a3level_id='531' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a3level_id='531' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function bpdpKonsolidasi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        //$institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a3level_id='531' AND b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 GROUP BY b.tahun_buku")->result_array();
    }
    public function bpdpKomKonsolidasi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level4,a4level_id,level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a3level_id='531' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a3level_id='531' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function bpdaInstitusi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a3level_id='541' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 GROUP BY b.tahun_buku")->result_array();
    }
    public function bpdaKomInstitusi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level4,a4level_id,level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a3level_id='541' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a3level_id='541' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function bpdaKonsolidasi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        //$institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a3level_id='541' AND b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 GROUP BY b.tahun_buku")->result_array();
    }
    public function bpdaKomKonsolidasi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level4,a4level_id,level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a3level_id='541' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a3level_id='541' AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function pbllInstitusi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id IN('610','710') AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id")->result_array();
    }
    public function pbllKomInstitusi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level2,a2level_id,level4,a4level_id,level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level2,a2level_id,level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a2level_id IN('610','710') AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level2,a2level_id,level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE institusi_id = '$institusi_id' AND a2level_id IN('610','710') AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function pbllKonsolidasi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->input->post('tahunbuku');
        //$institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id IN('610','710') AND b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id")->result_array();
    }
    public function pbllKomKonsolidasi()
    {
        $tgl1 = tanggal_input($this->input->post('awalbuku'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $tahunbuku = $this->input->post('tahunbuku');
        $format = "years";
        $jml = -1;
        $thlalu = manipulasiTahun($tgl1, $jml, $format);
        $tgl1lalu = manipulasiTanggal($tgl1, $jml, $format);
        $tgl2lalu = manipulasiTanggal($tgl2, $jml, $format);
        $institusi_id = $this->session->userdata('idInstitusi');
        return $this->db2->query("SELECT level2,a2level_id,level4,a4level_id,level3, a3level_id AS catatan_id, a6level_id, tahun_buku, posisi, sum( IF (tahun_buku = '$tahunbuku', debet, 0)) AS debetA, sum( IF (tahun_buku = '$tahunbuku', kredit, 0)) AS kreditA, sum( IF (tahun_buku = '$thlalu', debet, 0)) AS debetB, sum( IF (tahun_buku = '$thlalu', kredit, 0)) AS kreditB FROM (( SELECT level2,a2level_id,level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a2level_id IN('610','710') AND is_valid IN ('1', '2', '3') AND tahun_buku = '$tahunbuku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ) UNION ALL ( SELECT level2,a2level_id,level4,a4level_id,level3, a3level_id, a6level_id, tahun_buku, posisi, debet, kredit FROM view_alltransaksis WHERE a2level_id IN('610','710') AND is_valid IN ('1', '2', '3') AND tahun_buku = '$thlalu' AND tanggal_transaksi BETWEEN '$tgl1lalu' AND '$tgl2lalu' )) t1 GROUP BY a3level_id ORDER BY a3level_id ASC")->result_array();
    }
    public function pbnoInstitusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='320' AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function pbnoKonsolidasi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id='320' AND b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    // ------------------------------/AKTIVITAS/PERUBAHAN ASET  INS----------------------------------
    // ------------------------------/PERUBAHAN ARUS----------------------------------
    public function kasOpInstitusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a3level_id IN('112','113','114','116','117','118','119','211','212') AND b.jurnal IN('BK','BM','KK','KM','PM') AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid=1 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function kasInvesInstitusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a3level_id IN('121','122','123') AND b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid=1 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function kasOpKonsolidasi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        //$institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a3level_id IN('112','113','114','116','117','118','119','211','212') AND b.jurnal IN('BK','BM','KK','KM','PM') AND b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid=1 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    public function kasInvesKonsolidasi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        //$institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a3level_id IN('121','122','123') AND b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid=1 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a6level_id ASC ")->result_array();
    }
    // ------------------------------/PERUBAHAN ARUS ----------------------------------
    // ------------------------------/CALK ----------------------------------
    public function calkAkun3Institusi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.a1level_id as a1level_id,a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a3level_id ASC ")->result_array();
    }
    public function calkAkun6Institusi($id)
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $institusi_id = $this->session->userdata('idInstitusi');
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.a6level_id as a6level_id,a.level6 as level6, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE b.tahun_buku='$thbuku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 AND a3level_id='$id' GROUP BY a.a6level_id,b.tahun_buku ORDER BY a.a3level_id ASC ")->result_array();
    }
    public function calkAkun3Konsolidasi()
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.a1level_id as a1level_id,a.level3 as level3,a.a3level_id as catatan_id, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 GROUP BY a.a3level_id,b.tahun_buku ORDER BY a.a3level_id ASC ")->result_array();
    }
    public function calkAkun4Konsolidasi($id3)
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.a4level_id as a4level_id,a.level4 as level4, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 AND a3level_id='$id3' GROUP BY a.a4level_id,b.tahun_buku ORDER BY a.a4level_id ASC ")->result_array();
    }
    public function calkAkun5Konsolidasi($id4)
    {
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('akhir_periode'));
        $thbuku = $this->session->userdata('tahun_buku');
        return $this->db2->query("SELECT a.a5level_id as a5level_id,a.level5 as level5, a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE b.tahun_buku='$thbuku' AND b.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND b.is_valid BETWEEN 1 AND 2 AND a4level_id='$id4' GROUP BY a.a5level_id,b.tahun_buku ORDER BY a.a5level_id ASC ")->result_array();
    }
    // ------------------------------/CALK ----------------------------------

}
