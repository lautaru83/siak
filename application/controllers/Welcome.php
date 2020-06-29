<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		require_once(APPPATH . 'third_party/dompdf/dompdf_config.inc.php');
		$this->load->model(array('Institusi_model' => 'Institusi_model', 'Unit_model' => 'Unit_model'));
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function cetak()
	{
		$dompdf = new DOMPDF();
		$data['judul'] = "ok";
		// $this->load->model(array('Menu_model' => 'Menu_model', 'Submenu_model' => 'Submenu_model'));
		$data['institusi'] = $this->Institusi_model->ambil_data();
		$html = $this->load->view('cetak', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		$dompdf->stream('welcome.pdf', array("Attachment" => false));
	}
}
