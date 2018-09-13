<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* controller untuk bagian Dokter
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


			// ambil value bagian diagnosa dari modal form. masing masing variabel berupa array. diagnosa yang diambiil hanya digunaknan untuk pencetakan semata. tidak masuk ke database
			$data['diagnosaPrimer']				= $this->input->post('diagnosaPrimary[]');
			$data['diagnosaSekunder'] 			= $this->input->post('diagnosaSecondary[]');
			$data['diagnosaLain'] 				= $this->input->post('diagnosaLain[]');
			$data['diagnosaPemeriksaanLab'] 	= $this->input->post('diagnosaPemeriksaanLab');
			
			$this->load->view('dokter/suratrujukan',$data);
		}
		$this->load->view('static/footer');
	}
	/*
	* get nomor surat untuk disalurkan ke kolom planning
	*/
	function getTabelSurat($surat,$nomor_pasien){
		// select * from suratrujukan WHERE nomor_pasien='001-006-01-02-07-2018' ORDER BY id DESC limit 1 ;
		// sebelumnya telah dibuatkan data pada tabel surat rujukan, actionnya saat klink tombol surat rujukan pada pemeriksaan
		$data = json_encode($this->Kesehatan_M->rawQuery("SELECT * FROM surat".$surat." WHERE nomor_pasien='".$nomor_pasien."' ORDER BY id DESC limit 1 ")->result());
		echo $data;
	}

	// Fungsi ini digunakan untuk mencari data pada tabel ICD 10
	function cari_icd()
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
	* function untuk memasukkan form halaman pemeriksaan ke tabel rekam medis dan related.
	* update karena telah ada pemasukan data pada pemeriksaan awal oleh petugas
	*/
	function update_rm(){
		if ($this->input->post() !== NULL) {
			$kd_objek 					= $this->input->post('kd_objek');
			$nomor_pasien 					= $this->input->post('nomor_pasien');
			$headtotoe 					= $this->input->post('headtotoeText');
			$subjektif 					= $this->input->post('subjektif');
			$planning  					= $this->input->post('planning');
			$assessmentPrimer 			= $this->input->post('assessmentPrimary[]');
			$assessmentSekunder 		= $this->input->post('assessmentSecondary[]');
			$assessmentLain 			= $this->input->post('assessmentLain[]');
			$assessmentPemeriksaanLab 	= $this->input->post('assessmentPemeriksaanLab');

			
			// masukkan input form assessment ke tabel assessment. baca kd_assessment paling maksimal pada tabel assessment
			$kd_assessmentMax = $this->Kesehatan_M->rawQuery("SELECT MAX(kd_assessment) AS kd_assessment FROM assessment")->result();

			// set nilai kd_assessment yang akan masuk ke tabel assessment
			if($kd_assessmentMax[0]->kd_assessment == NULL){
				$kd_assessment = 1;
			}else{
				$kd_assessment = $kd_assessmentMax[0]->kd_assessment + 1;
			}

			// manipulasi string untuk masuk ke assessment. tipenya primer
			$stringDiagnosa 			= "INSERT INTO assessment VALUES";
			foreach ($assessmentPrimer as $key => $value) {
				$stringDiagnosa		 	.= "(NULL,'$kd_assessment','primer','$value'),";
			}

			// manipulasi string untuk masuk ke clone_diagnosa. tipenya sekunder
			foreach ($assessmentSekunder as $key => $value) {
				$stringDiagnosa 		.= "(NULL,'$kd_assessment','sekunder','$value'),";
			}

			// manipulasi string untuk masuk ke clone_diagnosa. tipenya lainlain
			foreach ($assessmentLain as $key => $value) {
				$stringDiagnosa 	 	.= "(NULL,'$kd_assessment','lainlain','$value'),";
			}

			// manipulasi string untuk masuk ke clone_diagnosa. tipenya adalah pemeriksaan lab
			$stringDiagnosa				.= "(NULL,'$kd_assessment','pemeriksaanLab','".$assessmentPemeriksaanLab."')";

			$stringDiagnosa				= rtrim($stringDiagnosa,", ");

			// masukkan kd_assessment beserta data pemeriksaan primer sekunder lainlain pememeriksaan lab ke tabel assessment
			$this->Kesehatan_M->rawQuery($stringDiagnosa);

			// masukkan ke tabel rekam medis beserta id return dari tabel assesment
			$updateRM = $this->Kesehatan_M->update('rkm_medis',
																array(
																	'kd_pasien'		=>$this->input->post('nomor_pasien'),
																	'YEAR(tgl_jam)'	=>date('Y'),
																	'MONTH(tgl_jam)'=>date('m'),
																	'DAY(tgl_jam)'	=>date('d')
																),
																array(
																	'subjek'		=>$subjektif,
																	'planning'		=>$planning,
																	'kd_assessment'	=>$kd_assessment
																)
												);

			$updateObj = $this->Kesehatan_M->update('objek',array('kd_objek'=>$kd_objek),array('text_headtotoe'=>$headtotoe));
			$this->Kesehatan_M->delete('proses_antrian',array('nomor_pasien'=>$nomor_pasien));
			echo "<pre>";
			var_dump($updateRM);
			var_dump($updateObj);
		}else{
			redirect(base_url());
		}
	}

	/*
	* untuk cetak rekam medis
	*/
	function cetak_RM(){
		$nomor_pasien		= $this->input->post('nomor_pasien');
		$idS_rekam_medis 	= $this->input->post('idS_rekam_medis[]');
		$bool_halaman_awal 	= $this->input->post('bool_halaman_awal');

		$query = "
			SELECT rkm_medis.kd_rkm, rkm_medis.kd_objek, rkm_medis.kd_pasien, rkm_medis.tgl_jam, rkm_medis.subjek, rkm_medis.planning, objek.tb, objek.bb, objek.td1, objek.td2, objek.N, objek.RR, objek.TAx, objek.text_headtotoe, headtotoe.keluhan, headtotoe.GCS_E, headtotoe.GCS_V, headtotoe.GCS_M,  headtotoe.GCS_opsi, headtotoe.lain_lain, (SELECT GROUP_CONCAT(assessment.tipe,' ',assessment.detil SEPARATOR ' ; ') FROM assessment WHERE assessment.kd_assessment = rkm_medis.kd_assessment) AS kelompok 
			FROM rkm_medis 
			INNER JOIN objek ON rkm_medis.kd_objek = objek.kd_objek 
			LEFT JOIN headtotoe ON objek.kd_headtotoe = headtotoe.kd_headtotoe 
			INNER JOIN assessment ON rkm_medis.kd_assessment = rkm_medis.kd_assessment 

			WHERE rkm_medis.kd_pasien = '$nomor_pasien'";
		for ($i=0; $i <sizeof($idS_rekam_medis) ; $i++) { 
			if ($i == 0) {
				$query .= " AND (rkm_medis.kd_rkm = $idS_rekam_medis[$i]";
			}else{
				$query .= " OR rkm_medis.kd_rkm = $idS_rekam_medis[$i]";
			}
		}
		$query .= ") GROUP BY rkm_medis.kd_rkm";

		// $rekam medis adalah string untuk menyimpan rekam medis yang akan dicetak. variabel telah memuat data yang diambil dari database
		$rekam_medis 	= $this->Kesehatan_M->rawQuery($query)->result();
		$objektif		= $this->Kesehatan_M->readS('objek')->result();
		$pasien 		= $this->Kesehatan_M->readCol('pasien',array('kd_pasien'=>$nomor_pasien),array('pembayaran','nama','nik','tmp_lahir','tgl_lahir','alamat','jkelamin','pekerjaan'))->result();
		
		$this->load->library('pdf');
		$this->load->helper('kesehatan_fpdf');
		$pdf_mc = new PDF_MC_TABLE();
		$pdf_mc->AddPage('L',array(330,215));
		
		$pdf_mc->SetFont('Arial','',20);
	    $pdf_mc->Cell(0,15,strtoupper($pasien[0]->pembayaran),0,0,'L');
	    $pdf_mc->Cell(0,15,"No. ".strtoupper($nomor_pasien),0,0,'R');
	    $pdf_mc->Ln(15);

		$pdf_mc->SetFont('Arial','',11);
		
		$pdf_mc->SetWidths(array(40,5,105,40,5,110));
		$pdf_mc->Row(array('Nama',':',$pasien[0]->nama,'Alamat',':',$pasien[0]->alamat),FALSE);
		$pdf_mc->Row(array('NIK',':',$pasien[0]->nik,'Jenis Kelamin',':',$pasien[0]->jkelamin),FALSE);
		$pdf_mc->Row(array('Tempat / Tgl Lahir',':',$pasien[0]->tmp_lahir." / ".$pasien[0]->tgl_lahir,'Pekerjaan',':',$pasien[0]->pekerjaan),FALSE);
	    $pdf_mc->Ln(10);
		
		$pdf_mc->SetWidths(array(40,50,60,90,70));
		
		foreach ($rekam_medis as $key => $value) {
			$pdf_mc->Row(array(
					tgl_indo(substr($value->tgl_jam,0,10))." ".substr($value->tgl_jam,10,6)." WIB",
					$value->subjek,
						"TB/BB : ".$objektif[$key]->tb."cm / ".$objektif[$key]->bb."Kg \nTD : ".$objektif[$key]->td1." / ".$objektif[$key]->td2." mmHg\nRR : ".$objektif[$key]->RR."rpm \nN : ".$objektif[$key]->N."     T".utf8_decode("°")."Ax : ".$objektif[$key]->TAx.utf8_decode("°C")." \nHeadToToe : ".$objektif[$key]->text_headtotoe,
					$value->kelompok,
					$value->planning
				)
			);
		}
		$pdf_mc->Output();
	}
}