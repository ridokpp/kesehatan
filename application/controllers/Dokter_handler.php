<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* controller untuk bagian petugas depan
*/
class Dokter_handler extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Kesehatan_M');
		date_default_timezone_set("Asia/Jakarta");
	}

	/*
	* cetak surat sakit,sehat dan rujukan
	*/
	function cetak($surat)
	{
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		if ($surat == 'suratsehat') {
			$data['nomor_pasien']	= $this->input->post('nomor_pasien');
			$data['tes_buta_warna']	= $this->input->post('tes_buta_warna');
			$data['keperluan']	= $this->input->post('keperluan');
			$data['nama_user']		= $this->session->userdata('logged_in')['nama_user'];
			$data['sip']			= $this->session->userdata('logged_in')['sip'];
			$data['pasien']			= $this->Kesehatan_M->read('pasien',array('nomor_pasien'=>$data['nomor_pasien']))->result();
			$data['rkm_medis']		= $this->Kesehatan_M->readCol('rkm_medis',array('kd_pasien'=>$data['nomor_pasien'],'DATE(tgl_jam)'=>date('Y-m-d')),array('kd_objek'))->result();
			$data['objek']			= $this->Kesehatan_M->read('objek',array('kd_objek'=>$data['rkm_medis'][0]->kd_objek))->result();
			$this->load->view('dokter/suratsehat',$data);
		}elseif ($surat == 'suratsakit') {
			$data['alasan']		 	= $this->input->post('alasan');
			$data['tanggal_awal'] 	= $this->input->post('tanggal_awal');
			$data['tanggal_akhir'] 	= $this->input->post('tanggal_akhir');
			$data['selama'] 		= $this->input->post('selama');
			$data['selama_satuan'] 	= $this->input->post('selama_satuan');
			$data['nomor_pasien']	= $this->input->post('nomor_pasien');
			$data['nama_user']		= $this->session->userdata('logged_in')['nama_user'];
			$data['sip']			= $this->session->userdata('logged_in')['sip'];
			$data['pasien']			= $this->Kesehatan_M->read('pasien',array('nomor_pasien'=>$data['nomor_pasien']))->result();
			$this->load->view('dokter/suratsakit',$data);
		}elseif ($surat == 'suratrujukan') {
			$data['anemis_kiri'] = $this->input->post('anemis_kiri');
			$data['anemis_kanan'] = $this->input->post('anemis_kanan');
			$data['ikterik_kiri'] = $this->input->post('ikterik_kiri');
			$data['ikterik_kanan'] = $this->input->post('ikterik_kanan');
			$data['cianosis_kiri'] = $this->input->post('cianosis_kiri');
			$data['cianosis_kanan'] = $this->input->post('cianosis_kanan');
			$data['deformitas_kiri'] = $this->input->post('deformitas_kiri');
			$data['refchy_kiri'] = $this->input->post('refchy_kiri');
			$data['refchy_kanan'] = $this->input->post('refchy_kanan');
			$data['deformitas_kiri'] = $this->input->post('deformitas_kirir');
			$data['deformitas_kiri'] = $this->input->post('deformitas_kirir');
			$data['refchy_opsi'] = $this->input->post('refchy_opsi');
			$data['ket_tambahankpl'] = $this->input->post('ket_tambahankpl');
			$this->Kesehatan_M->create('kepala',$data);
			$data['metris'] = $this->input->post('metris');
			$data['wheezing_kiri'] = $this->input->post('wheezing_kiri');
			$data['wheezing_kanan'] = $this->input->post('wheezing_kanan');
			$data['ronkhi_kiri'] = $this->input->post('ronkhi_kiri');
			$data['ronkhi_kanan'] = $this->input->post('ronkhi_kanan');
			$data['vesikuler_kiri'] = $this->input->post('vesikuler_kanan');
			$data['vesikuler_kanan'] = $this->input->post('vesikuler_kanan');
			$data['jantung_icor'] = $this->input->post('jantung_icor');
			$data['s1_s2'] = $this->input->post('s1_s2');
			$data['s_tambahan'] = $this->input->post('s_tambahan');
			$data['ket_tambahantr'] = $this->input->post('ket_tambahantr');
			$this->Kesehatan_M->create('thorak',$data);
			$data['BU'] = $this->input->post('BU');
			$data['nyeri_tekan'] = $this->input->post('nyeri_tekan');
			$data['hpmgl'] = $this->input->post('hpmgl');
			$data['spmgl'] = $this->input->post('spmgl');
			$data['ket_tambahanab'] = $this->input->post('ket_tambahanab');
			$data['lain_lain'] = $this->input->post('lain_lain');
			$data['diagnosa'] = $this->input->post('diagnosa');
			$data['terapi'] = $this->input->post('terapi');
			$this->Kesehatan_M->create('abdomen',$data);
			$data['keluhan'] = $this->input->post('keluhan');
			$data['GCS_E'] = $this->input->post('GCS_E');
			$data['GCS_V'] = $this->input->post('GCS_V');
			$data['GCS_M'] = $this->input->post('GCS_M');
			$data['GCS_opsi'] = $this->input->post('GCS_opsi');
			$this->load->view('dokter/suratrujukan');
		}
		$this->load->view('static/footer');
	}


	// function headtotoe(){
	// 	$dataCondition = array('kd_headtotoe' =>$this->input->post('kd_headtotoe'),
	// 						   'kd_kepala' =>$this->input->post('kd_kepala'),
	// 						   'kd_thorak' =>$this->input->post('kd_thorak'),
	// 						   'kd_abdomen' =>$this->input->post('kd_abdomen'),
	// 						   'kd_ekstermitas' =>$this->input->post('kd_ekstermitas'),
	// 						   'lain_lain' =>$this->input->post('lain_lain'),
	// 						   'diagnosa' =>$this->input->post('diagnosa'),
	// 						   'kd_terapi' =>$this->input->post('kd_terapi'));
	// 	$proses_insert = $this->Kesehatan_M->create('headtotoe',$dataCondition);
	// 	if ($proses_insert->num_rows() == 0) {
	// 		echo json_encode(array('status'=>'sukses'));
	// 	}else{
	// 		echo json_encode(array('status'=>'gagal'));
	// 	}
	// }

		public function headtotoe()
	{
		$dataCondition = array('keluhan' =>$this->input->post('keluhan'),
							   'GCS_E' =>$this->input->post('GCS_E'),
							   'GCS_V' =>$this->input->post('GCS_V'),
							   'GCS_M' =>$this->input->post('GCS_M'),
							   'GCS_opsi' =>$this->input->post('GCS_opsi'),
							   'kd_kepala' =>$this->input->post('kd_kepala'),
							   'kd_thorak' =>$this->input->post('kd_thorak'),
							   'kd_abdomen' =>$this->input->post('kd_abdomen'),
							   'kd_ekstermitas' =>$this->input->post('kd_ekstermitas'),
							   'lain_lain' =>$this->input->post('lain_lain'),
							   'diagnosa' =>$this->input->post('diagnosa'),
							   'kd_terapi' =>$this->input->post('kd_terapi'));
		$proses_insert = $this->Kesehatan_M->create('headtotoe',$dataCondition);
		if ($proses_insert->num_rows() == 0) {
			echo json_encode(array('status'=>'sukses'));
		}else{
			echo json_encode(array('status'=>'gagal'));
		}

	}


	public function kepala()
	{
		$dataCondition = array('kd_kepala' =>$this->input->post('kd_kepala'),
							   'anemis_kiri' =>$this->input->post('anemis_kiri'),
							   'anemis_kanan' =>$this->input->post('anemis_kanan'),
							   'ikterik_kiri' =>$this->input->post('ikterik_kiri'),
							   'ikterik_kanan' =>$this->input->post('ikterik_kanan'),
							   'cianosis_kiri' =>$this->input->post('cianosis_kiri'),
							   'cianosis_kanan' =>$this->input->post('cianosis_kanan'),
							   'deformitas_kiri' =>$this->input->post('deformitas_kiri'),
							   'deformitas_kanan' =>$this->input->post('deformitas_kanan'),
							   'refchy_kiri' =>$this->input->post('refchy_kiri'),
							   'refchy_kanan' =>$this->input->post('refchy_kanan'),
							   'refchyopsi' =>$this->input->post('refchyopsi'));
		$proses_insert = $this->Kesehatan_M->create('kepala',$dataCondition);
		if ($proses_insert->num_rows() == 0) {
			echo json_encode(array('status'=>'sukses'));
		}else{
			echo json_encode(array('status'=>'gagal'));
		}

	}

	public function thorak()
	{
		$dataCondition = array('kd_thorak' =>$this->input->post('kd_thorak'),
							   'metris' =>$this->input->post('metris'),
							   'wg_kiri' =>$this->input->post('wg_kiri'),
							   'wg_kanan' =>$this->input->post('wg_kanan'),
							   'rk_kiri' =>$this->input->post('rk_kiri'),
							   'rk_kanan' =>$this->input->post('rk_kanan'),
							   'vk_kiri' =>$this->input->post('vk_kiri'),
							   'vk_kanan' =>$this->input->post('vk_kanan'),
							   'jtgic' =>$this->input->post('jtgic'),
							   's1_s2' =>$this->input->post('s1_s2'),
							   's_tambahan' =>$this->input->post('s_tambahan'),
							   'ket_tambahan' =>$this->input->post('ket_tambahan'));
		$proses_insert = $this->Kesehatan_M->create('thorak',$dataCondition);
		if ($proses_insert->num_rows() == 0) {
			echo json_encode(array('status'=>'sukses'));
		}else{
			echo json_encode(array('status'=>'gagal'));
		}

	}

	public function abdomen()
	{
		$dataCondition = array('kd_abdomen' =>$this->input->post('kd_abdomen'),
							   'nyeri_tekan' =>$this->input->post('nyeri_tekan'),
							   'hpmgl' =>$this->input->post('hpmgl'),
							   'spmgl' =>$this->input->post('spmgl'),
							   'ket_tambahan' =>$this->input->post('ket_tambahan'));
		$proses_insert = $this->Kesehatan_M->create('abdomen',$dataCondition);
		if ($proses_insert->num_rows() == 0) {
			echo json_encode(array('status'=>'sukses'));
		}else{
			echo json_encode(array('status'=>'gagal'));
		}

	}

	public function ekstermitas()
	{
		$dataCondition = array('kd_ekstermitas' =>$this->input->post('kd_ekstermitas'),
							   'ah' =>$this->input->post('ah'),
							   'crt' =>$this->input->post('crt'),
							   'edm' =>$this->input->post('edm'),
							   'pitting' =>$this->input->post('pitting'),
							   'ket_tambahan' =>$this->input->post('ket_tambahan'));
		$proses_insert = $this->Kesehatan_M->read('ekstermitas',$dataCondition);
		if ($proses_insert->num_rows() == 0) {
			echo json_encode(array('status'=>'sukses'));
		}else{
			echo json_encode(array('status'=>'gagal'));
		}

	}

	public function terapi()
	{
		$dataCondition = array('kd_terapi' =>$this->input->post('kd_terapi'),
							   'terapi' =>$this->input->post('terapi'));
		$proses_insert = $this->Kesehatan_M->read('terapi',$dataCondition);
		if ($proses_insert->num_rows() == 0) {
			echo json_encode(array('status'=>'sukses'));
		}else{
			echo json_encode(array('status'=>'gagal'));
		}

	}

	public function c_rkm()
	{
		$dataCondition = array('kd_rkm' =>$this->input->post('kd_rkm'),
							   'kd_pasien' =>$this->input->post('kd_pasien'),
							   'tgl_jam' =>$this->input->post('tgl_jam'),
							   'subjek' =>$this->input->post('subjek'),
							   'kd_objek' =>$this->input->post('kd_objek'),
							   'planning' =>$this->input->post('planning'),
							   'kd_user' =>$this->input->post('kd_user'));
		$proses_insert = $this->Kesehatan_M->create('rkm_medis',$dataCondition);
		if ($proses_insert->num_rows() == 0) {
			echo json_encode(array('status'=>'sukses'));
		}else{
			echo json_encode(array('status'=>'gagal'));
		}

	}


}