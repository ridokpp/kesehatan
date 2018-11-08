<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* controller untuk login, register, reset password, ubah identitas
*/
class Account extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Kesehatan_M');
		date_default_timezone_set("Asia/Jakarta");
	}

	function login()
	{
		$this->session->unset_userdata('logged_in');
		$this->load->view('static/header');
		$this->load->view('account/login');
		$this->load->view('static/footer');
	}

	/*
	* funtion untk menampilkan halaman register petugas atatu dokter
	*/
	function register()
	{
		$this->session->unset_userdata('logged_in', $sess_array);
		$this->load->view('static/header');
		$this->load->view('account/register');
		$this->load->view('static/footer');
	}

	/*
	* funtion untk action form register dokter atau petugas
	*/
	function submitRegister()
	{
		if ($this->input->post() !== null) {
			$password 		= $this->input->post('password');
			$hak_akses 		= $this->input->post('hak_akses');
			if($hak_akses == '1' && substr($password, -5,5) !== 'admin'){
				alert('alert_','warning','Gagal','Pendaftaran sebagai admin gagal');
				redirect('Account/register');
			}else{
				if ($hak_akses != '3') {
					$sip	= $this->input->post('no_sip');
					$nama 	= "dr. ".$this->input->post('nama');
				}else{
					$sip 	= '';
					$nama 	= $this->input->post('nama');
				}
				if ($hak_akses == '1') {
					$verified = "sudah";
				}else{
					$verified = "belum";
				}
				
				$config['upload_path']          = FCPATH."assets/images/users_photo/";
				$config['allowed_types']        = 'jpg|png|jpeg';
				$this->load->library('upload',$config);
				
				if($this->upload->do_upload('foto')){
					$datax = $this->upload->data();

					alert('alert','success','Berhasil','Foto profil telah ditambahkan');

					$data = array(
											'username'		=> $this->input->post('username'),
											'password'		=> hash("sha256", $password),
											'hak_akses'		=> $hak_akses,
											'sip'			=> $sip,
											'jenis_kelamin'	=> $this->input->post('jenis_kelamin'),
											'alamat'		=> $this->input->post('alamat'),
											'nik'			=> $this->input->post('nik'),
											'nama'		 	=> $nama,
											'foto'			=> "assets/images/users_photo/".$datax['file_name'],
											'verified'		=> $verified
									);

					$query = $this->Kesehatan_M->create('user',$data);
					$result	=	json_decode($query,true);
					if ($result['status']) {
						if ($hak_akses != 1) {
							alert('alert_','success','Berhasil','Registrasi berhasil. Silahkan hubungi admin untuk verifikasi pendaftaran');
						}else{
							alert('alert_','success','Berhasil','Registrasi admin berhasil.');
						}
					}else{
						alert('alert','warning','Peringatan','Foto profil urung terkirim');
						// alert('alert_','danger','Gagal',"Kegagalan database <br><strong> CODE: </strong>".$result['error_message']['code']." <br><strong>Message: </strong>".$result['error_message']['message']);
						alert('alert_','danger','Gagal',"Kegagalan database ".$result['error_message']['code']." <br><strong>Message: </strong>".substr($result['error_message']['message'], -4,3). " Sudah ada");

						unlink(FCPATH."assets/images/users_photo/".$datax['file_name']);
					}
				}
				else{
				// var_dump($this->upload->display_errors());die();
					alert('alert','warning','Gagal','Upload foto profil gagal. Hanya gambar dengan ekstensi jpg,png, atau jpeg. Harap isi kembali form');
				}

				redirect("Account/register");
			}

		}else{
			$data['heading']		=	"Null POST";
			$data['message']		=	"<p>Tidak ada data yang di post</p>";
			$this->load->view('errors/html/error_general',$data);
		}
	}

	/*
	* funtion untuk action form login
	*/
	function submitLogin()
	{
		if ($this->input->post() !== null) {
			$record = $this->Kesehatan_M->read('user',array(	'username'	=>	$this->input->post('username'),
																	'password'	=>	hash("sha256", $this->input->post('password')),
																	'verified' => 'sudah'
																));
			if ($record->num_rows() == 1) {
				
				$record 					= $record->row();

				$session_data = array(
											'id_user'	=>	$record->id,
											'akses'		=>	$record->hak_akses,
											'nama_user'	=>	$record->nama,
											'foto'		=>	$record->foto,
											'sip'		=>	$record->sip,
				);
				alert('alert','success','Berhasil','Selamat datang '.$session_data['nama_user']);
				$this->session->set_userdata('logged_in', $session_data);
				if ($record->hak_akses == '1') {
					redirect(base_url().'Admin/dashboard');
				}elseif ($record->hak_akses == '2') {
					redirect(base_url().'Dokter/antrian');
				}elseif ($record->hak_akses == '3') {
					redirect(base_url().'Petugas/cari');
				}
			}else{
				alert('alert','danger','Gagal','Login gagal. Anda tidak terdaftar atau akun anda belum diverifikasi oleh admin. Hubungi admin untuk verifikasi akun anda');
				redirect(base_url().'Account/login');
			}
		}else{
			$data['heading']		=	"Null POST";
			$data['message']		=	"<p>Tidak ada data yang di post</p>";
			$this->load->view('errors/html/error_general',$data);
		}
	}

	function logout()
	{
		$sess_array = array(
							'hak_akses'	=>	'',
							'id_user'	=>	'',
							'nama_user'	=>	'',
							'foto'		=>	''
		);

		$this->session->unset_userdata('logged_in', $sess_array);
		redirect(base_url()."Account/login");
	}

	function submitEditIdentitas()
	{
		$update = $this->Kesehatan_M->update('user',array('id_user'=>$this->input->post('id_user')),array(
																									'nomor_identitas'	=>	$this->input->post('nomor_identitas'),
																									'tanggal_lahir'		=>	$this->input->post('tanggal_lahir')));
		$update = json_decode($update);
		if ($update->status) {
			alert('alert','success','Berhasil','Perubahan telah masuk database');
		}else{
			alert('alert','danger','Gagal','Perubahan tidak masuk database');
		}
		redirect();
	}

	function submitUbahPassword()
	{
		if ($this->input->post()!= null) {
			$id_user				= $this->input->post('id_user');
			$current_password 		= $this->input->post('current_password');
			$new_password 			= $this->input->post('new_password');
			$verif_password 		= $this->input->post('verif_password');
			$encrypted_current 		= hash("sha256",$current_password);
			$cek_user_dan_password 	= $this->Kesehatan_M->readCol('user',array('id_user'=>$id_user,'password'=>$encrypted_current),array('id_user'));
			if ($cek_user_dan_password->num_rows() == 1) {
				$encrypted_new 		= hash('sha256',$new_password);
				$encrypted_verif 	= hash('sha256',$verif_password);
				if ($encrypted_new == $encrypted_verif) {
					$result 		= $this->Kesehatan_M->update('user',array('id_user'=>$id_user),array('password'=>$encrypted_verif));
					$results 		= json_decode($result);
					if ($results->status) {
						alert('alert','success','Berhasil','Ubah password berhasil');
					}
					else{
						alert('alert','danger','Gagal','Ubah password gagal');
					}
				}else{
					alert('alert','danger','Gagal','password baru dengan password verifikasi tidak sama');
				}
			}else{
				alert('alert','danger','Gagal','data user tidak ditemukan');
			}
		}else{
			alert('alert','danger','Gagal','tidak ada data yang di post');
		}
		redirect();
	}

	function myAccount()
	{
		if ($this->session->userdata('logged_in') !== array()) {
			$data['user'] = $this->Kesehatan_M->read('user',array('id_user'=>$this->session->userdata('logged_in')['id_user']))->result();
			$this->load->view('static/header');
			$this->load->view('account/myaccount',$data);
			$this->load->view('static/footer');
		}else{
			redirect();
		}
	}

}