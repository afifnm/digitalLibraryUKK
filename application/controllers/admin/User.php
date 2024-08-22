<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
	public function __construct(){ //underscore 2x
        parent::__construct();
		if($this->session->userdata('is_login')==FALSE){
			redirect('auth');
		}
		if($this->session->userdata('role')=='Peminjam'){
			redirect('home');
		}
		if($this->session->userdata('role')=='Petugas'){
			redirect('home');
		}
	}
	public function index(){
		$this->db->from('user');
		$this->db->order_by('namaLengkap','ASC');
		$user = $this->db->get()->result_array();
		$data = array(
			'judul'		=> 'Halaman User',
			'user'		=> $user
		);
		$this->template->load('template','admin/user_index',$data);
	}
	public function edit($userID){
		$this->db->from('user');
		$this->db->where('userID',$userID);
		$user = $this->db->get()->row();
		$data = array(
			'judul'		=> 'Edit Data User',
			'user'		=> $user
		);
		$this->template->load('template','admin/user_edit',$data);
	}
	public function simpan(){
		$this->db->from('user')->where('username',$this->input->post('username'));
		$cek = $this->db->get()->row();
		if($cek==NULL){
			$data = array(
				'username'	=> $this->input->post('username'),
				'password'	=> md5($this->input->post('password')),
				'namaLengkap'	=> $this->input->post('nama'),
				'alamat'	=> $this->input->post('alamat'),
				'email'	=> $this->input->post('email'),
				'role'	=> $this->input->post('role')
			);
			$this->db->insert('user',$data);
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-primary alert-dismissible" role="alert">
				Berhasil disimpan.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('admin/user');
		} else {
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-primary alert-dismissible" role="alert">
				Gagal disimpan.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('admin/user');
		}
	}
	public function update(){
		$data = array(
			'namaLengkap'	=> $this->input->post('nama'),
			'alamat'	=> $this->input->post('alamat'),
			'email'	=> $this->input->post('email'),
			'role'	=> $this->input->post('role')
		);
		$where = array(
			'userID'	=> $this->input->post('userID'),
		);
		$this->db->update('user',$data, $where);
		$this->session->set_flashdata('notifikasi','
		<div class="alert alert-primary alert-dismissible" role="alert">
			Berhasil disimpan.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/user');
	}
	public function hapus($userID){
		$where = array(
			'userID'	=> $userID,
		);
		$this->db->delete('user',$where);
		$this->session->set_flashdata('notifikasi','
		<div class="alert alert-primary alert-dismissible" role="alert">
			Berhasil dihapus.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/user');
	}
}
