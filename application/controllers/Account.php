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

	public function login()
	{
		if(isset($this->session->userdata['logged_in'])){
			alert('alert_login','warning','Peringatan','Sudah Login');
			if ($this->session->userdata['logged_in']['akses'] == 'admin') {
				redirect('Admin_C/view_read_obat');
			}
			elseif ($this->session->userdata['logged_in']['akses'] == 'non_admin') {
				redirect('Ppk_C/view_id');
			}
			else if ($this->session->userdata['logged_in']['akses'] == 'pendaftaran') {
				redirect('Pasien_C/view_log_pengobatan/');
			}
		}else{
			$this->load->view('header');
			$this->load->view('login');
			$this->load->view('footer');
		}
	}

	public function register_handler()
	{
		if ($this->input->post() !== null) {

			if ($hak_akses != 'pendaftaran') {
				$data_insert['sip']			= $this->input->post('sip');
			}

			$config['upload_path']          = FCPATH."assets/images/users_photo/";
			$config['allowed_types']        = 'jpg|png|jpeg';
			$this->load->library('upload',$config);
			
			if($this->upload->do_upload('link_foto')){
				$datax = $this->upload->data();	

				alert('alert_register_foto','success','Berhasil','Foto profil telah ditambahkan');

				$data = array(
										'nama'		 	=> "dr. ".$this->input->post('nama'),
										'nik'			=> $this->input->post('nik'),
										'jk'		 	=> $this->input->post('jenis_kelamin'),
										'alamat'		=> $this->input->post('alamat'),
										'username'		=> $this->input->post('username'),
										'password'		=> $this->input->post('password')
								);

				$query = $this->SO_M->create('user',$data);
				$result	=	json_decode($query,true);
				if ($result['status']) {
					alert('alert_register_user','success','Berhasil','Registrasi berhasil');
				}else{
					alert('alert_register_user','success','Gagal','Kegagalan database');
				}
			}
			else{
				alert('alert_register_foto','warning','Gagal','Upload foto profil gagal');
			}

			redirect('Akun_C/view_register_user');

		}else{
			$data['heading']		=	"Null POST";
			$data['message']		=	"<p>Tidak ada data yang di post</p>";
			$this->load->view('errors/html/error_general',$data);
		}
	}

	public function login_handler()
	{
		if ($this->input->post() !== null) {

			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

			$record = $this->Kesehatan_M->read('tabel_user',array(	'username'	=>	$this->input->post('username',
																	'password'	=>	$this->input->post('password')
																)));

			if ($record->num_rows() == 1) {
				
				$record 					= $record->row();

				$data_user['id_user']		= $record->id_user;
				$data_user['nama_user']		= $record->nama_user;
				$data_user['akses']			= $record->akses;
				$data_user['foto']			= $record->link_foto;

				$session_data = array(
											'akses'		=>	$record->akses,
											'id_user'	=>	$record->id_user,
											'nama_user'	=>	$record->nama_user,
											'foto'		=>	$record->link_foto
				);
				
				alert('alert_login','success','Berhasil','Selamat datang '.$session_data['nama_user']);
				$this->session->set_userdata('logged_in', $session_data);

			}else{
				// redirect to home
			}

		}else{
			$data['heading']		=	"Null POST";
			$data['message']		=	"<p>Tidak ada data yang di post</p>";
			$this->load->view('errors/html/error_general',$data);
		}
	}

	public function logout_handler()
	{
		$sess_array = array(
							'hak_akses'	=>	'',
							'id_user'	=>	'',
							'nama_user'	=>	'',
							'foto'		=>	''
		);

		$this->session->unset_userdata('logged_in', $sess_array);
		redirect();
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
		redirect('Akun_C/view_edit_identitas/'.$this->input->post('id_user'));
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
		redirect('Akun_C/view_ubah_password/'.$id_user);
	}


}