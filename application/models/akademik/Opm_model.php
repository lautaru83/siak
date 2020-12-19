<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Opm_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->db2 = $this->load->database('akuntansi', TRUE);
        //$this->db2 = $this->load->database('akuntansi', TRUE);
    }
    public function cektranuser($jurnal)
    {
        $user_id = $this->session->userdata('xyz');
        $perak_id = $this->session->userdata('idPerak');
        return $this->db3->get_where('operasionals', ['perak_id' => $perak_id, 'jurnal' => $jurnal, 'user_id' => $user_id, 'is_valid' => 0])->row_array();
    }
    public function cek_detail_operasional_id($id)
    {
        return $this->db3->get_where('detail_operasionals', ['operasional_id' => $id])->num_rows();
    }
    public function cek_nobukti($nobukti)
    {
        $valid = 1;
        return $this->db3->get_where('operasionals', ['nobukti' => $nobukti, 'is_valid' => $valid])->num_rows();
    }
    public function daftarakunopm($kelas_id, $perak_id, $jenis)
    {
        $institusi_id = $this->session->userdata['idInstitusi'];
        if ($jenis == "R") {
            return $this->db2->query("SELECT a.idpembayaran AS idpembayaran,a.a6level_id AS a6level_id, b.level6 AS level6 FROM siak_akademik.view_bops a JOIN siak_akuntansi.view_kodeperkiraans b ON b.a6level_id = a.a6level_id WHERE a.kelas_id = '$kelas_id' AND a.institusi_id=$institusi_id AND a.perak_id='$perak_id' AND b.a3level_id IN('111','211','212') ORDER BY a.idpembayaran, a.a6level_id ASC")->result_array();
        } elseif ($jenis == "P") {
            return $this->db2->query("SELECT a.idpembayaran AS idpembayaran,a.a6level_id AS a6level_id, b.level6 AS level6 FROM siak_akademik.view_bops a JOIN siak_akuntansi.view_kodeperkiraans b ON b.a6level_id = a.a6level_id WHERE a.kelas_id = '$kelas_id' AND a.institusi_id=$institusi_id AND a.perak_id='$perak_id' AND b.a2level_id IN('110','210') ORDER BY a.idpembayaran, a.a6level_id ASC")->result_array();
        } elseif ($jenis == "D") {
            return $this->db2->query("SELECT a.idpembayaran AS idpembayaran,a.a6level_id AS a6level_id, b.level6 AS level6 FROM siak_akademik.view_bops a JOIN siak_akuntansi.view_kodeperkiraans b ON b.a6level_id = a.a6level_id WHERE a.kelas_id = '$kelas_id' AND a.institusi_id=$institusi_id AND a.perak_id='$perak_id' AND b.a3level_id IN('111','211','411') ORDER BY a.idpembayaran, a.a6level_id ASC")->result_array();
        } else {
            return null;
        }
    }
    public function daftarakunopm2($kelas_id, $perak_id)
    {
        $institusi_id = $this->session->userdata['idInstitusi'];
        return $this->db2->query("SELECT a.idpembayaran AS idpembayaran,a.a6level_id AS a6level_id, b.level6 AS level6 FROM siak_akademik.view_bops a JOIN siak_akuntansi.view_kodeperkiraans b ON b.a6level_id = a.a6level_id WHERE a.kelas_id = '$kelas_id' AND a.institusi_id=$institusi_id AND a.perak_id='$perak_id' ORDER BY a.a6level_id ASC")->result_array();
    }
    public function detailtransaksi($id)
    {
        $operasional_id = $id;
        //return $this->db3->get_where('detail_operasionals', ['operasional_id' => $operasional_id])->result_array();
        return $this->db3->query("SELECT a.id AS id, a.operasional_id AS operasional_id, a.detailbop_id AS detailbop_id, a.a6level_id AS a6level_id, b.level6 AS level6, a.posisi_akun AS posisi_akun, a.jumlah AS jumlah, a.debet AS debet, a.kredit AS kredit, a.is_anggaran AS is_anggaran FROM siak_akademik.detail_operasionals a JOIN siak_akuntansi.a6levels b ON b.id = a.a6level_id WHERE a.operasional_id = $operasional_id ORDER BY a.id ASC")->result_array();
    }
    public function danasurplus($mahasiswa_id)
    {
        $totalsurplus = 0.00;
        $jmldebet = 0.00;
        $jmlkredit = 0.00;
        $perak_id = $this->session->userdata['idPerak'];
        $danasurplus = $this->db3->query("SELECT sum(debet) AS debet, sum(kredit) AS kredit FROM operasionals a JOIN detail_operasionals b ON a.id = b.operasional_id JOIN detailbops c ON c.id = b.detailbop_id JOIN kewajibans d ON d.id = c.kewajiban_id WHERE perak_id = '$perak_id' AND a.mahasiswa_id =$mahasiswa_id AND d.jenis = 'L' and is_valid IN('1','2','3') group by a.perak_id")->row_array();
        if ($danasurplus) {
            $jmldebet = $danasurplus['debet'];
            $jmlkredit = $danasurplus['kredit'];
            $totalsurplus = $jmlkredit - $jmldebet;
        } else {
            $totalsurplus = 0;
        }
        return $totalsurplus;
    }
    public function trandanasurplus($mahasiswa_id)
    {
        $totalsurplus = 0.00;
        $jmldebet = 0.00;
        $jmlkredit = 0.00;
        $perak_id = $this->session->userdata['idPerak'];
        $danasurplus = $this->db3->query("SELECT sum(debet) AS debet, sum(kredit) AS kredit FROM operasionals a JOIN detail_operasionals b ON a.id = b.operasional_id JOIN detailbops c ON c.id = b.detailbop_id JOIN kewajibans d ON d.id = c.kewajiban_id WHERE perak_id = '$perak_id' AND a.mahasiswa_id ='$mahasiswa_id' AND d.jenis = 'L' and is_valid=0 group by a.perak_id")->row_array();
        if ($danasurplus) {
            $jmldebet = $danasurplus['debet'];
            $jmlkredit = $danasurplus['kredit'];
            $totalsurplus = $jmlkredit - $jmldebet;
        } else {
            $totalsurplus = 0;
        }
        return $totalsurplus;
    }
    public function piutang($mahasiswa_id)
    {
        $totalpiutang = 0.00;
        $jmldebet = 0.00;
        $jmlkredit = 0.00;
        $perak_id = $this->session->userdata['idPerak'];
        $institusi_id = $this->session->userdata['idInstitusi'];
        $piutang = $this->db3->query("SELECT sum(debet) AS debet, sum(kredit) AS kredit FROM operasionals a JOIN detail_operasionals b ON a.id = b.operasional_id JOIN detailbops c ON c.id = b.detailbop_id JOIN kewajibans d ON d.id = c.kewajiban_id JOIN akunkewajibans e ON e.a6level_id = b.a6level_id WHERE perak_id = '$perak_id' AND a.mahasiswa_id ='$mahasiswa_id' AND e.posisi = 'SD' and is_valid IN('1','2','3') group by a.perak_id")->row_array();
        if ($piutang) {
            $jmldebet = $piutang['debet'];
            $jmlkredit = $piutang['kredit'];
            $totalpiutang = $jmldebet - $jmlkredit;
        } else {
            $totalpiutang = 0;
        }
        return $totalpiutang;
    }
    public function tranpiutang($mahasiswa_id)
    {
        $totalpiutang = 0.00;
        $jmldebet = 0.00;
        $jmlkredit = 0.00;
        $perak_id = $this->session->userdata['idPerak'];
        $institusi_id = $this->session->userdata['idInstitusi'];
        $piutang = $this->db3->query("SELECT sum(debet) AS debet, sum(kredit) AS kredit FROM operasionals a JOIN detail_operasionals b ON a.id = b.operasional_id JOIN detailbops c ON c.id = b.detailbop_id JOIN kewajibans d ON d.id = c.kewajiban_id JOIN akunkewajibans e ON e.a6level_id = b.a6level_id WHERE perak_id = '$perak_id' AND a.mahasiswa_id ='$mahasiswa_id' AND e.posisi = 'SD' and is_valid=0 group by a.perak_id")->row_array();
        if ($piutang) {
            $jmldebet = $piutang['debet'];
            $jmlkredit = $piutang['kredit'];
            $totalpiutang = $jmldebet - $jmlkredit;
        } else {
            $totalpiutang = 0.00;
        }
        return $totalpiutang;
    }
    public function cek_posisiakun($a6level_id)
    {
        return $this->db3->query("SELECT posisi from akunkewajibans where a6level_id='$a6level_id'")->row_array();
    }
    public function statuspembayaran($mahasiswa_id)
    {
        $perak_id = $this->session->userdata['idPerak'];
        return $this->db3->query("SELECT a.kode AS kode, a.nama_kewajiban AS nama_kewajiban, a.jumlah_kewajiban AS jumlah_kewajiban, sum(b.debet) AS debet, sum(b.kredit) AS kredit,c.posisi as posisi FROM view_detailbops a JOIN view_tranoperasionals b ON a.id = b.detailbop_id JOIN akunkewajibans c ON c.a6level_id = b.a6level_id WHERE b.mahasiswa_id = '$mahasiswa_id' AND b.perak_id = '$perak_id' AND b.jenis IN('R','D') AND c.posisi='K' AND b.is_valid IN ('1', '2', '3') GROUP BY b.detailbop_id")->result_array();
    }
    public function riwayatpembayaran($mahasiswa_id)
    {
        $perak_id = $this->session->userdata['idPerak'];
        return $this->db3->query("SELECT id,tanggal_transaksi,nobukti,notran,keterangan,total_transaksi from operasionals where perak_id='$perak_id' and mahasiswa_id='$mahasiswa_id' and is_valid IN('1','2')")->result_array();
    }

    public function cek_akunkewajiban($a6level_id)
    {
        return $this->db3->query("SELECT a.jenis as jenis,b.posisi as posisi from kewajibans a join akunkewajibans b on a.id=b.kewajiban_id where b.a6level_id='$a6level_id'")->row_array();
    }
    public function ambil_detail_dbop($id)
    {
        return $this->db3->query("SELECT a.jumlah AS jumlah, b.jenis AS jenis,c.posisi as posisi FROM detailbops AS a INNER JOIN kewajibans AS b ON b.id = a.kewajiban_id join akunkewajibans c ON b.id=c.kewajiban_id WHERE a.id =$id")->row_array();
    }
    public function ceksaldoreguler($a6level_id)
    {
        $perak_id = $this->session->userdata('idPerak');
        $mahasiswa_id = $this->input->post('mahasiswa_id');
        $tgl1 = tanggal_input($this->session->userdata('semester_awal'));
        $tgl2 = tanggal_input($this->input->post('tanggal_transaksi'));
        return $this->db3->query("SELECT a.kodekewajiban as kode,b.jumlah as jumlahkewajiban,a.posakun as posakun,sum(a.debet)as debet,sum(a.kredit) as kredit from view_detailoperasionals a join detailbops b ON b.id=a.detailbop_id where a.a6level_id='$a6level_id' AND a.jenistransaksi IN('R','D') AND a.mahasiswa_id='$mahasiswa_id' AND a.perak_id='$perak_id' AND a.is_valid IN('1','2','3') AND a.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' GROUP BY a.a6level_id")->row_array();
    }
    public function ceksaldoperantara($a6level_id)
    {
        $perak_id = $this->session->userdata('idPerak');
        $mahasiswa_id = $this->input->post('mahasiswa_id');
        $tgl1 = tanggal_input($this->session->userdata('semester_awal'));
        $tgl2 = tanggal_input($this->input->post('tanggal_transaksi'));
        return $this->db3->query("SELECT a.kodekewajiban as kode,b.jumlah as jumlahkewajiban,a.posakun as posakun,sum(a.debet)as debet,sum(a.kredit) as kredit from view_detailoperasionals a join detailbops b ON b.id=a.detailbop_id where a.a6level_id='$a6level_id' AND a.jenistransaksi IN('R','D','P') AND a.mahasiswa_id='$mahasiswa_id' AND perak_id='$perak_id' AND a.is_valid IN('1','2','3') AND a.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' GROUP BY a.a6level_id")->row_array();
    }
    public function ceksaldopiutang($a6level_id)
    {
        $perak_id = $this->session->userdata('idPerak');
        $mahasiswa_id = $this->input->post('mahasiswa_id');
        $tgl1 = tanggal_input($this->session->userdata('semester_awal'));
        $tgl2 = tanggal_input($this->input->post('tanggal_transaksi'));
        return $this->db3->query("SELECT a.kodekewajiban as kode,b.jumlah as jumlahkewajiban,a.posakun as posakun,sum(a.debet)as debet,sum(a.kredit) as kredit from view_detailoperasionals a join detailbops b ON b.id=a.detailbop_id where a.a6level_id='$a6level_id' AND a.jenistransaksi='P' AND a.mahasiswa_id='$mahasiswa_id' AND a.perak_id='$perak_id' AND a.is_valid IN('1','2','3') AND a.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' GROUP BY a.a6level_id")->row_array();
    }
    public function ceksaldoreguler2($a6level_id)
    {
        $perak_id = $this->session->userdata('idPerak');
        $mahasiswa_id = 23;
        $tgl1 = tanggal_input($this->session->userdata('semester_awal'));
        $tgl2 = "2020-01-10";
        return $this->db3->query("SELECT a.kodekewajiban kode,b.jumlah as jumlahkewajiban,a.posakun as posakun,sum(a.debet)as debet,sum(a.kredit) as kredit from view_detailoperasionals a join detailbops b ON b.id=a.detailbop_id where a.a6level_id='$a6level_id' AND a.jenistransaksi IN('R','D') AND a.mahasiswa_id='$mahasiswa_id' AND a.perak_id='$perak_id' AND a.is_valid IN('1','2','3') AND a.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' GROUP BY a.a6level_id")->row_array();
    }
    public function ceksaldoperantara2($a6level_id)
    {
        $perak_id = $this->session->userdata('idPerak');
        $mahasiswa_id = 23;
        $tgl1 = tanggal_input($this->session->userdata('semester_awal'));
        $tgl2 = "2020-01-10";
        return $this->db3->query("SELECT a.kodekewajiban as kode,b.jumlah as jumlahkewajiban,a.posakun as posakun,sum(a.debet)as debet,sum(a.kredit) as kredit from view_detailoperasionals a join detailbops b ON b.id=a.detailbop_id where a.a6level_id='$a6level_id' AND a.jenistransaksi IN('R','D','P') AND a.mahasiswa_id='$mahasiswa_id' AND a.perak_id='$perak_id' AND a.is_valid IN('1','2','3') AND a.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' GROUP BY a.a6level_id")->row_array();
    }
    public function ceksaldopiutang2($a6level_id)
    {
        $perak_id = $this->session->userdata('idPerak');
        $mahasiswa_id = 23;
        $tgl1 = tanggal_input($this->session->userdata('semester_awal'));
        $tgl2 = "2020-01-10";
        return $this->db3->query("SELECT a.kodekewajiban as kode,b.jumlah as jumlahkewajiban,a.posakun as posakun,sum(a.debet)as debet,sum(a.kredit) as kredit from view_detailoperasionals a join detailbops b ON b.id=a.detailbop_id where a.a6level_id='$a6level_id' AND a.jenistransaksi='P' AND a.mahasiswa_id='$mahasiswa_id' AND a.perak_id='$perak_id' AND a.is_valid IN('1','2','3') AND a.tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' GROUP BY a.a6level_id")->row_array();
    }
    public function cek_akun6_dopm($op_id, $a6_id)
    {
        //cek kodeperkiraan  untuk validasi
        return $this->db3->query("select * from detail_operasionals where operasional_id=$op_id and a6level_id='$a6_id'")->num_rows();
    }
    public function cek_bop_dopm($op_id, $dbop_id)
    {
        //cek komponen kewajiban untuk validasi
        return $this->db3->query("select * from detail_operasionals where operasional_id=$op_id and detailbop_id=$dbop_id")->num_rows();
    }
    public function ambil_detailoperasional_id($id)
    {
        return $this->db3->get_where('detail_operasionals', ['id' => $id])->row_array();
    }
    public function riwayat_transaksi($jurnal)
    {
        $user_id = $this->session->userdata('xyz');
        return $this->db2->query("SELECT * FROM transaksis where jurnal='$jurnal' and is_valid=1 and user_id=$user_id order by id desc LIMIT 0, 5 ")->result_array();
    }
    // public function ceksaldotransaksi($akun_id)
    // {
    //     $tahun_buku = $this->session->userdata('tahun_buku');
    //     $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
    //     $tgl2 = tanggal_input($this->input->post('tgl2'));
    //     return $this->db2->query("select a6level_id,level6,posisi,tanggal_transaksi,sum(debet) as debet,sum(kredit) as kredit from view_detailtransaksis WHERE a6level_id='$akun_id' AND is_valid BETWEEN 1 AND 2  AND tahun_buku='$tahun_buku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' GROUP BY a6level_id")->result_array();
    // }
    public function simpan()
    {
        $tahun_buku = $this->session->userdata('tahun_buku');
        $accounting = $this->session->userdata('nama_user');
        $user_id = $this->session->userdata('xyz');
        $unit_id = $this->input->post('unit_id');
        $perak_id = $this->session->userdata('idPerak');
        $jurnal = $this->input->post('jurnal');
        $noref = $this->input->post('noref');
        $jenis = $this->input->post('jenis');
        $notran = no_tran($jurnal);
        $tanggal_transaksi = tanggal_input($this->input->post('tanggal_transaksi'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $nobukti = htmlspecialchars($this->input->post('nobukti'));
        $mahasiswa_id = $this->input->post('mahasiswa_id');
        $data = array(
            'perak_id' => $perak_id,
            'jurnal' => $jurnal,
            'notran' => $notran,
            'jenis' => $jenis,
            'nobukti' => $nobukti,
            'noref' => $noref,
            'tanggal_transaksi' => $tanggal_transaksi,
            'accounting' => $accounting,
            'keterangan' => $keterangan,
            'unit_id' => $unit_id,
            'total_transaksi' => 0,
            'is_valid' => 0,
            'user_id' => $user_id,
            'mahasiswa_id' => $mahasiswa_id
        );
        $this->db3->insert('operasionals', $data);
        $data2 = array(
            'tahun_buku' => $tahun_buku,
            'jurnal' => $jurnal,
            'notran' => $notran,
            'nobukti' => $nobukti,
            'noref' => $noref,
            'tanggal_transaksi' => $tanggal_transaksi,
            'accounting' => $accounting,
            'keterangan' => $keterangan,
            'unit_id' => $unit_id,
            'total_transaksi' => 0,
            'is_valid' => 0,
            'user_id' => $user_id
        );
        $this->db2->insert('transaksis', $data2);
    }
    public function ubah($idtran)
    {
        // $accounting = $this->session->userdata('nama_user');
        // $user_id = $this->session->userdata('xyz');
        // $unit_id = $this->input->post('unit_id');
        // $perak_id = $this->session->userdata('idPerak');
        // $jurnal = $this->input->post('jurnal');
        $noref = $this->input->post('noref');
        $jenis = $this->input->post('jenis');
        $notran = $this->input->post('notran');
        $tanggal_transaksi = tanggal_input($this->input->post('tanggal_transaksi'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $nobukti = htmlspecialchars($this->input->post('nobukti'));
        // $mahasiswa_id = $this->input->post('mahasiswa_id');
        $data = array(
            'tanggal_transaksi' => $tanggal_transaksi,
            'nobukti' => $nobukti,
            'noref' => $noref,
            'jenis' => $jenis,
            'keterangan' => $keterangan
        );
        $this->db3->where('id', $idtran);
        $this->db3->update('operasionals', $data);
        $data2 = array(
            'tanggal_transaksi' => $tanggal_transaksi,
            'nobukti' => $nobukti,
            'noref' => $noref,
            'keterangan' => $keterangan
        );
        $this->db2->where('notran', $notran);
        $this->db2->update('transaksis', $data2);
    }
    public function bataltransaksi()
    {
        $id_operasional = $this->input->post('operasional_id');
        $notran = $this->input->post('notran');
        $is_valid = 0;
        $this->db3->where('id', $id_operasional);
        $this->db3->where('is_valid', $is_valid);
        $this->db3->delete('operasionals');
        $this->db3->where('operasional_id', $id_operasional);
        $this->db3->delete('detail_operasionals');
        $hasil = $this->db2->get_where('transaksis', ['notran' => $notran])->row_array();
        if ($hasil) {
            $id_transaksi = $hasil['id'];
            $this->db2->where('id', $id_transaksi);
            $this->db2->delete('transaksis');
            $this->db2->where('transaksi_id', $id_transaksi);
            $this->db2->delete('detail_transaksis');
        }
    }
    public function simpandetail()
    {
        $akun = explode("/", $this->input->post('akun_id'));
        $detailbop_id = $akun[0];
        $a6level_id = $akun[1];
        $operasional_id = $this->input->post('operasional_id');
        $posisi_akun = $this->input->post('posisi_akun');
        $notran = $this->input->post('notran');
        $jumlah = input_uang($this->input->post('jumlah'));
        $is_anggaran = $this->input->post('is_anggaran');
        $is_saldo = 0;
        $posisiakunbop = $this->db3->query("SELECT posisi FROM akunkewajibans where a6level_id='$a6level_id'")->row_array();
        if ($posisiakunbop) {
            if ($posisiakunbop == "SD") {
                $is_saldo = 1;
            } elseif ($posisiakunbop == "SK") {
                $is_saldo = 1;
            } else {
                $is_saldo = 0;
            }
        }
        if ($posisi_akun == "D") {
            $debet = $jumlah;
            $kredit = 0;
        } else {
            $debet = 0;
            $kredit = $jumlah;
        }
        $data = array(
            'detailbop_id' => $detailbop_id,
            'operasional_id' => $operasional_id,
            'a6level_id' => $a6level_id,
            'posisi_akun' => $posisi_akun,
            'jumlah' => $jumlah,
            'debet' => $debet,
            'kredit' => $kredit,
            'is_anggaran' => $is_anggaran,
            'is_saldo' => $is_saldo
        );
        $this->db3->insert('detail_operasionals', $data);
        $hasil = $this->db2->get_where('transaksis', ['notran' => $notran])->row_array();
        if ($hasil) {
            $idTransaksi = $hasil['id'];
            $data2 = array(
                'transaksi_id' => $idTransaksi,
                'a6level_id' => $a6level_id,
                'posisi_akun' => $posisi_akun,
                'jumlah' => $jumlah,
                'debet' => $debet,
                'kredit' => $kredit,
                'is_anggaran' => $is_anggaran
            );
            $this->db2->insert('detail_transaksis', $data2);
        }
    }
    public function ubahdetail($id)
    {
        $id_detailoperasional = $id;
        $akun = explode("/", $this->input->post('akun_id'));
        $detailbop_id = $akun[0];
        $a6level_id = $akun[1];
        $akun_lama = $this->input->post('akun_lama');
        //$operasional_id = $this->input->post('operasional_id');
        $posisi_akun = $this->input->post('posisi_akun');
        $notran = $this->input->post('notran');
        $jumlah = input_uang($this->input->post('jumlah'));
        $is_anggaran = $this->input->post('is_anggaran');
        $is_saldo = 0;
        $posisiakunbop = $this->db3->query("SELECT posisi FROM akunkewajibans where a6level_id='$a6level_id'")->row_array();
        if ($posisiakunbop) {
            $posisi = $posisiakunbop['posisi'];
            if ($posisi == "SD") {
                $is_saldo = 1;
            } elseif ($posisi == "SK") {
                $is_saldo = 1;
            } else {
                $is_saldo = 0;
            }
        }
        if ($posisi_akun == "D") {
            $debet = $jumlah;
            $kredit = 0;
        } else {
            $debet = 0;
            $kredit = $jumlah;
        }
        $data = array(
            'detailbop_id' => $detailbop_id,
            //'operasional_id' => $operasional_id,
            'a6level_id' => $a6level_id,
            'posisi_akun' => $posisi_akun,
            'jumlah' => $jumlah,
            'debet' => $debet,
            'kredit' => $kredit,
            'is_anggaran' => $is_anggaran,
            'is_saldo' => $is_saldo
        );
        // $this->db3->insert('detail_operasionals', $data);
        $this->db3->where('id', $id_detailoperasional);
        $this->db3->update('detail_operasionals', $data);
        $hasil = $this->db2->get_where('transaksis', ['notran' => $notran])->row_array();
        if ($hasil) {
            $idTransaksi = $hasil['id'];
            $dtransaksi = $this->db2->query("SELECT id FROM detail_transaksis where transaksi_id=$idTransaksi AND a6level_id='$akun_lama'")->row_array();
            if ($dtransaksi) {
                $id_detailtransaksi = $dtransaksi['id'];
                $data2 = array(
                    'a6level_id' => $a6level_id,
                    'posisi_akun' => $posisi_akun,
                    'jumlah' => $jumlah,
                    'debet' => $debet,
                    'kredit' => $kredit,
                    'is_anggaran' => $is_anggaran
                );
                $this->db2->where('id', $id_detailtransaksi);
                $this->db2->update('detail_transaksis', $data2);
            }
        }
    }
    public function hapusdetail()
    {
        $id = $this->input->post('id'); //id detail operasional
        $notran = $this->input->post('notran');
        $a6level_id = $this->input->post('a6level_id');
        $this->db3->delete('detail_operasionals', ['id' => $id]);
        $hasil = $this->db2->get_where('transaksis', ['notran' => $notran])->row_array();
        if ($hasil) {
            $idTransaksi = $hasil['id'];
            $this->db2->delete('detail_transaksis', ['transaksi_id' => $idTransaksi, 'a6level_id' => $a6level_id]);
        }
    }
    public function cektotaltransaksi($id)
    {
        return $this->db3->query("Select sum(debet)as debet,sum(kredit) as kredit from detail_operasionals where operasional_id=$id group by operasional_id")->row_array();
    }
    public function selesaitransaksi()
    {
        $operasional_id = $this->input->post('operasional_id');
        $total = $this->input->post('total_transaksi');
        $notran = $this->input->post('notran');
        $data = array(
            'is_valid' => 1,
            'total_transaksi' => $total
        );
        $this->db3->where('id', $operasional_id);
        $this->db3->update('operasionals', $data);
        $hasil = $this->db2->get_where('transaksis', ['notran' => $notran])->row_array();
        if ($hasil) {
            $transaksi_id = $hasil['id'];
            $data2 = array(
                'is_valid' => 1,
                'total_transaksi' => $total
            );
            $this->db2->where('id', $transaksi_id);
            $this->db2->update('transaksis', $data2);
        }
        //return "ok";
    }
}
