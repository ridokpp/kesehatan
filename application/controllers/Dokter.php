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
		if ($this->session->userdata('logged_in')['akses'] != '2' ){
			redirect(base_url()."Account/logout_handler");
		}
	}

	/*
	* log pengobatan setiap pasien
	*/
	function log()
	{
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/log');
		$this->load->view('static/footer');
	}

	/*
	* form pemeriksaan setiap pasien
	*/
	function pemeriksaan()
	{
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/pemeriksaan');
		$this->load->view('static/footer');
	}

	/*
	* cetak surat sakit,sehat dan rujukan
	*/
	function cetak($surat)
	{
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		if ($surat == 'suratsehat') {
			$this->load->view('dokter/suratsehat');
		}elseif ($surat == 'suratsakit') {
			$this->load->view('dokter/suratsakit');
		}elseif ($surat == 'suratrujukan') {
			$this->load->view('dokter/suratrujukan');
		}
		$this->load->view('static/footer');
	}

	/*
	* lihat antrian yang sekarang
	*/
	function antrian(){
		// baca antrian yang tersedia, tampilkan nama dan waktu datang
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/antri');
		$this->load->view('static/footer');
	}
}