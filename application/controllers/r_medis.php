<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* controller untuk login, register, reset password, ubah identitas
*/
class Account extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Kesehatan_M');
		date_default_timezone_set("Asia/Jakarta");
	}

	public function getpasien()
	{
		$dataCondition = array('kd_pasien' =>$this->input->post('kd_pasien'),
							   'nama' =>$this->input->post('nama'),
							   'nik' =>$this->input->post('nik'),
							   'tmp_lahir' =>$this->input->post('tmp_lahir'),
							   'tgl_lahir' =>$this->input->post('tgl_lahir'),
							   'usia' =>$this->input->post('usia'),
							   'alamat' =>$this->input->post('alamat'),
							   'jkelamin' =>$this->input->post('jkelamin'),
							   'pekerjaan' =>$this->input->post('pekerjaan'),
							   'kd_kelurahan' =>$this->input->post('kd_kelurahan'));
		$proses_insert = $this->Kesehatan_M->read('pasien',$dataCondition);
		if ($proses_insert->num_rows() == 0) {
			echo json_encode(array('status'=>'sukses'));
		}else{
			echo json_encode(array('status'=>'gagal'));
		}

	}

	public function getobjek()
	{
		$dataCondition = array('kd_objek' =>$this->input->post('kd_objek'),
							   'tb' =>$this->input->post('tb'),
							   'bb' =>$this->input->post('bb'),
							   'td1' =>$this->input->post('td1'),
							   'td2' =>$this->input->post('td2'),
							   'N' =>$this->input->post('N'),
							   'RR' =>$this->input->post('RR'),
							   'TAx' =>$this->input->post('TAx'),
							   'kd_headtotoe' =>$this->input->post('kd_headtotoe'));
		$proses_insert = $this->Kesehatan_M->read('pasien',$dataCondition);
		if ($proses_insert->num_rows() == 0) {
			echo json_encode(array('status'=>'sukses'));
		}else{
			echo json_encode(array('status'=>'gagal'));
		}

	}


	public function getheadtotoe()
	{
		$dataCondition = array('kd_headtotoe' =>$this->input->post('kd_headtotoe'),
							   'kd_kepala' =>$this->input->post('kd_kepala'),
							   'kd_thorak' =>$this->input->post('kd_thorak'),
							   'kd_abdomen' =>$this->input->post('kd_abdomen'),
							   'kd_ekstermitas' =>$this->input->post('kd_ekstermitas'),
							   'lain_lain' =>$this->input->post('lain_lain'),
							   'diagnosa' =>$this->input->post('diagnosa'),
							   'kd_terapi' =>$this->input->post('kd_terapi'));
		$proses_insert = $this->Kesehatan_M->read('headtotoe',$dataCondition);
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