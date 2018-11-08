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
		$data['dokter'] 		= $this->Kesehatan_M->readS('dokter')->result();
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
}