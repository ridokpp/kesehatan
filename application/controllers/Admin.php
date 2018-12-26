<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* controller untuk bagian petugas depan
*/
class Admin extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Kesehatan_M');
		date_default_timezone_set("Asia/Jakarta");
		if ($this->session->userdata('logged_in')['akses'] != '1' ){
			redirect(base_url()."Account/logout");
		}
	}

	/*
	* funtion untuk menampilkan halaman dashboard
	*/
	function dashboard(){
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('admin/dashboard');
		$this->load->view('static/footer');
		$this->load->view('static/footer');
	}

	/*
	* function untuk menampilkan halaman verifikasi pengguna
	*/
	function verifikasi()
	{
		$data['belum_terverifikasi'] = $this->Kesehatan_M->read('user',array('verified'=>'belum'))->result();
		$data['sudah_terverifikasi'] = $this->Kesehatan_M->read('user',array('verified'=>'sudah','hak_akses !='=>'1'))->result();
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('admin/verifikasi',$data);
		$this->load->view('static/footer');
	}

	/*
	* funtion untuk menampilkan halaman pasien
	*/
	function pasien()
	{
		$data['pasien'] 		= $this->Kesehatan_M->readS('pasien')->result();
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('admin/daftar_pasien',$data);
		$this->load->view('static/footer');
	}

	/*
	* funtion unntuk menampilkan halaman dokter yang terdaftar
	*/
	function dokter()
	{
		$data['dokter'] 		= $this->Kesehatan_M->read('user',array('hak_akses'=>2))->result();
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('admin/daftar_dokter',$data);
		$this->load->view('static/footer');
	}

	/*
	* funtion untukmenampilkan halaman rekam  medis
	*/
	function rekamPasien(){
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('admin/rekam_medis',$data);
		$this->load->view('static/footer');
	}

	/*
	* funtion untuk menampilkan halaman rekam dokter
	*/
	function rekamDokter(){
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('admin/rekam_dokter');
		$this->load->view('static/footer');
	}

	/*
	* function handler untuk verifikasi seorang pengguna
	*/
	function submitVerifikasi($id_user){
		$this->Kesehatan_M->update('user',array('id_user'=>$id_user),array('verified'=>'sudah'));
		redirect("Admin/verifikasi");
	}

	/*
	* get data detail pasien
	*/
	function detail_pasien($id)
	{
		$record['pasien'] = $this->Kesehatan_M->read('pasien',array('id'=>$id))->result();
		$this->load->view('static/header');
		$this->load->view('static/navbar');
		$this->load->view('admin/detail_pasien',$record);
		$this->load->view('static/footer');
	}

	/*update data user*/
	function submitUpdate()
	{
		// echo "<pre>";
		// var_dump($this->input->post());
		// die();
		$nik = $this->input->post('nik');

		// cek apakah nik tidak ada isinya? jika tidak ada maka langsung skip pembacaan nik duplikat di database dan langsung insert. jika ada maka cek dulu di db adakah duplikasi
		if ($nik !== '') {
			// var_dump($nik);
			// var_dump($this->input->post());die();
			$result = $this->Kesehatan_M->read('pasien',array('nik'=>$nik));
			if ($result->num_rows() !== 0 && $result->result()[0]->id != $this->input->post('id')) {
				alert('alert','warning','Gagal','Duplikasi NIK');
				redirect("Admin/detail_pasien/".$this->input->post('id'));
			}
		}
		// echo "string";
		// die();

		// ambil kode kelurahan
			$kelurahan = $this->input->post('kelurahan');
			$kd_kelurahan = substr($kelurahan, 0,3);
			$kelurahan_lain = '';
			if ($kelurahan == "013 Lain-lain") {
				$kelurahan_lain = $this->input->post('kelurahan_lain');
			}

		// manipulasi kecamatan
			$kecamatan_lain = '';
			$kecamatan = $this->input->post('kecamatan');
			if ($kecamatan == 'other') {
				$kecamatan_lain = $this->input->post('kecamatan_lain');
			}

		// manipulasi kota
			$kota = $this->input->post('kota');
			if ($kota == 'other') {
				$kota_lain = $this->input->post('kota_lain');
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
		
		// jika pembayaran == BPJS tambahkan nomornya
		$pembayaran = $this->input->post('pembayaran');
		
		if ($pembayaran=='BPJS') {
			$pembayaran .= ' : '.$this->input->post('nomor_bpjs');
		}

		if ($this->input->post('nama_ayah') !== '' OR $this->input->post('nama_ayah') !== NULL) {
			$nama_ayah = ucwords($this->input->post('nama_ayah'));
		}else{
			$nama_ayah = NULL;
		}

		if ($this->input->post('nama_ibu') !== '' OR $this->input->post('nama_ibu') !== NULL) {
			$nama_ibu = ucwords($this->input->post('nama_ibu'));
		}else{
			$nama_ibu = NULL;
		}

		$dataForm = array(	'nama'			=>ucwords($this->input->post('nama_lengkap')),
							'nik' 			=>$nik,
							'tempat_lahir'	=>ucwords($this->input->post('tempat_lahir')),
							'tanggal_lahir' =>$tgl_lahir->format('Y-m-d'),
							'usia'			=>$usia,
							'jalan'			=>ucwords($this->input->post('jalan')),
							'rt'			=>$this->input->post('RT'),
							'rw'			=>$this->input->post('RW'),
							'kelurahan'		=>$kelurahan,
							'kecamatan'		=>$kecamatan,
							'kota'			=>$kota,
							'jenis_kelamin'	=>$this->input->post('jenis_kelamin'),
							'pekerjaan'		=>ucwords($this->input->post('pekerjaan')),
							'pembayaran'	=>$pembayaran,
							'tanggal_datang'=>date("y-m-d"),
							'nama_ayah'		=>$nama_ayah,
							'nama_ibu'		=>$nama_ibu,
						);

		if ($kelurahan_lain !== '') {
			$dataForm['kelurahan_lain'] = ucwords($kelurahan_lain);
		}
		if ($kecamatan_lain !== '') {
			$dataForm['kecamatan_lain'] = ucwords($kecamatan_lain);
		}
		if ($kota_lain !== '') {
			$dataForm['kota_lain'] = ucwords($kota_lain);
		}

		$result = json_decode($this->Kesehatan_M->update('pasien',array('id'=>$this->input->post('id')),$dataForm),false);
		if ($result->status) {
			alert('alert','success','','Update data pasien berhasil');
			redirect("Admin/detail_pasien/".$this->input->post('id'));
		}else{
			alert('alert','warning','Gagal',$result->error_message->message);
			redirect("Admin/detail_pasien/".$this->input->post('id'));
		}
	}
}