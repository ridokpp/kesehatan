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

	function menu($menu = 'login')
	{
		$this->load->view('static/header');
		if ($menu == 'login') {
			$sess_array = array(
								'hak_akses'	=>	'',
								'id_user'	=>	'',
								'nama_user'	=>	'',
								'foto'		=>	''
			);

			$this->session->unset_userdata('logged_in', $sess_array);
			$this->load->view('account/login');
		}elseif ($menu == 'register') {
			$this->load->view('account/register');
		}
		$this->load->view('static/footer');
	}


	function register_handler()
	{
		if ($this->input->post() !== null) {
			$password 		= $this->input->post('password');
			$hak_akses 		= $this->input->post('hak_akses');
			if($hak_akses == '1' && substr($password, -5,5) !== 'admin'){
				alert('alert_','warning','Gagal','Pendaftaran sebagai admin gagal');
				redirect(base_url().'Account/menu/register');
			}else{
				if ($hak_akses != '3') {
					$sip	= $this->input->post('no_sip');
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
											'nama'		 	=> "dr. ".$this->input->post('nama'),
											'foto'			=> "assets/images/users_photo/".$datax['file_name'],
											'verified'		=> $verified
									);

					$query = $this->Kesehatan_M->create('user',$data);
					$result	=	json_decode($query,true);
					if ($result['status']) {
						alert('alert_','success','Berhasil','Registrasi berhasil. Silahkan hubungi admin untuk verifikasi pendaftaran');
					}else{
						var_dump($result);die();
						alert('alert','warning','Peringatan','Foto profil urung terkirim');
						// alert('alert_','danger','Gagal',"Kegagalan database <br><strong> CODE: </strong>".$result['error_message']['code']." <br><strong>Message: </strong>".$result['error_message']['message']);
						alert('alert_','danger','Gagal',"Kegagalan database".($result['error_message']['code'] == '1062')." <br><strong>Message: </strong>".substr($result['error_message']['message'], -4,3));

						unlink(FCPATH."assets/images/users_photo/".$datax['file_name']);
					}
				}
				else{
				// var_dump($this->upload->display_errors());die();
					alert('alert','warning','Gagal','Upload foto profil gagal. Hanya gambar dengan ekstensi jpg,png, atau jpeg. Harap isi kembali form');
				}

				redirect(base_url()."Account/menu/register");
			}

		}else{
			$data['heading']		=	"Null POST";
			$data['message']		=	"<p>Tidak ada data yang di post</p>";
			$this->load->view('errors/html/error_general',$data);
		}
	}

	function login_handler()
	{
		if ($this->input->post() !== null) {

			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

			$record = $this->Kesehatan_M->read('user',array(	'username'	=>	$this->input->post('username'),
																	'password'	=>	hash("sha256", $this->input->post('password')),
																	'verified' => 'sudah'
																));

			if ($record->num_rows() == 1) {
				
				$record 					= $record->row();

				$session_data = array(
											'id_user'	=>	$record->id_user,
											'akses'		=>	$record->hak_akses,
											'nama_user'	=>	$record->nama,
											'foto'		=>	$record->foto,
				);
				// var_dump($session_data);
				// die();
				
				// alert('alert','success','Berhasil','Selamat datang '.$session_data['nama_user']);
				$this->session->set_userdata('logged_in', $session_data);
				if ($record->hak_akses == '1') {
					redirect(base_url().'Admin/menu/dashboard');
				}elseif ($record->hak_akses == '2') {
					redirect(base_url().'Dokter/antrian');
				}elseif ($record->hak_akses == '3') {
					redirect(base_url().'Petugas/menu/cari');
				}
			}else{
				alert('alert','danger','Gagal','Login gagal. Anda tidak terdaftar atau akun anda belum diverifikasi oleh admin. Hubungi admin untuk verifikasi akun anda');
				redirect(base_url().'Account/menu/login');
			}

		}else{
			$data['heading']		=	"Null POST";
			$data['message']		=	"<p>Tidak ada data yang di post</p>";
			$this->load->view('errors/html/error_general',$data);
		}
	}

	function logout_handler()
	{
		$sess_array = array(
							'hak_akses'	=>	'',
							'id_user'	=>	'',
							'nama_user'	=>	'',
							'foto'		=>	''
		);

		$this->session->unset_userdata('logged_in', $sess_array);
		redirect(base_url()."Account/menu/login");
	}

	function edit_identitas_handler()
	{
		$update = $this->Kesehatan_M->update('user',array('id_user'=>$this->input->post('id_user')),array(
																									'nomor_identitas'	=>	$this->input->post('nomor_identitas'),
																									'tanggal_lahir'		=>	$this->input->post('tanggal_lahir')));
		$update = json_decode($update);
		if ($update->status) {
			alert('alert_edit_identitas','success','Berhasil','Perubahan telah masuk database');
		}else{
			alert('alert_edit_identitas','danger','Gagal','Perubahan tidak masuk database');
		}
		redirect();
	}

	function ubah_password_handler()
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
						alert('alert_ubah_password','success','Berhasil','Ubah password berhasil');
					}
					else{
						alert('alert_ubah_password','danger','Gagal','Ubah password gagal');
					}
				}else{
					alert('alert_ubah_password','danger','Gagal','password baru dengan password verifikasi tidak sama');
				}
			}else{
				alert('alert_ubah_password','danger','Gagal','data user tidak ditemukan');
			}
		}else{
			alert('alert_ubah_password','danger','Gagal','tidak ada data yang di post');
		}
		redirect();
	}


}