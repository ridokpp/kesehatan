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
		$data['last_sync'] 		=	$this->Kesehatan_M->read('settingan',array('id'=>1))->result();
		$now 					=	date("Y-m-d H:i:s");
		if ($data['last_sync'] == array()) {
			$this->Kesehatan_M->create('settingan',array('id'=>1,'value'=>$now));
		}else{
			$datetime_now = new DateTime();
			$datetime_database = new DateTime($data['last_sync'][0]->value);
			if ($datetime_now->format('Y-m-d') > $datetime_database->format('Y-m-d')) {
				$this->Kesehatan_M->update('settingan',array('id'=>1),array('value'=>$now));
				$this->Kesehatan_M->rawQuery('TRUNCATE TABLE antrian');
				$this->Kesehatan_M->rawQuery('TRUNCATE TABLE proses_antrian');
			}
		}
	}


	/*
	* form pemeriksaan setiap pasien
	*/
	function pemeriksaan($nomor_pasien)
	{
		$data['pasien'] = $this->Kesehatan_M->read('pasien',array('nomor_pasien'=>$nomor_pasien))->result();
		if ($data['pasien'] != array()) {
			$data['rekam_medis'] = $this->Kesehatan_M->read('rekam_medis',array('nomor_pasien'=>$nomor_pasien))->result();
			$this->load->view('static/header');
			$this->load->view('static/navbar');
			$this->load->view('dokter/pemeriksaan',$data);
			$this->load->view('static/footer');
		}else{
			$this->load->view('static/header');
			$this->load->view('static/navbar');
			$data['heading']	= "Halaman tidak ditemukan";
			$data['message']	= "<p> Klik <a href='".base_url()."Dokter/index'>disini </a>untuk kembali melihat daftar pasien yang sedang antri</p>";
			$this->load->view('errors/html/error_404',$data);
		}
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
	function index(){
		// baca antrian yang tersedia, tampilkan nama dan waktu datang
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/antri');
		$this->load->view('static/footer');
	}

	/*
	* function untuk menampilkan rekam medis pasien melalui pencarian nama atau nomor pasien mirip degan petugas.
	*/
	function cari_pasien()
	{
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/cari_pasien');
		$this->load->view('static/footer');
	}

	/*
	* funtion untuk menampilkan halaman tambah antrian
	*/
	function pemeriksaan_langsung()
	{
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/tambah_antrian');
		$this->load->view('static/footer');
	}

	/*
	* function untuk mambaca rekam mesdis setiap pasien
	*/
	function rekam_medis($nomor_pasien)
	{

	}

	/*
	* cari nama pasien via ajax
	*/
	function cari_nama()
	{
		if ($this->input->get() != NULL) {
			$dataForm = $this->input->get();
			$dataReturn = $this->Kesehatan_M->orLike('pasien',array('nama'=>$dataForm['term']['term'],'nomor_pasien'=>$dataForm['term']['term']))->result();
			$data = array();
			foreach ($dataReturn as $key => $value) {
				$data[$key]['id'] = $value->nomor_pasien;
				$data[$key]['text'] = $value->nama." / ".$value->nomor_pasien;
			}
			echo json_encode($data);
		}else{
			redirect(base_url());
		}
	}

	/*
	* handle submit form cari pasien untuk tambah antrian
	*/
	function redirector()
	{
		if ($this->input->get() != NULL) {
			redirect(base_url()."Dokter/pemeriksaan/".$this->input->get('nama_or_nomor'));
		}else{
			redirect(base_url());
		}
	}

	/*
	* function untuk menampilkan halaman logistik
	*/
	function logistik()
	{
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/logistik');
		$this->load->view('static/footer');
	}
}