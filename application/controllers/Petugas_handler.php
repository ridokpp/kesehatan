<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_handler extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Kesehatan_M');
		date_default_timezone_set("Asia/Jakarta");
	}

	function register(){

		// ambil id terakhir
		$no_urut 	= $this->Kesehatan_M->rawQuery("SELECT AUTO_INCREMENT AS no_urut FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'kesehatan' AND TABLE_NAME = 'pasien'")->result();
		if ($no_urut == array()) {
			$no_urut = 0;
		}else{
			$no_urut = $no_urut[0]->no_urut;
		}

		// ambil kode kelurahan
		$kelurahan = $this->input->post('kelurahan');
		$kd_kelurahan = substr($kelurahan, 0,3);

		// ambil jenis kelamin
		$jenis_kelamin = $this->input->post('jenis_kelamin');

		// hitung umur
		$tgl_lahir  = new DateTime($this->input->post('tanggal_lahir'));
		$now 		= new DateTime();
		$usia		= $now->diff($tgl_lahir)->y;

		if ($usia <= "14") {
			$usia = "01";
		}elseif($usia >= "15" && $usia <= "49"){
			$usia = "02";
		}elseif ($usia >= "50") {
			$usia = "03";
		}

		// ambil pembayaran
		$pembayaran = $this->input->post('pembayaran');

		// bulan datang
		$bulan_datang = $now->format('m');

		// tahun datang
		$tahun_datang = $now->format('Y');
		
		$dataForm = array(	'nama'			=>$this->input->post('nama_lengkap'),
							'nik' 			=>$this->input->post('nik'),
							'tmp_lahir'		=>$this->input->post('tempat_lahir'),
							'tgl_lahir'		=>$tgl_lahir->format('Y-m-d'),
							'usia'			=>$usia,
							'alamat'		=>$this->input->post('jalan').substr($kelurahan, 4).$kecamatan.$kota,
							'jkelamin'		=>$jenis_kelamin,
							'pekerjaan'		=>$this->input->post('pekerjaan'),
							'kd_kelurahan'	=>$kd_kelurahan,
							'pembayaran'	=>$this->input->post('pembayaran'),
							'nomor_pasien'	=>$no_urut."-".$kd_kelurahan."-".$jenis_kelamin."-".$usia."-".$bulan_datang."-".$tahun_datang
						);

		$result = json_decode($this->Kesehatan_M->create('pasien',$dataForm),false);
		if ($result->status) {
			alert('alert','success','Berhasil','Registrasi berhasil');
		}else{
			alert('alert','success','Gagal','Kegagalan database'.$result->error_message);
		}
	}
}