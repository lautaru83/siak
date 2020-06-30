<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		//require_once(APPPATH . 'third_party/dompdf/dompdf_config.inc.php');
		$this->load->model(array('Institusi_model' => 'Institusi_model', 'Unit_model' => 'Unit_model'));
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function cetak()
	{
		$data['judul'] = "ok";
		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "welcome";
		$this->pdf->load_view('welcome_message', $data);
	}
}
