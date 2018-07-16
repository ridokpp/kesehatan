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

	function menu($menu,$nomor_pasien='')
	{
		if ($menu == 'pendaftaran') {
			$this->load->view('static/header');
			$this->load->view('static/navbar');
			$this->load->view('petugas/pendaftaran_pasien');
		}elseif ($menu == 'pemeriksaan') {
			if ($nomor_pasien != '' ) {
				
				$data['pasien'] = $this->Kesehatan_M->read('pasien',array('nomor_pasien'=>$nomor_pasien))->result();
				$this->load->view('static/header',$data);
				$this->load->view('static/navbar');
				$this->load->view('petugas/pemeriksaan_awal',$data);
			}else{
				redirect(base_url()."Petugas/menu/cari");
			}
		}elseif ($menu == 'cari') {
			$this->load->view('static/header');
			$this->load->view('static/navbar');
			$this->load->view('petugas/cari_pasien');
		}else{
			$this->load->view('static/header');
			$this->load->view('static/navbar');
			$data['heading']	= "Halaman tidak ditemukan";
			$data['message']	= "<p> Klik <a href='".base_url()."Petugas/menu/pendaftaran'>disini </a>untuk kembali ke Home </p>";
			$this->load->view('errors/html/error_404',$data);
		}
		$this->load->view('static/footer');
	}
}