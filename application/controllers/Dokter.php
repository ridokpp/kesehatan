<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* controller untuk bagian petugas depan
*/
class Dokter extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Kesehatan_M');
		date_default_timezone_set("Asia/Jakarta");
	}

	function log()
	{
		$this->load->view('static/header');
		$this->load->view('dokter/log');
		$this->load->view('static/footer');
	}
	function pemeriksaan()
	{
		$this->load->view('static/header');
		$this->load->view('dokter/pemeriksaan');
		$this->load->view('static/footer');
	}

	function cetak($surat)
	{
		$this->load->view('static/header');
		if ($surat == 'suratsehat') {
			$this->load->view('dokter/suratsehat');
		}elseif ($surat == 'suratsakit') {
			$this->load->view('dokter/suratsakit');
		}elseif ($surat == 'suratrujukan') {
			$this->load->view('dokter/suratrujukan');
		}
		$this->load->view('static/footer');
	}
}