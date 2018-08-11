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
		}elseif(intval(substr(date($data['last_sync'][0]->value), 8,7)) < intval(date('d'))){
			$this->Kesehatan_M->update('settingan',array('id'=>1),array('value'=>$now));
			$this->Kesehatan_M->rawQuery('TRUNCATE TABLE antrian');
			$this->Kesehatan_M->rawQuery('TRUNCATE TABLE proses_antrian');
		}
	}

	/*
	* log pengobatan setiap pasien
	*/
	function log($nomor_pasien)
	{
		$data['pasien'] 		= $this->Kesehatan_M->read('pasien',array('nomor_pasien'=>$nomor_pasien))->result();
		$data['rekam_medis'] 	= $this->Kesehatan_M->read('rkm_medis',array('kd_pasien'=>$nomor_pasien))->result();
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/log',$data);
		$this->load->view('static/footer');
	}

	/*
	* form pemeriksaan setiap pasien
	*/
	function pemeriksaan($nomor_pasien)
	{
		$data['pasien'] = $this->Kesehatan_M->read('pasien',array('nomor_pasien'=>$nomor_pasien))->result();
		$kd_objek		= $this->Kesehatan_M->readCol('rkm_medis',array('kd_pasien'=>$nomor_pasien,'tanggal_add'=>date('Y-m-d')),'kd_objek')->result();
		var_dump(date("Y-m-d"));
		$data['objek']	= $this->Kesehatan_M->read('objek',array('kd_objek'=>$kd_objek[0]->kd_objek))->result();
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/pemeriksaan',$data);
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
	function index(){
		// checking sinkronisasi terakhir
		$data['last_sync'] 		=	$this->Kesehatan_M->read('settingan',array('id'=>1))->result();
		$now 					=	date("Y-m-d H:i:s");
		
		// baca antrian yang tersedia, tampilkan nama dan waktu datang
		$data['proses_antrian'] = $this->Kesehatan_M->rawQuery('SELECT pasien.nama,pasien.pembayaran,pasien.nomor_pasien FROM pasien INNER JOIN proses_antrian ON pasien.nomor_pasien=proses_antrian.nomor_pasien')->result();

		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/antri',$data);
		$this->load->view('static/footer');
	}
}