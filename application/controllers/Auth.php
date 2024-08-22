<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function index(){
		$data = array(
			'judul'		=> 'Login',
		);
		$this->load->view('login',$data);
	}
	public function profile(){
		$this->db->from('user');
		$this->db->where('userID',$this->session->userdata('userID'));
		$user = $this->db->get()->row();
		$data = array(
			'judul'		=> 'My Profile',
			'user'		=> $user
		);
		$this->template->load('template','profile',$data);
	}
	public function password(){
		$data = array(
			'judul'		=> 'Ganti Password',
		);
		$this->template->load('template','password',$data);
	}
	public function update(){
		$data = array(
			'namaLengkap'	=> $this->input->post('nama'),
			'alamat'	=> $this->input->post('alamat'),
			'email'	=> $this->input->post('email')
		);
		$where = array(
			'userID'	=> $this->input->post('userID'),
		);
		$this->db->update('user',$data, $where);
		$this->session->set_userdata($data);
		$this->session->set_flashdata('notifikasi','
		<div class="alert alert-primary alert-dismissible" role="alert">
			Berhasil disimpan.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('auth/profile');
	}
	public function updatePassword(){
		$username = $this->session->userdata('username');
        $passwordBaru = $this->input->post('passwordBaru');
        $passwordKonf = $this->input->post('passwordKonf');

		$this->db->from('user')->where('username',$username);
        $passwordDatabase = $this->db->get()->row()->password;
		if($passwordBaru<>$passwordKonf){
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-primary alert-dismissible" role="alert">
				Konfirmasi password tidak sama
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('auth/password');
		} else {
			$data = array(
				'password'	=> md5($passwordBaru),
			);
			$where = array(
				'username'	=> $username,
			);
			$this->db->update('user',$data, $where);
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-primary alert-dismissible" role="alert">
				Password berhasil diganti
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('auth/password');
		}
	}
    public function register(){
		$data = array(
			'judul'		=> 'Register',
		);
		$this->load->view('register',$data);
	}
    public function logout(){ 
        $this->session->sess_destroy();
        redirect('auth');
    }
    public function login(){
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $this->db->from('user')->where('username',$username);
        $data = $this->db->get()->row();
        if($data==NULL){
            $this->session->set_flashdata('notifikasi','
			<div class="alert alert-primary alert-dismissible" role="alert">
				Username tidak ditemukan
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('auth');
        } else if($data->password==$password){
            //berhasil login
            $data = array(
                'is_login'  => TRUE,
				'username'	=> $data->username,
				'userID'	=> $data->userID,
				'namaLengkap'	=> $data->namaLengkap,
				'alamat'	=> $data->alamat,
				'email'	=> $tdata->email,
				'role'	=> $data->role,
			);
            $this->session->set_userdata($data);
            redirect('home');
        } else {
            $this->session->set_flashdata('notifikasi','
			<div class="alert alert-primary alert-dismissible" role="alert">
				Password salah
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('auth');
        }
    }
    public function simpan(){
		$this->db->from('user')->where('username',$this->input->post('username'));
		$cek = $this->db->get()->row();
		if($cek==NULL){
			$data = array(
				'username'	=> $this->input->post('username'),
				'password'	=> md5($this->input->post('password')),
				'namaLengkap'	=> $this->input->post('namaLengkap'),
				'alamat'	=> $this->input->post('alamat'),
				'email'	=> $this->input->post('email'),
				'role'	=> 'Peminjam'
			);
			$this->db->insert('user',$data);
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-primary alert-dismissible" role="alert">
				Berhasil register silahkan login.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('auth');
		} else {
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-primary alert-dismissible" role="alert">
				Username sudah digunakan.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('auth/register');
		}
	}
}
