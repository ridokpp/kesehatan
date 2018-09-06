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
			$this->load->view('dokter/suratsakit',$data);

		}elseif ($surat == 'suratrujukan') {

			$data['nomor_pasien']	= $this->input->post('kd_pasien');
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



			// baca kd_assessment paling maksimal pada tabel clone_diagnosa
			$kd_assessmentMax = $this->Kesehatan_M->rawQuery("SELECT MAX(kd_assessment) AS kd_assessment FROM clone_diagnosa")->result();

			// set nilai kd_assessment yang akan masuk ke tabel assessment
			if($kd_assessmentMax[0]->kd_assessment == NULL){
				$kd_assessment = 1;
			}else{
				$kd_assessment = $kd_assessmentMax[0]->kd_assessment + 1;
			}

			// ambil value bagian diagnosa dari modal form. masing masing variabel berupa array
			$data['diagnosaPrimer'] 			= $this->input->post('diagnosaPrimary[]');
			$data['diagnosaSekunder'] 			= $this->input->post('diagnosaSecondary[]');
			$data['diagnosaLain'] 				= $this->input->post('diagnosaLain[]');
			$data['diagnosaPemeriksaanLab'] 	= $this->input->post('diagnosaPemeriksaanLab');

			// manipulasi string untuk masuk ke clone_diagnosa. tipenya primer
			$stringDiagnosa 			= "INSERT INTO clone_diagnosa VALUES";
			foreach ($data['diagnosaPrimer'] as $key => $value) {
				$stringDiagnosa		 	.= "(NULL,'$kd_assessment','primer','$value'),";
			}

			// manipulasi string untuk masuk ke clone_diagnosa. tipenya sekunder
			foreach ($data['diagnosaSekunder'] as $key => $value) {
				$stringDiagnosa 		.= "(NULL,'$kd_assessment','sekunder','$value'),";
			}

			// manipulasi string untuk masuk ke clone_diagnosa. tipenya lainlain
			foreach ($data['diagnosaLain'] as $key => $value) {
				$stringDiagnosa 	 	.= "(NULL,'$kd_assessment','lainlain','$value'),";
			}

			// manipulasi string untuk masuk ke clone_diagnosa. tipenya adalah pemeriksaan lab
			$stringDiagnosa				.= "(NULL,'$kd_assessment','pemeriksaanLab','".$data['diagnosaPemeriksaanLab']."')";

			$stringDiagnosa				= rtrim($stringDiagnosa,", ");

			// masukkan kd_assessment beserta data pemeriksaan primer sekunder lainlain pememeriksaan lab ke tabel clone_diagnosa ** untuk assessment non-form masuk ke tabel assessment
			$this->Kesehatan_M->rawQuery($stringDiagnosa);

			$this->load->view('dokter/suratrujukan',$data);
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

	// Fungsi ini digunakan untuk mencari data pada tabel ICD 10
	function cari_icd()
	{
		if ($this->input->get() != NULL) {
			$dataForm = $this->input->get();
			$dataReturn = $this->Kesehatan_M->orLike('icd10',array('Diagnosa'=>$dataForm['term']['term'],'Diskripsi'=>$dataForm['term']['term']))->result();
			$data = array();
			foreach ($dataReturn as $key => $value) {
				$data[$key]['id'] = $value->Kode_ICD;
				$data[$key]['text'] = $value->Kode_ICD." / ".$value->Diskripsi;
			}
			echo json_encode($data);
		}else{
			redirect(base_url());
		}
	}


}