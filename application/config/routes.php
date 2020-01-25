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
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['tahunbuku'] = 'akuntansi/tahunbuku';
$route['tahunanggaran'] = 'akuntansi/tahunanggaran';
$route['kodeperkiraan'] = 'akuntansi/kodeperkiraan';
$route['kodeanggaran'] = 'akuntansi/kodeanggaran';
$route['jenistransaksi'] = 'akuntansi/jenistransaksi';
$route['saldoawal'] = 'akuntansi/saldoawal';
// --------------- Transaksi -----------------------------
$route['kasmasuk'] = 'akuntansi/transaksi/kasmasuk';
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
$route['tahunajaran'] = 'akademik/tahunajaran';
$route['tahunajaranaktif'] = 'akademik/tahunajaranaktif';
$route['mahasiswa'] = 'akademik/mahasiswa';
$route['kelas'] = 'akademik/kelas';
$route['detailkelas'] = 'akademik/kelas/detail';
// --------------- operasional -----------------------------
$route['kewajiban'] = 'operasional/kewajiban';
$route['aturbayar'] = 'operasional/aturbayar';
//$route['kewajiban/akun'] = 'operasional/kewajiban/akun';
