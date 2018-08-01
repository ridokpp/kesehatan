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

	}
	function kepala(){
		$dataCondition = array('kd_kepala' =>$this->input->post('kd_kepala'),
							   'animes_kiri' =>$this->input->post('animes_kiri'),
							   'animes_kanan' =>$this->input->post('animes_kanan'),
							   'ikterik_kiri' =>$this->input->post('ikterik_kiri'),
							   'ikterik_kanan' =>$this->input->post('ikterik_kanan'),
							   'cianosis_kiri' =>$this->input->post('cianosis_kiri'),
							   'cianosis_kanan' =>$this->input->post('cianosis_kanan'),
							   'deformitas_kiri' =>$this->input->post('deformitas_kiri'),
							   'deformitas_kanan' =>$this->input->post('deformitas_kiri'),
							   'refchy_kiri' =>$this->input->post('refhy_kiri'),
							   'refchy_kanan' =>$this->input->post('refchy_kanan'),
							   'refchyopsi' =>$this->input->post('refchyopsi'));
		$proses_insert = $this->Kesehatan_M->create('kepala',$dataCondition);
		if ($proses_insert->num_rows() == 0) {
			echo json_encode(array('status'=>'sukses'));
		}else{
			echo json_encode(array('status'=>'gagal'));
		}

	}

	function thorak(){
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

	function abdomen(){
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

	function ekstermitas(){
		$dataCondition = array('kd_ekstermitas' =>$this->input->post('kd_ekstermitas'),
							   'ah' =>$this->input->post('ah'),
							   'crt' =>$this->input->post('crt'),
							   'edm' =>$this->input->post('edm'),
							   'pitting' =>$this->input->post('pitting'),
							   'ket_tambahan' =>$this->input->post('ket_tambahan'));
		$proses_insert = $this->Kesehatan_M->create('ekstermitas',$dataCondition);
		if ($proses_insert->num_rows() == 0) {
			echo json_encode(array('status'=>'sukses'));
		}else{
			echo json_encode(array('status'=>'gagal'));
		}
	}


}