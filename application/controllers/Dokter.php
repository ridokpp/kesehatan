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
	* log pengobatan setiap pasien
	*/
	function log($nomor_pasien)
	{
		$data['pasien'] 		= $this->Kesehatan_M->read('pasien',array('nomor_pasien'=>$nomor_pasien))->result();
		$update_kd_dokter		= $this->Kesehatan_M->update('rkm_medis',array('kd_pasien'=>$nomor_pasien),array('kd_dokter'=>$this->session->userdata('logged_in')['id_user']));

		$data['rekam_medis'] 	= $this->Kesehatan_M->rawQuery("SELECT rkm_medis.kd_rkm, rkm_medis.kd_objek, rkm_medis.kd_pasien, rkm_medis.tgl_jam, rkm_medis.subjek, rkm_medis.planning, objek.tb, objek.bb, objek.td1, objek.td2, objek.N, objek.RR, objek.TAx, objek.text_headtotoe, headtotoe.keluhan, headtotoe.GCS_E, headtotoe.GCS_V, headtotoe.GCS_M,  headtotoe.GCS_opsi, headtotoe.lain_lain, kepala.anemis_kiri, kepala.anemis_kanan, kepala.ikterik_kiri, kepala.ikterik_kanan, kepala.cianosis_kiri, kepala.cianosis_kanan, kepala.deformitas_kiri, kepala.deformitas_kanan, kepala.refchy_kiri, kepala.refchy_kanan, kepala.refchyopsi, kepala.ket_tambahan, thorak.metris, thorak.wheezing_kiri, thorak.wheezing_kanan, thorak.ronkhi_kiri, thorak.ronkhi_kanan, thorak.vesikuler_kiri, thorak.vesikuler_kanan, thorak.jantung_icor, thorak.s1_s2, thorak.s_tambahan, thorak.ket_tambahan, abdomen.BU, abdomen.ny1, abdomen.ny2, abdomen.ny3, abdomen.ny4, abdomen.ny5, abdomen.ny6, abdomen.ny7, abdomen.ny8, abdomen.ny9, abdomen.hpmgl, abdomen.spmgl, ekstermitas.ah1, ekstermitas.ah2, ekstermitas.ah3, ekstermitas.ah4, ekstermitas.crt1, ekstermitas.crt2, ekstermitas.crt3, ekstermitas.crt4, ekstermitas.edm1, ekstermitas.edm2, ekstermitas.edm3, ekstermitas.edm4, ekstermitas.pitting, ekstermitas.ket_tambahan, terapi.terapi1, terapi.terapi2, terapi.terapi3, (SELECT GROUP_CONCAT(assessment.tipe,' ',assessment.detil SEPARATOR ' ; ') FROM assessment WHERE assessment.kd_assessment = rkm_medis.kd_assessment) AS kelompok FROM rkm_medis INNER JOIN objek ON rkm_medis.kd_objek = objek.kd_objek   LEFT JOIN headtotoe ON objek.kd_headtotoe = headtotoe.kd_headtotoe LEFT JOIN kepala ON headtotoe.kd_kepala = kepala.kd_kepala LEFT JOIN thorak ON headtotoe.kd_thorak = thorak.kd_thorak LEFT JOIN abdomen ON headtotoe.kd_abdomen = abdomen.kd_abdomen LEFT JOIN ekstermitas ON headtotoe.kd_ekstermitas = ekstermitas.kd_ekstermitas LEFT JOIN terapi ON headtotoe.kd_terapi = terapi.kd_terapi INNER JOIN assessment ON rkm_medis.kd_assessment = rkm_medis.kd_assessment 

																				WHERE rkm_medis.kd_pasien = '".$nomor_pasien."'
																				GROUP BY kd_rkm")->result();
echo "<pre>";
		var_dump($data['rekam_medis']);
echo "</pre>";
		$data['objektif']		= $this->Kesehatan_M->readS('objek')->result();
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/log',$data);
		$this->load->view('static/footer');
	}

	function cetak_log()
	{
		$nomor_pasien = $this->input->post('nomor_pasien');
		$data = ''; 
	}

	/*
	* form pemeriksaan setiap pasien
	*/
	function pemeriksaan($nomor_pasien)
	{
		$data['pasien'] = $this->Kesehatan_M->read('pasien',array('nomor_pasien'=>$nomor_pasien))->result();
		if ($data['pasien'] != array()) {
			$kd_objek		= $this->Kesehatan_M->readCol('rkm_medis',array('kd_pasien'=>$nomor_pasien,'DATE(tgl_jam)'=>date('Y-m-d')),'kd_objek')->result();
			if ($kd_objek != array()) {
				$data['objek']	= $this->Kesehatan_M->read('objek',array('kd_objek'=>$kd_objek[0]->kd_objek))->result();
				$this->load->view('static/header');
				$this->load->view('static/navbar');
				$this->load->view('dokter/pemeriksaan',$data);
				$this->load->view('static/footer');
			}else{
				$this->load->view('static/header');
				$this->load->view('static/navbar');
				$data['heading']	= "Halaman tidak ditemukan";
				$data['message']	= "<p> Klik <a href='".base_url()."Dokter'>disini </a>untuk kembali melihat daftar pasien yang sedang antri</p>";
				$this->load->view('errors/html/error_404',$data);
			}
		}else{
			$this->load->view('static/header');
			$this->load->view('static/navbar');
			$data['heading']	= "Halaman tidak ditemukan";
			$data['message']	= "<p> Klik <a href='".base_url()."Dokter'>disini </a>untuk kembali melihat daftar pasien yang sedang antri</p>";
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
		$data['proses_antrian'] = $this->Kesehatan_M->rawQuery('SELECT pasien.nama,pasien.pembayaran,pasien.nomor_pasien FROM pasien INNER JOIN proses_antrian ON pasien.nomor_pasien=proses_antrian.nomor_pasien')->result();

		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/antri',$data);
		$this->load->view('static/footer');
	}
}