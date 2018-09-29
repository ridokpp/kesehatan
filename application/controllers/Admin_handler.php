<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* controller untuk bagian petugas depan
*/
class Admin_handler extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Kesehatan_M');
		date_default_timezone_set("Asia/Jakarta");
		if ($this->session->userdata('logged_in')['akses'] != '1' ){
			redirect(base_url()."Account/logout_handler");
		}
	}

	function verifikasi_user($id_user){
		$this->Kesehatan_M->update('user',array('id_user'=>$id_user),array('verified'=>'sudah'));
		redirect(base_url()."Admin/menu/verifikasi");
	}

	function update(){

	}
	function reset(){
		
	}
}