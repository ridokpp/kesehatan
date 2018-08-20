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
		$proses_insert = $this->Kesehatan_M->create('pasien',$dataCondition);
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
		$proses_insert = $this->Kesehatan_M->create('pasien',$dataCondition);
		if ($proses_insert->num_rows() == 0) {
			echo json_encode(array('status'=>'sukses'));
		}else{
			echo json_encode(array('status'=>'gagal'));
		}

	}



	
	


}