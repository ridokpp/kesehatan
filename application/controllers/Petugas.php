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
		if ($this->session->userdata('logged_in')['akses'] != '3' ){
			redirect(base_url()."Account/logout_handler");
		}
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
		}elseif ($menu == 'antrian') {
			$data['antrian']=$this->Kesehatan_M->rawQuery('SELECT pasien.nama, antrian.jam_datang, antrian.nomor_antrian, pasien.pembayaran, pasien.nomor_pasien FROM antrian INNER JOIN pasien on antrian.nomor_pasien=pasien.nomor_pasien')->result();
			$data['proses_antrian']=$this->Kesehatan_M->rawQuery('SELECT pasien.nama, pasien.pembayaran FROM proses_antrian INNER JOIN pasien on proses_antrian.nomor_pasien=pasien.nomor_pasien')->result();
			$this->load->view('static/header');
			$this->load->view('static/navbar');
			$this->load->view('petugas/antri',$data);
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