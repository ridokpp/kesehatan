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
			redirect();
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
			$data['tes_buta_warna']		= $this->input->post('tes_buta_warna');
			$data['keperluan']			= $this->input->post('keperluan');
			$data['tinggi_badan']		= $this->input->post('tinggi_badan');
			$data['berat_badan']		= $this->input->post('berat_badan');
			$data['sistol']				= $this->input->post('sistol');
			$data['diastol']			= $this->input->post('diastol');
			$data['nadi']				= $this->input->post('nadi');
			$data['respiratory_rate']	= $this->input->post('respiratory_rate');
			$data['temperature_ax']		= $this->input->post('temperature_ax');

			// nama dokter yang menangani
			$data['nama_user']		= $this->session->userdata('logged_in')['nama_user'];

			// sip dokter yang menangani
			$data['sip']			= $this->session->userdata('logged_in')['sip'];
			
			// data pasien yang sedang diperiksa
			$data['pasien']			= $this->Kesehatan_M->read('pasien',array('nomor_pasien'=>$data['nomor_pasien']))->result();
			
			// $data['rekam_medis']	= $this->Kesehatan_M->rawQuery("SELECT tinggi_badan,berat_badan,sistol,diastol,nadi,respiratory_rate,temperature_ax FROM rekam_medis WHERE nomor_pasien = ".$data['nomor_pasien']." ORDER BY id DESC LIMIT 1")->result();

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
			$data['pasien']			= $this->Kesehatan_M->read('pasien',array('nomor_pasien'=>$this->input->post('nomor_pasien')))->result();

			$gcs = "E: ".$this->input->post('gcs_e')." V: ".$this->input->post('gcs_v')." M: ".$this->input->post('gcs_m');
			if ($this->input->post('$gcs_opsi[]') !== NULL) {
				foreach ($this->input->post('$gcs_opsi[]') as $key => $value) {
					$gcs .= $value.",";
				}
				$gcs = rtrim($gcs,", ");

			}

			$data['hasil_pemeriksaan']	= array(
													'gcs_evm_opsi'
			);
			echo "<pre>";
			var_dump($gcs);
			// var_dump($data);
			var_dump($this->input->post());
			die();
			
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
			/*NOTE : jantung nggk perlu di manipulasi string karena setiap input field korelasi 1-1 dengan kolom*/

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

			
			$planning = $this->input->post('planning').". ";
			/*ekstrak value dari select2, pisahkan id beserta nama obatnya agar tidak baca lagi di database. nama obat disertakan untuk keperluan penambahan kolom planning*/
				$id_obat = array();
				$nama_obat = array();

				foreach ($this->input->post('obat') as $key => $value) {
					$temp = explode("|", $value);
					array_push($id_obat, $temp[0]);
					array_push($nama_obat, $temp[1]);
				}
			/*end ekstrak value dari select2, pisahkan id beserta nama obatnya agar tidak baca lagi di database. nama obat disertakan untuk keperluan penambahan kolom planning*/
			

			/*untuk setiap obat, lakukan pengurangan stok pada tabel logistik. dan juga lakukan penggabungan string ke $planning*/
				foreach ($id_obat as $key => $value) {
					$planning .= $nama_obat[$key]." ".$this->input->post('jumlah_obat')[$key]." ".$this->input->post('satuan')[$key].". ";
					$this->Kesehatan_M->rawQuery("UPDATE logistik SET stok = stok - ".$this->input->post('jumlah_obat')[$key]." WHERE id=$value");
				}
			/*end untuk setiap obat, lakukan pengurangan stok pada tabel logistik*/

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
								'planning'					=>	$planning
							);

			// insert ke tabel assessment
			$insertIntoRekamMedis = $this->Kesehatan_M->create('rekam_medis',$record);
			$insertIntoRekamMedis = json_decode($insertIntoRekamMedis);

			if ($insertIntoRekamMedis->status) {
				$this->Kesehatan_M->delete('proses_antrian',array('nomor_pasien'=>$this->input->post('nomor_pasien')));
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
		$queryInsert['nama'] = ucwords($this->input->post('nama'));
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
	function submitEditLogistik()
	{
		$execQueryEdit = $this->Kesehatan_M->update('logistik',array('id'=>$this->input->post('id')),array("nama"=>$this->input->post("nama"),"stok"=>$this->input->post('stok'),"satuan"=>$this->input->post('satuan'),"kadaluarsa"=>$this->input->post("kadaluarsa")));
		if ($execQueryEdit) {
			alert('alert','success','Berhasil','Data berhasil diedit');
			redirect("Dokter/logistik");
		}else{
			var_dump($execQueryEdit);
		}
	}


	/*
	* funtion untuk handle form submit delete logistik obat
	*/
	function submitDeleteLogistik()
	{
		$execQueryDelete = $this->Kesehatan_M->delete('logistik',array('id'=>$this->input->post('id')));
		if ($execQueryDelete) {
			alert('alert','success','Berhasil','Data berhasil dihapus');
			redirect("Dokter/logistik");
		}else{
			var_dump($execQueryDelete);
		}
	}



	/*
	* funtion untuk handle form submit add stok logistik
	*/
	function submitAddStok()
	{
		# code...
	}

	/*
	* funtion untuk menangani ajax request cari obat
	*/
	function cariObat()
	{
		if ($this->input->get() != NULL) {
			$dataForm = $this->input->get();
			
			$dataReturn = $this->db->query(" SELECT * FROM logistik WHERE nama LIKE '%".$dataForm['term']['term']."%' ESCAPE '!' AND stok > 0")->result();			

			$data = array();
			foreach ($dataReturn as $key => $value) {
				$data[$key]['id'] = $value->id."|".$value->nama;
				$data[$key]['text'] = $value->nama;
				$data[$key]['stok'] = $value->stok;
				if ($value->kadaluarsa < date("Y-m-d-d")) {
					$data[$key]['stok'] .= " Sudah kadaluarsa";
				}
				$data[$key]['satuan'] = $value->satuan;
			}
			echo json_encode($data);
		}else{
			redirect();
		}		
	}

}