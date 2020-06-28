<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// --------------- akuntansi -----------------------------
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['tahunbuku'] = 'akuntansi/tahunbuku';
$route['tahunanggaran'] = 'akuntansi/tahunanggaran';
$route['pembukuanaktif'] = 'akuntansi/pembukuanaktif';
$route['kodeperkiraan'] = 'akuntansi/kodeperkiraan';
$route['akunanggaran'] = 'akuntansi/akunanggaran';
$route['jenistransaksi'] = 'akuntansi/jenistransaksi';
$route['saldoawal'] = 'akuntansi/saldoawal';
$route['laporan'] = 'akuntansi/laporan';
$route['jurnal'] = 'akuntansi/jurnal';
$route['neracasaldo'] = 'akuntansi/neracasaldo';
$route['bukubesar'] = 'akuntansi/bukubesar';
$route['neraca'] = 'akuntansi/neraca';
$route['activitas'] = 'akuntansi/activitas';
$route['perubahanaset'] = 'akuntansi/perubahanaset';
$route['perubahanarus'] = 'akuntansi/perubahanarus';
$route['rapb'] = 'akuntansi/rapb';
$route['catatan'] = 'akuntansi/catatan';
// --------------- Transaksi -----------------------------
// $route['kasmasuk1'] = 'akuntansi/transaksi/kasmasuk';
$route['kasmasuk'] = 'akuntansi/kasmasuk';
$route['kaskeluar'] = 'akuntansi/kaskeluar';
$route['bankmasuk'] = 'akuntansi/bankmasuk';
$route['bankkeluar'] = 'akuntansi/bankkeluar';
$route['nonkasbank'] = 'akuntansi/nonkasbank';
// $route['bankkeluar'] = 'akuntansi/bankkeluar';
// --------------- akademik -----------------------------
$route['angkatan'] = 'akademik/angkatan';
$route['jenjang'] = 'akademik/jenjang';
$route['jalur'] = 'akademik/jalur';
$route['semester'] = 'akademik/semester';
$route['jurusan'] = 'akademik/jurusan';
$route['tingkat'] = 'akademik/tingkat';
$route['prodi'] = 'akademik/prodi';
$route['tahunakademik'] = 'akademik/tahunakademik';
$route['periodeakademik'] = 'akademik/periodeakademik';
$route['detailtahunajaran'] = 'akademik/detailtahunajaran';
$route['mahasiswa'] = 'akademik/mahasiswa';
$route['kelas'] = 'akademik/kelas';
$route['kelasaktif'] = 'akademik/kelasaktif';
$route['detailkelas'] = 'akademik/kelas/detail';
$route['tahunajaran'] = 'akademik/tahunajaran';
$route['komponenbop'] = 'akademik/komponenbop';
$route['bop'] = 'akademik/bop';
// $route['aturbop'] = 'akademik/aturbop';
$route['opm'] = 'akademik/opm';
$route['operasional'] = 'akademik/operasional';
$route['opm/data/(:any)'] = 'akademik/opm/data/$1';
// $route['opm/ceksaldo/(:any)'] = 'akademik/opm/data/$1';
// --------------- operasional -----------------------------
$route['kewajiban'] = 'operasional/kewajiban';
// $route['aturbayar'] = 'operasional/aturbayar';
//$route['kewajiban/akun'] = 'operasional/kewajiban/akun';
