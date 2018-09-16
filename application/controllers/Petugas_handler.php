<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_handler extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Kesehatan_M');
		date_default_timezone_set("Asia/Jakarta");
	}

	/*
	* form handler untuk register pasien
	*/
	function pendaftaran(){
		$nik = $this->input->post('nik');
		$result = $this->Kesehatan_M->read('pasien',array('nik'=>$nik));
		if ($result->num_rows() == 0) {
			
			// ambil id terakhir
			$no_urut 	= $this->Kesehatan_M->rawQuery("SELECT AUTO_INCREMENT AS no_urut FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'kesehatan' AND TABLE_NAME = 'pasien'")->result();

			// ambil id untuk dijadikan nomor identitas pasien
			if ($no_urut == array()) {
				$no_urut = "000";
			}else{
				if($no_urut[0]->no_urut <= 9){
					$no_urut = "00".$no_urut[0]->no_urut;
				}elseif ($no_urut[0]->no_urut >=10 && $no_urut[0]->no_urut <=99) {
					$no_urut = "0".$no_urut[0]->no_urut;
				}else{
					$no_urut = $no_urut[0]->no_urut;
				}
			}

			// ambil kode kelurahan
			$kelurahan = $this->input->post('kelurahan');
			$kd_kelurahan = substr($kelurahan, 0,3);
			if ($kelurahan == "013 Lain-lain") {
				$kelurahan = $this->input->post('kelurahan_lain');
			}else{
				$kelurahan = substr($kelurahan, 4);
			}

			// manipulasi kecamatan
			$kecamatan = $this->input->post('kecamatan');
			if ($kecamatan == 'other') {
				$kecamatan = $this->input->post('kecamatan_lain');
			}

			// manipulasi kota
			$kota = $this->input->post('kota');
			if ($kota == 'other') {
				$kota = $this->input->post('kota_lain');
			}


			// ambil jenis kelamin
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			if ($jenis_kelamin == 'Laki-laki') {
				$kode_jenis_kelamin = '01';
			}else{
				$kode_jenis_kelamin = '02';
			}

			// hitung umur
			$tgl_lahir  = new DateTime($this->input->post('tanggal_lahir'));
			$now 		= new DateTime();
			$usia		= $now->diff($tgl_lahir)->y;

			if ($usia <= "14") {
				$kode_usia = "01";
			}elseif($usia >= "15" && $usia <= "49"){
				$kode_usia = "02";
			}elseif ($usia >= "50") {
				$kode_usia = "03";
			}

			// ambil pembayaran
			$pembayaran = $this->input->post('pembayaran');

			// bulan datang
			$bulan_datang = $now->format('m');

			// tahun datang
			$tahun_datang = $now->format('Y');
			
			$dataForm = array(	'nama'			=>ucwords($this->input->post('nama_lengkap')),
								'nik' 			=>$nik,
								'tmp_lahir'		=>ucwords($this->input->post('tempat_lahir')),
								'tgl_lahir'		=>$tgl_lahir->format('Y-m-d'),
								'usia'			=>$usia,
								'alamat'		=>	"Jalan ".ucwords($this->input->post('jalan')).
													" RT".$this->input->post('RT').
													" RW".$this->input->post('RW').
													" Kelurahan ".ucwords($kelurahan).
													" Kecamatan ".ucwords($kecamatan).
													" Kota ".ucwords($kota),
								'jkelamin'		=>$this->input->post('jenis_kelamin'),
								'pekerjaan'		=>ucwords($this->input->post('pekerjaan')),
								'kelurahan'		=>ucwords($kelurahan),
								'pembayaran'	=>$this->input->post('pembayaran'),
								'nomor_pasien'	=>$no_urut."-".$kd_kelurahan."-".$kode_jenis_kelamin."-".$kode_usia."-".$bulan_datang."-".$tahun_datang
							);
			// echo "<pre>";
			// var_dump($dataForm);die();
			$result = json_decode($this->Kesehatan_M->create('pasien',$dataForm),false);
			if ($result->status) {
				alert('alert','success','Berhasil','Registrasi berhasil');
				redirect(base_url()."Petugas/menu/pemeriksaan/".$dataForm['nomor_pasien']);
			}else{
				alert('alert','warning','Gagal','Duplikasi NIK');
				redirect(base_url()."Petugas/menu/pendaftaran");
			}
		}else{
			alert('alert','warning','Gagal','Duplikasi NIK');
			redirect(base_url()."Petugas/menu/pendaftaran");
		}
	}

	/*
	* form handler untuk pemeriksaan awal
	*/
	function pemeriksaan(){
		$postedData = 	array(
								'tb'	=>	$this->input->post('tinggi_badan'),
								'bb'	=>	$this->input->post('berat_badan'),
								'td1'	=>	$this->input->post('sistol'),
								'td2'	=>	$this->input->post('diastol'),
								'N'	=>	$this->input->post('denyut_nadi'),
								'RR'=>$this->input->post('frekuensi_pernapasan'),
								'TAx'=>$this->input->post('suhu'),
						);
		$insert_tabel_objek = $this->Kesehatan_M->create_id('objek',$postedData);
		// id
		$postedData['nomor_pasien'] = $this->input->post('nomor_pasien');

		// masukk rm
		$insert_tabel_objek = json_decode($insert_tabel_objek,false);
		// var_dump($insert_tabel_objek);
		// die();
		$this->Kesehatan_M->create('rkm_medis',array('kd_pasien'=>$postedData['nomor_pasien'],'kd_objek'=>$insert_tabel_objek->message,'tgl_jam'=>date("Y-m-d H:i:s")));

		$result = json_decode($this->Kesehatan_M->create('antrian',array('nomor_pasien'=>$postedData['nomor_pasien'],'jam_datang'=>date("Y-m-d H:i:s"))),false);
		if ($result->status) {
			alert('alert','success','Berhasil','Data berhasil dimasukkan');
			redirect(base_url()."Petugas/menu/antrian/");
		}else{
			alert('alert','success','Gagal','Kegagalan database'.$result->error_message);
			redirect(base_url()."Petugas/menu/pemeriksaan/$postedData[nomor_pasien]");
		}
	}

	/*
	* cari nomor pasien via ajax
	*/
	function redirector(){
		if ($this->input->get() != NULL) {
			redirect(base_url()."Petugas/menu/pemeriksaan/".$this->input->get('nama_or_nomor'));
		}else{
			redirect(base_url());
		}
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

	function antrian($aksi,$nomor_pasien)
	{
		if ($aksi == 'proses') {
			$this->Kesehatan_M->create(
										'proses_antrian',
										array(
												'nomor_pasien'	=>	$nomor_pasien
										)
									);
		}elseif ($aksi == 'hapus') {
			$ambil_rkm_obj = $this->Kesehatan_M->rawQuery("SELECT kd_objek,kd_rkm FROM rkm_medis WHERE kd_pasien='$nomor_pasien' AND YEAR(tgl_jam)='".date('Y')."' AND MONTH(tgl_jam)='".date('m')."' AND DAY(tgl_jam)='".date('d')."' ORDER BY kd_rkm DESC LIMIT 1")->result();
			
			$this->Kesehatan_M->delete(
									'objek',
									array(
											'kd_objek'	=>	$ambil_rkm_obj[0]->kd_objek
									));
			$this->Kesehatan_M->delete(
										'rkm_medis',
										array(
												'kd_rkm' =>$ambil_rkm_obj[0]->kd_rkm
										)
									);
			$this->Kesehatan_M->delete(
									'proses_antrian',
									array(
											'nomor_pasien'	=>	$nomor_pasien
									));
		}
		$this->Kesehatan_M->delete(
									'antrian',
									array(
											'nomor_pasien'	=>	$nomor_pasien
									));
		redirect(base_url()."Petugas/menu/antrian");
	}
}