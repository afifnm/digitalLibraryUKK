<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kategori extends CI_Controller {
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
		$this->db->from('kategori');
		$this->db->order_by('namaKategori','ASC');
		$kategori = $this->db->get()->result_array();
		$data = array(
			'judul'		    => 'Halaman Kategori',
			'kategori'		=> $kategori
		);
		$this->template->load('template','admin/kategori_index',$data);
	}
	public function edit($kategoriID){
		$this->db->from('kategori');
		$this->db->where('kategoriID',$kategoriID);
		$kategori = $this->db->get()->row();
		$data = array(
			'judul'		=> 'Edit Data Kategori',
			'user'		=> $kategori
		);
		$this->template->load('template','admin/kategori_edit',$data);
	}
	public function simpan(){
		$this->db->from('kategori')->where('namaKategori',$this->input->post('namaKategori'));
		$cek = $this->db->get()->row();
		if($cek==NULL){
			$data = array(
				'namaKategori'	=> $this->input->post('namaKategori'),
			);
			$this->db->insert('kategori',$data);
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-primary alert-dismissible" role="alert">
				Berhasil disimpan.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('admin/kategori');
		} else {
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-primary alert-dismissible" role="alert">
				Gagal disimpan, kategori sudah ada.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('admin/kategori');
		}
	}
	public function update(){
		$data = array(
			'namaKategori'	=> $this->input->post('namaKategori'),
		);
		$where = array(
			'kategoriID'	=> $this->input->post('kategoriID'),
		);
		$this->db->update('kategori',$data, $where);
		$this->session->set_flashdata('notifikasi','
		<div class="alert alert-primary alert-dismissible" role="alert">
			Berhasil disimpan.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/kategori');
	}
	public function hapus($kategoriID){
		$where = array(
			'kategoriID'	=> $kategoriID,
		);
		$this->db->delete('kategori',$where);
		$this->session->set_flashdata('notifikasi','
		<div class="alert alert-primary alert-dismissible" role="alert">
			Berhasil dihapus.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/kategori');
	}
}
