<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller {

	/*
	* saat ganti hari, lakukan truncate table antrian dan proses karena live antrian
	*/
	function __construct(){
		parent::__construct();
		$this->load->model('Kesehatan_M');
		date_default_timezone_set("Asia/Jakarta");
		if ($this->session->userdata('logged_in')['akses'] != '2' ){
			redirect("Account/logout");
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
			$data['rekam_medis'] = $this->Kesehatan_M->read('rekam_medis',
																			array('nomor_pasien'		=>	$nomor_pasien,
																				'MONTH(tanggal_jam)'=>	date('m'),
																				'YEAR(tanggal_jam)'	=>	date('Y'),
																				'DAY(tanggal_jam)'	=>	date('d')
																			))->result();
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
	* untuk menampilkan halaman cetak
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
	function antrian(){
		// baca antrian yang tersedia, tampilkan nama dan waktu datang
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/antri');
		$this->load->view('static/footer');
	}

	/*
	* function untuk menampilkan rekam medis pasien melalui pencarian nama atau nomor pasien mirip degan petugas.
	*/
	function cariPasien()
	{
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/cari_pasien');
		$this->load->view('static/footer');
	}

	/*
	* funtion untuk menampilkan halaman tambah antrian
	*/
	function pemeriksaanLangsung()
	{
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/tambah_antrian');
		$this->load->view('static/footer');
	}

	/*
	* function untuk mambaca rekam mesdis setiap pasien
	*/
	function rekamMedis($nomor_pasien)
	{

	}

	/*
	* cari nama pasien via ajax
	*/
	function cariNama()
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
			redirect("Dokter/pemeriksaan/".$this->input->get('nama_or_nomor'));
		}else{
			redirect(base_url());
		}
	}

	/*
	* function untuk menampilkan halaman logistik
	*/
	function logistik()
	{
		$data['logistik'] = $this->Kesehatan_M->readS('logistik')->result();
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('dokter/logistik',$data);

		$this->load->view('static/footer');
	}

	/*
	* cetak surat sakit,sehat dan rujukan
	*/
	function submitCetak($surat)
	{
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$data['nomor_pasien']	= $this->input->post('nomor_pasien');
		if ($surat == 'suratsehat') {
			$data['tes_buta_warna']	= $this->input->post('tes_buta_warna');
			$data['keperluan']	= $this->input->post('keperluan');
			$data['nama_user']		= $this->session->userdata('logged_in')['nama_user'];
			$data['sip']			= $this->session->userdata('logged_in')['sip'];
			$data['pasien']			= $this->Kesehatan_M->read('pasien',array('nomor_pasien'=>$data['nomor_pasien']))->result();
			$data['rkm_medis']		= $this->Kesehatan_M->readCol('rkm_medis',array('kd_pasien'=>$data['nomor_pasien'],'DATE(tgl_jam)'=>date('Y-m-d')),array('kd_objek'))->result();
			$data['objek']			= $this->Kesehatan_M->read('objek',array('kd_objek'=>$data['rkm_medis'][0]->kd_objek))->result();

			$nomor_surat 			= $this->Kesehatan_M->readCol('suratsehat',array('MONTH(tanggal_terbit)'=>date('m'),'YEAR(tanggal_terbit)'=>date('Y')),array('MAX(nomor_surat) AS nomor_surat'))->result();
			$insertSuratSehat['nomor_pasien']		= $data['nomor_pasien'];
			$insertSuratSehat['keperluan']			= $data['keperluan'];
			$insertSuratSehat['tes_buta_warna']		= $data['tes_buta_warna'];
			$insertSuratSehat['tanggal_terbit']		= date('Y-m-d');
			
			if ($nomor_surat == array()) {
				$insertSuratSehat['nomor_surat']	= 1;
				$data['nomor_surat'] 				= 1;
			}else{
				$insertSuratSehat['nomor_surat'] 	= intval($nomor_surat[0]->nomor_surat) + 1;
				$data['nomor_surat']				= $insertSuratSehat['nomor_surat'];
			}
			$this->Kesehatan_M->create('suratsehat',$insertSuratSehat);
			$kode_surat = "001";
			
			
		}elseif ($surat == 'suratsakit') {
			$data['alasan']		 	= $this->input->post('alasan');
			$data['tanggal_awal'] 	= $this->input->post('tanggal_awal');
			$data['tanggal_akhir'] 	= $this->input->post('tanggal_akhir');
			$data['selama'] 		= $this->input->post('selama');
			$data['selama_satuan'] 	= $this->input->post('selama_satuan');
			$data['nama_user']		= $this->session->userdata('logged_in')['nama_user'];
			$data['sip']			= $this->session->userdata('logged_in')['sip'];
			$data['pasien']			= $this->Kesehatan_M->read('pasien',array('nomor_pasien'=>$data['nomor_pasien']))->result();
			
			$nomor_surat = $this->Kesehatan_M->readCol('suratsakit',array('MONTH(tanggal_awal)'=>date('m'),'YEAR(tanggal_awal)'=>date('Y')),array('MAX(nomor_surat) AS nomor_surat'))->result();
			$insertSuratSakit['nomor_pasien']	= $data['nomor_pasien'];
			$insertSuratSakit['alasan']			= $data['alasan'];
			$insertSuratSakit['tanggal_awal']	= $data['tanggal_awal'];
			$insertSuratSakit['tanggal_akhir'] 	= $data['tanggal_akhir'];
			if ($nomor_surat == array()) {
				$insertSuratSakit['nomor_surat']	= 1;
				$data['nomor_surat'] 				= 1;
			}else{
				$insertSuratSakit['nomor_surat'] 	= intval($nomor_surat[0]->nomor_surat) + 1;
				$data['nomor_surat']				= $insertSuratSakit['nomor_surat'];
			}
			$this->Kesehatan_M->create('suratsakit',$insertSuratSakit);
			$kode_surat = "002";
			

		}elseif ($surat == 'suratrujukan') {

			
			$data['nama_user']		= $this->session->userdata('logged_in')['nama_user'];
			$data['sip']			= $this->session->userdata('logged_in')['sip'];
			$data['pasien']			= $this->Kesehatan_M->read('pasien',array('nomor_pasien'=>$data['nomor_pasien']))->result();
			$data['rkm_medis']		= $this->Kesehatan_M->readCol('rkm_medis',array('kd_pasien'=>$data['nomor_pasien'],'DATE(tgl_jam)'=>date('Y-m-d')),array('kd_objek'))->result();
			$data['objek']			= $this->Kesehatan_M->read('objek',array('kd_objek'=>$data['rkm_medis'][0]->kd_objek))->result();

			$dataKepala['anemis_kiri'] 		= $this->input->post('anemis_kiri');
			$dataKepala['anemis_kanan'] 	= $this->input->post('anemis_kanan');
			$dataKepala['ikterik_kiri'] 	= $this->input->post('ikterik_kiri');
			$dataKepala['ikterik_kanan'] 	= $this->input->post('ikterik_kanan');
			$dataKepala['cianosis_kiri'] 	= $this->input->post('cianosis_kiri');
			$dataKepala['cianosis_kanan'] 	= $this->input->post('cianosis_kanan');
			$dataKepala['deformitas_kiri']	= $this->input->post('deformitas_kiri');
			$dataKepala['deformitas_kanan']	= $this->input->post('deformitas_kanan');
			$dataKepala['refchy_kiri'] 		= $this->input->post('refchy_kiri');
			$dataKepala['refchy_kanan'] 	= $this->input->post('refchy_kanan');
			$dataKepala['refchyopsi'] 		= $this->input->post('refchy_opsi');
			$dataKepala['ket_tambahan']		= $this->input->post('ket_tambahankpl');
			$data['kd_kepala']				= json_decode($this->Kesehatan_M->create_id('kepala',$dataKepala));
			$data['kd_kepala']				= $data['kd_kepala']->message;
			
			$dataThorak['metris'] 			= $this->input->post('metris');
			$dataThorak['wheezing_kiri'] 	= $this->input->post('wheezing_kiri');
			$dataThorak['wheezing_kanan'] 	= $this->input->post('wheezing_kanan');
			$dataThorak['ronkhi_kiri'] 		= $this->input->post('ronkhi_kiri');
			$dataThorak['ronkhi_kanan'] 	= $this->input->post('ronkhi_kanan');
			$dataThorak['vesikuler_kiri'] 	= $this->input->post('vesikuler_kiri');
			$dataThorak['vesikuler_kanan']	= $this->input->post('vesikuler_kanan');
			$dataThorak['jantung_icor'] 	= $this->input->post('jantung_icor');
			$dataThorak['s1_s2']			= $this->input->post('s1_s2');
			$dataThorak['s_tambahan'] 		= $this->input->post('s_tambahan');
			$dataThorak['ket_tambahan'] 	= $this->input->post('ket_tambahantr');
			$data['kd_thorak']				= json_decode($this->Kesehatan_M->create_id('thorak',$dataThorak));
			$data['kd_thorak']				= $data['kd_thorak']->message;

			$dataAbdomen['BU'] 				= $this->input->post('BU');
			$dataAbdomen['ny1'] 			= $this->input->post('ny1');
			$dataAbdomen['ny2'] 			= $this->input->post('ny2');
			$dataAbdomen['ny3'] 			= $this->input->post('ny3');
			$dataAbdomen['ny4'] 			= $this->input->post('ny4');
			$dataAbdomen['ny5'] 			= $this->input->post('ny5');
			$dataAbdomen['ny6'] 			= $this->input->post('ny6');
			$dataAbdomen['ny7'] 			= $this->input->post('ny7');
			$dataAbdomen['ny8'] 			= $this->input->post('ny8');
			$dataAbdomen['ny9'] 			= $this->input->post('ny9');
			$dataAbdomen['hpmgl'] 			= $this->input->post('hpmgl');
			$dataAbdomen['spmgl'] 			= $this->input->post('spmgl');
			$dataAbdomen['ket_tambahan']	= $this->input->post('ket_tambahanab');
			$data['kd_abdomen']				= json_decode($this->Kesehatan_M->create_id('abdomen',$dataAbdomen));
			$data['kd_abdomen']				= $data['kd_abdomen']->message;	

			$dataEkstermitas['ah1']			= $this->input->post('ah1');
			$dataEkstermitas['ah2']			= $this->input->post('ah2');
			$dataEkstermitas['ah3']			= $this->input->post('ah3');
			$dataEkstermitas['ah4']			= $this->input->post('ah4');
			$dataEkstermitas['crt1']		= $this->input->post('crt1');
			$dataEkstermitas['crt2']		= $this->input->post('crt2');
			$dataEkstermitas['crt3']		= $this->input->post('crt3');
			$dataEkstermitas['crt4']		= $this->input->post('crt4');
			$dataEkstermitas['edm1']		= $this->input->post('edm1');
			$dataEkstermitas['edm2']		= $this->input->post('edm2');
			$dataEkstermitas['edm3']		= $this->input->post('edm3');
			$dataEkstermitas['edm4']		= $this->input->post('edm4');
			$dataEkstermitas['pitting'] 	= $this->input->post('pitting');
			$dataEkstermitas['ket_tambahan']= $this->input->post('ket_tambahaneks');
			$data['kd_ekstermitas'] 		= json_decode($this->Kesehatan_M->create_id('ekstermitas',$dataEkstermitas));
			$data['kd_ekstermitas'] 		= $data['kd_ekstermitas']->message;

			$dataTerapi['terapi1'] 			= $this->input->post('terapi1');
			$dataTerapi['terapi2'] 			= $this->input->post('terapi2');
			$dataTerapi['terapi3'] 			= $this->input->post('terapi3');
			$data['kd_terapi'] 				= json_decode($this->Kesehatan_M->create_id('terapi',$dataTerapi));
			$data['kd_terapi'] 				= $data['kd_terapi']->message;

			$dataHeadtotoe['keluhan'] 		= $this->input->post('keluhan');
			$dataHeadtotoe['GCS_E'] 		= $this->input->post('GCS_E');
			$dataHeadtotoe['GCS_V'] 		= $this->input->post('GCS_V');
			$dataHeadtotoe['GCS_M'] 		= $this->input->post('GCS_M');
			
			$GCS_opsi				 		= $this->input->post('GCS_opsi[]');
			$dataHeadtotoe['GCS_opsi'] = '';
			foreach ($GCS_opsi as $key => $value) {
				$dataHeadtotoe['GCS_opsi'] .= $value." ";
			}

			$dataHeadtotoe['kd_kepala'] 	= $data['kd_kepala'];
			$dataHeadtotoe['kd_thorak'] 	= $data['kd_thorak'];
			$dataHeadtotoe['kd_abdomen']	= $data['kd_abdomen'];
			$dataHeadtotoe['kd_ekstermitas']= $data['kd_ekstermitas'];
			$dataHeadtotoe['lain_lain']		= $this->input->post('lain_lain');
			$dataHeadtotoe['kd_terapi'] 	= $data['kd_terapi'];
			$data['kd_headtotoe'] 			= json_decode($this->Kesehatan_M->create_id('headtotoe',$dataHeadtotoe));


			$data['kepala'] 				= $dataKepala;
			$data['thorak'] 				= $dataThorak;
			$data['abdomen'] 				= $dataAbdomen;
			$data['ekstermitas'] 			= $dataEkstermitas;
			$data['headtotoe'] 				= $dataHeadtotoe;
			$data['terapi'] 				= $dataTerapi;


			$nomor_surat 							= $this->Kesehatan_M->readCol('suratrujukan',array(
																										'MONTH(tanggal)'	=>date('m'),
																										'YEAR(tanggal)'		=>date('Y')
																								),array(
																										'MAX(nomor_surat) AS nomor_surat'
																								)
																				)->result();
			$insertSuratRujukan['nomor_pasien']		= $data['nomor_pasien'];

			$insertSuratRujukan['kd_objek']			= $data['objek'][0]->kd_objek;
			$insertSuratRujukan['kd_headtotoe']		= $data['kd_headtotoe']->message;
			$insertSuratRujukan['tanggal']			= date('Y-m-d');

			// update ke tabel objek untuk set kd_headtotoe karena headtotoe buan lagi text, lebih detil.
			$this->Kesehatan_M->update('objek',array('kd_objek'=>$insertSuratRujukan['kd_objek']),array('kd_headtotoe' => $data['kd_headtotoe']->message));

			
			if ($nomor_surat == array()) {
				$insertSuratRujukan['nomor_surat']	= 1;
				$data['nomor_surat'] 				= 1;
			}else{
				$insertSuratRujukan['nomor_surat'] 	= intval($nomor_surat[0]->nomor_surat) + 1;
				$data['nomor_surat']				= $insertSuratRujukan['nomor_surat'];
			}

			// masukkan data ke surat rujukan
			$data['nomor_surat'] 	= json_decode($this->Kesehatan_M->create_id('suratrujukan',$insertSuratRujukan));
			$data['nomor_surat'] 	= $data['nomor_surat']->message;
			$data['GCS_opsi'] 		= $this->input->post('GCS_opsi');


			// ambil value bagian diagnosa dari modal form. masing masing variabel berupa array. diagnosa yang diambiil hanya digunakan untuk pencetakan semata. tidak masuk ke database
			$data['diagnosaPrimer']				= $this->input->post('diagnosaPrimary[]');
			$data['diagnosaSekunder'] 			= $this->input->post('diagnosaSecondary[]');
			$data['diagnosaLain'] 				= $this->input->post('diagnosaLain[]');
			$data['diagnosaPemeriksaanLab'] 	= $this->input->post('diagnosaPemeriksaanLab');
			$kode_surat = "003";
			
		}
		$this->load->view('dokter/'.$surat,$data);
		$this->load->view('static/footer');
		$content = '';
		$content .= $this->load->view('static/header','',TRUE);
		$content .= $this->load->view('static/navbar','',TRUE);
		$content .= $this->load->view('dokter/'.$surat,$data,TRUE);
		$content .= $this->load->view('static/footer','',TRUE);

		$folder 	= FCPATH."/surat pasien/".$data['nomor_pasien']."/".$surat."/";
		if (!file_exists($folder)) {
			mkdir($folder, 0777, true);
		}
		$myfolder = fopen($folder."0".$data['nomor_surat']."-".$kode_surat."-0".date('m')."-2018.html", "w");
		fwrite($myfolder, $content);
		fclose($myfolder);
	}

	/*
	* function untuk lihat antrian secara live di halaman antrian
	*/
	function liveAntrian()
	{
		$data['antrian']		=	$this->Kesehatan_M->rawQuery('
																	SELECT 
																		pasien.nama, 
																		antrian.jam_datang, 
																		antrian.nomor_antrian, 
																		pasien.pembayaran, 
																		pasien.nomor_pasien 
																	FROM antrian 
																	INNER JOIN pasien on antrian.nomor_pasien=pasien.nomor_pasien
																	WHERE DATE(jam_datang) = DATE(CURRENT_DATE()) ORDER BY jam_datang
																')->result();
			
		$data['proses_antrian']	=	$this->Kesehatan_M->rawQuery('
																SELECT 
																	proses_antrian.nomor_pasien,
																	pasien.nama, 
																	pasien.pembayaran 
																FROM proses_antrian 
																INNER JOIN pasien on proses_antrian.nomor_pasien=pasien.nomor_pasien
															')->result();
		echo json_encode($data);
	}

	/*
	* function untuk mengontrol antrian selain oleh petugas
	*/
	function submitAntrian($aksi,$nomor_pasien)
	{
		$this->Kesehatan_M->delete(
									'antrian',
									array(
											'nomor_pasien'	=>	$nomor_pasien
									));
		if ($aksi == 'proses') {
			$this->Kesehatan_M->create(
										'proses_antrian',
										array(
												'nomor_pasien'	=>	$nomor_pasien
										)
									);
			redirect("Dokter/pemeriksaan/$nomor_pasien");
		}elseif ($aksi == 'hapus') {
			$jon = $this->Kesehatan_M->rawQuery("
										DELETE FROM rekam_medis WHERE 
													nomor_pasien='$nomor_pasien' 
													AND DAY(tanggal_jam) ='".date('d')."' 
													AND MONTH(tanggal_jam) = '".date('m')."' 
													AND YEAR(tanggal_jam) ='".date('Y')."'
													ORDER BY id DESC LIMIT 1"
									);
			$this->Kesehatan_M->delete('antrian',array('nomor_pasien'=>$nomor_pasien));
			$this->Kesehatan_M->delete('proses_antrian',array('nomor_pasien'=>$nomor_pasien));
			redirect("Dokter/antrian");
		}
	}

	/*
	* get nomor surat untuk disalurkan ke kolom planning
	*/
	function getTabelSurat($surat,$nomor_pasien)
	{
		// select * from suratrujukan WHERE nomor_pasien='001-006-01-02-07-2018' ORDER BY id DESC limit 1 ;
		// sebelumnya telah dibuatkan data pada tabel surat rujukan, actionnya saat klink tombol surat rujukan pada pemeriksaan
		$data = json_encode($this->Kesehatan_M->rawQuery("SELECT * FROM surat".$surat." WHERE nomor_pasien='".$nomor_pasien."' ORDER BY id DESC limit 1 ")->result());
		echo $data;
	}


	// Fungsi ini digunakan untuk mencari data pada tabel ICD 10
	function cariICD()
	{
		if ($this->input->get() != NULL) {
			$dataForm = $this->input->get();
			$dataReturn = $this->Kesehatan_M->orLike('icd10',array('Diagnosa'=>$dataForm['term']['term'],'Diskripsi'=>$dataForm['term']['term']))->result();
			$data = array();
			foreach ($dataReturn as $key => $value) {
				$data[$key]['id'] = $value->Kode_ICD. " / ".$value->Diskripsi;
				$data[$key]['text'] = $value->Kode_ICD." / ".$value->Diskripsi;
			}
			echo json_encode($data);
		}else{
			redirect(base_url());
		}
	}

	/*
	* funtion untuk update rekam_medis (submit pemeriksaan)
	*/
	function submitPemeriksaan()
	{
		if ($this->input->post() !== array()) {

			$gcs = "E: ".$this->input->post('gcs_e')." V: ".$this->input->post('gcs_v')." M: ".$this->input->post('gcs_m');
			if ($this->input->post('$gcs_opsi[]') !== NULL) {
				foreach ($this->input->post('$gcs_opsi[]') as $key => $value) {
					$gcs .= $value.",";
				}
				$gcs = rtrim($gcs,", ");

			}
			/*kepala*/
				$kepala = " Anemis ";
				if ($this->input->post('anemis_kiri') == '1') {
					$kepala .= "+";
				}else{
					$kepala .= " ";
				}
				$kepala .= "/";
				if ($this->input->post('anemis_kanan') == '1') {
					$kepala .= "+";
				}else{
					$kepala .= " ";
				}

				$kepala .= " Ikterik ";
				if ($this->input->post('ikterik_kiri') == '1') {
					$kepala .= "+";
				}else{
					$kepala .= " ";
				}
				$kepala .= "/";
				if ($this->input->post('ikterik_kanan') == '1') {
					$kepala .= "+";
				}else{
					$kepala .= " ";
				}

				$kepala .= " Cianosis ";
				if ($this->input->post('cianosis_kiri') == '1') {
					$kepala .= "+";
				}else{
					$kepala .= " ";
				}
				$kepala .= "/";
				if ($this->input->post('cianosis_kanan') == '1') {
					$kepala .= "+";
				}else{
					$kepala .= " ";
				}

				$kepala .= " Deformitas ";
				if ($this->input->post('deformitas_kiri') == '1') {
					$kepala .= "+";
				}else{
					$kepala .= " ";
				}
				$kepala .= "/";
				if ($this->input->post('deformitas_kanan') == '1') {
					$kepala .= "+";
				}else{
					$kepala .= " ";
				}

				$kepala .= " Refleks cahaya ";
				if ($this->input->post('refchy_kiri') == '1') {
					$kepala .= "+";
				}else{
					$kepala .= " ";
				}
				$kepala .= "/";
				if ($this->input->post('refchy_kanan') == '1') {
					$kepala .= "+";
				}else{
					$kepala .= " ";
				}
			/*end kepala*/

			/*paru*/
				$paru = "Wheezing ";
				if ($this->input->post('wheezing_kiri') == '1') {
					$paru .= "+";
				}else{
					$paru .= " ";
				}
				$paru .= "/";
				if ($this->input->post('wheezing_kanan') == '1') {
					$paru .= "+";
				}else{
					$paru .= " ";
				}

				$paru .= " Ronkhi ";
				if ($this->input->post('ronkhi_kiri') == '1') {
					$paru .= "+";
				}else{
					$paru .= " ";
				}
				$paru .= "/";
				if ($this->input->post('ronkhi_kanan') == '1') {
					$paru .= "+";
				}else{
					$paru .= " ";
				}

				$paru .= " Vesikuler ";
				if ($this->input->post('vesikuler_kiri') == '1') {
					$paru .= "+";
				}else{
					$paru .= " ";
				}
				$paru .= "/";
				if ($this->input->post('vesikuler_kanan') == '1') {
					$paru .= "+";
				}else{
					$paru .= " ";
				}
			/*end paru*/


			/*insert ke tabel assesmet*/
			if ($this->input->post('assessmentPrimer') !== NULL OR $this->input->post('assessmentSekunder') !== NULL OR $this->input->post('assessmentLain') !== NULL OR $this->input->post('assessmentPemeriksaanLab') !== NULL) {
				
				// 1. baca available available_id_assessment di tabel available_id_assessment
				$available_id_assessment = $this->Kesehatan_M->readS('available_id_assessment')->result();
				$available_id_assessment = $available_id_assessment[0]->available_id_assessment;

				// 2. segera update available_id_assessment di tabel available_id_assessment. agar saat digunakan oleh dokter lain tidak crash
				$this->Kesehatan_M->rawQuery("UPDATE available_id_assessment SET available_id_assessment = available_id_assessment + 1 WHERE available_id_assessment ='$available_id_assessment'");

				// 3. masukkan assessment inputan ke tabel assessment disertai available id yang sudah diambil
					$stringDiagnosa 			= "INSERT INTO assessment VALUES ";
					if ($this->input->post('assessmentPrimer') != array()) {
						foreach ($this->input->post('assessmentPrimer') as $key => $value) {
							$stringDiagnosa		 	.= "(NULL,'$available_id_assessment','primer','$value'),";
						}
					}
					// manipulasi string untuk masuk ke assessment. tipenya sekunder
					if ($this->input->post('assessmentSekunder') != array()) {
						foreach ($this->input->post('assessmentSekunder') as $key => $value) {
							$stringDiagnosa 		.= "(NULL,'$available_id_assessment','sekunder','$value'),";
						}
					}
					// manipulasi string untuk masuk ke assessment. tipenya lainlain
					if ($this->input->post('assessmentLain') != array()) {
						foreach ($this->input->post('assessmentLain') as $key => $value) {
							$stringDiagnosa 	 	.= "(NULL,'$available_id_assessment','lainlain','$value'),";
						}
					}
					// manipulasi string untuk masuk ke assessment. tipenya adalah pemeriksaan lab
					if ($this->input->post('assessmentPemeriksaanLab') != '') {
						$stringDiagnosa				.= "(NULL,'$available_id_assessment','pemeriksaanLab','".$this->input->post('assessmentPemeriksaanLab')."'),";
					}
					$stringDiagnosa				= rtrim($stringDiagnosa,",");
					
					// masukkan kd_assessment beserta data pemeriksaan primer sekunder lainlain pememeriksaan lab ke tabel assessment
					$this->Kesehatan_M->rawQuery($stringDiagnosa);

			}
			/*end insert ke tabel assesmet*/

			$record = array(
								'nomor_pasien'				=>	$this->input->post('nomor_pasien'),
								'tanggal_jam'				=>	date('Y-m-d H:i:s'),
								'subjektif'					=>	$this->input->post('subjektif'),
								'gcs_evm_opsi'				=>	$gcs,
								'tinggi_badan'				=>	$this->input->post('tinggi_badan'),
								'berat_badan'				=>	$this->input->post('berat_badan'),
								'sistol'					=>	$this->input->post('sistol'),
								'diastol'					=>	$this->input->post('diastol'),
								'nadi'						=>	$this->input->post('nadi'),
								'respiratory_rate'			=>	$this->input->post('respiratory_rate'),
								'temperature_ax'			=>	$this->input->post('temperature_ax'),
								'headtotoe'					=>	$this->input->post('headtotoe'),
								'kepala'					=>	$kepala,
								'kepala_isokor_anisokor'	=>	$this->input->post('refchy_opsi'),
								'kepala_ket_tambahan'		=>	$this->input->post('kepala_ket_tambahan'),
								'paru_simetris_asimetris'	=>	$this->input->post('paru_simetris_asimetris'),
								'paru'						=>	$paru,
								'jantung_ictuscordis'		=>	$this->input->post('jantung_ictuscordis'),
								'jantung_s1_s2'				=>	$this->input->post('jantung_s1_s2'),
								'jantung_suaratambahan'		=>	$this->input->post('jantung_suaratambahan'),
								'thorak_ket_tambahan'		=>	$this->input->post('thorak_ket_tambahan'),
								'abdomen_BU'				=>	$this->input->post('BU'),
								'nyeri_tekan1'				=>	$this->input->post('nyeri_tekan1'),
								'nyeri_tekan2'				=>	$this->input->post('nyeri_tekan2'),
								'nyeri_tekan3'				=>	$this->input->post('nyeri_tekan3'),
								'nyeri_tekan4'				=>	$this->input->post('nyeri_tekan4'),
								'nyeri_tekan5'				=>	$this->input->post('nyeri_tekan5'),
								'nyeri_tekan6'				=>	$this->input->post('nyeri_tekan6'),
								'nyeri_tekan7'				=>	$this->input->post('nyeri_tekan7'),
								'nyeri_tekan8'				=>	$this->input->post('nyeri_tekan8'),
								'nyeri_tekan9'				=>	$this->input->post('nyeri_tekan9'),
								'hepatomegali'				=>	$this->input->post('hepatomegali'),
								'spleenomegali'				=>	$this->input->post('spleenomegali'),
								'abdomen_ket_tambahan'		=>	$this->input->post('abdomen_ket_tambahan'),
								'akral_hangat1'				=>	$this->input->post('akral_hangat1'),
								'akral_hangat2'				=>	$this->input->post('akral_hangat2'),
								'akral_hangat3'				=>	$this->input->post('akral_hangat3'),
								'akral_hangat4'				=>	$this->input->post('akral_hangat4'),
								'crt_1'						=>	$this->input->post('crt_1'),
								'crt_2'						=>	$this->input->post('crt_2'),
								'crt_3'						=>	$this->input->post('crt_3'),
								'crt_4'						=>	$this->input->post('crt_4'),
								'edema_1'					=>	$this->input->post('edema_1'),
								'edema_2'					=>	$this->input->post('edema_2'),
								'edema_3'					=>	$this->input->post('edema_3'),
								'edema_4'					=>	$this->input->post('edema_4'),
								'pitting_nonpitting'		=>	$this->input->post('pitting_nonpitting'),
								'ekstermitas_ket_tambahan'	=>	$this->input->post('ekstermitas_ket_tambahan'),
								'lain_lain'					=>	$this->input->post('lain_lain'),
								'id_assessment'				=>	$available_id_assessment,
								'terapi_1'					=>	$this->input->post('terapi_1'),
								'terapi_2'					=>	$this->input->post('terapi_2'),
								'terapi_3'					=>	$this->input->post('terapi_3'),
								'dokter_pemeriksa'			=>	$this->session->userdata('logged_in')['id_user'],
								'planning'					=>	$this->input->post('planning')
							);

			// insert ke tabel assessment
			$insertIntoRekamMedis = $this->Kesehatan_M->create('rekam_medis',$record);
			$insertIntoRekamMedis = json_decode($insertIntoRekamMedis);

			if ($insertIntoRekamMedis->status) {
				$this->Kesehatan_M->delete('proses_antrian',array('nomor_pasien'=>$nomor_pasien));
				alert('alert','success','Berhasil','Data berhasil dimasukkan');
				redirect("Dokter/antrian");
			}else{
				alert('alert','success','Gagal','Kegagalan database'.$result->error_message);
				redirect("Dokter/pemeriksaan/$this->input->post[nomor_pasien]");
			}

		}else{
			$data['heading']	= "Halaman tidak ditemukan";
			$data['message']	= "<p> Tidak ada data yang di post</p>";
			$this->load->view('errors/html/error_404',$data);
		}
	}

	/*
	* funtion untuk handle form submit add logistik obat
	*/
	function submitAddLogistik()
	{
		$queryInsert['nama'] = $this->input->post('nama');
		$queryInsert['stok'] = $this->input->post('stok');
		$queryInsert['satuan'] = $this->input->post('satuan');
		$queryInsert['kadaluarsa'] = $this->input->post('kadaluarsa');
		
		// cek adakah duplikasi nama obat
		$cekDuplikasiObat = $this->Kesehatan_M->read('logistik',array('nama' => $queryInsert['nama']));
		if ($cekDuplikasiObat->num_rows() == 0) {
			$execQueryInsert = $this->Kesehatan_M->create('logistik',$queryInsert);
			$execQueryInsert = json_decode($execQueryInsert);
			if ($execQueryInsert->status) {
				alert('alert','success','Berhasil','Data berhasil dimasukkan');
				redirect("Dokter/logistik");
			}else{
				var_dump($execQueryInsert->message);
			}
		}else{
			alert('alert','danger','Gagal','Obat sudah ada');
			redirect("Dokter/logistik");
		}

	}

	/*
	* funtion untuk handle form submit add stok logistik
	*/
	function submitAddStok()
	{
		# code...
	}

}