<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* controller untuk bagian petugas depan
*/
class Admin extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Kesehatan_M');
		date_default_timezone_set("Asia/Jakarta");
		if ($this->session->userdata('logged_in')['akses'] != '1' ){
			redirect(base_url()."Account/logout_handler");
		}
	}

	function menu($menu){
		
		if ($menu == 'dashboard') {
			/*pasien yang datang bulan ini*/
			$this->load->view('static/header');
			$this->load->view('static/navbar');
			$this->load->view('admin/dashboard');
			$this->load->view('static/footer');
		}elseif ($menu == 'verifikasi') {
			/*verifikasi pendaftar*/
			$data['belum_terverifikasi'] = $this->Kesehatan_M->read('user',array('verified'=>'belum'))->result();
			$data['sudah_terverifikasi'] = $this->Kesehatan_M->read('user',array('verified'=>'sudah','hak_akses !='=>'1'))->result();
			$this->load->view('static/header');
			$this->load->view('static/navbar');
			$this->load->view('admin/verifikasi',$data);
			$this->load->view('static/footer');
		}elseif ($menu == 'daftar_pasien') {
			/*daftar pasienr*/
			$data['pasien'] 		= $this->Kesehatan_M->readS('pasien')->result();
			$this->load->view('static/header');
			$this->load->view('static/navbar');
			$this->load->view('admin/daftar_pasien',$data);
			$this->load->view('static/footer');
		}elseif ($menu == 'daftar_dokter') {
			/*daftar pasienr*/
			$data['dokter'] 		= $this->Kesehatan_M->readS('dokter')->result();
			$this->load->view('static/header');
			$this->load->view('static/navbar');
			$this->load->view('admin/daftar_dokter',$data);
			$this->load->view('static/footer');
		}else{
			$this->load->view('static/header');
			$this->load->view('static/navbar');
			$data['heading']	= "Halaman tidak ditemukan";
			$data['message']	= "<p> Klik <a href='".base_url()."Petugas/menu/pendaftaran'>disini </a>untuk kembali ke Home </p>";
			$this->load->view('errors/html/error_404',$data);
		}
		$this->load->view('static/footer');
	}

	function rekam_medis(){
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('admin/rekam_medis',$data);
		$this->load->view('static/footer');
	}

	function rekam_dokter(){
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('admin/rekam_dokter');
		$this->load->view('static/footer');
	}
	
}