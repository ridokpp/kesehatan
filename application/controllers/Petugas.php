<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* controller untuk bagian petugas depan
*/
class Petugas extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Kesehatan_M');
		date_default_timezone_set("Asia/Jakarta");
	}

	function menu($menu)
	{
		$this->load->view('static/header');
		if ($menu == 'pendaftaran') {
			$this->load->view('petugas/pendaftaran_pasien');
		}elseif ($menu == 'pemeriksaan') {
			$this->load->view('petugas/pemeriksaan_awal');
		}
		$this->load->view('static/footer');
	}
}