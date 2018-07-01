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

	function register_handle(){
		$dataForm = array(
							'nama'=>$this->input->post('nama'),
							'nik'=>$this->input->post('nik'),
							'tmp_lahir'=>$this->input->post('tmp_lahir'),
							'tgl_lahir'=>$this->input->post('tgl_lahir'),
							'usia'=>$this->input->post('usia'),
							'alamat'=>$this->input->post('alamat'),
							'jkelamin'=>$this->input->post('jkelamin'),
							'pekerjaan'=>$this->input->post('pekerjaan'),
							'kd_kelurahan'=>$this->input->post('kd_kelurahan'),
							'pembayaran'=>$this->input->post('pembayaran')
						);
		$result = json_decode($this->Kesehatan_M->create('pasien',$dataForm),false);
		if ($result->status) {
			alert('alert','success','Berhasil','Registrasi berhasil');
		}else{
			alert('alert','success','Gagal','Kegagalan database'.$result->error_message);
		}
	}

	public function create_($value='')
	{
		# code...
	}

}