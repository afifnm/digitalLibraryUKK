<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Buku extends CI_Controller {
	public function __construct(){ //underscore 2x
        parent::__construct();
		if($this->session->userdata('is_login')==FALSE){
			redirect('auth');
		}
        if($this->session->userdata('role')=='Peminjam'){
			redirect('home');
		}
	}
	public function index(){
		$this->db->from('buku a')->order_by('a.judul','ASC');
        $this->db->join('kategori b','a.kategoriID=b.kategoriID','left');
		$buku = $this->db->get()->result_array();
        $this->db->from('kategori')->order_by('namaKategori','ASC');
		$kategori = $this->db->get()->result_array();
		$data = array(
			'judul'		    => 'Halaman Buku',
			'buku'		    => $buku,
			'kategori'		=> $kategori,
		);
		$this->template->load('template','admin/buku_index',$data);
	}
	public function edit($bukuID){
		if($this->session->userdata('role')=='Petugas'){
			redirect('home');
		}
		$this->db->from('buku')->where('bukuID',$bukuID);
		$buku = $this->db->get()->row();
        $this->db->from('kategori')->order_by('namaKategori','ASC');
		$kategori = $this->db->get()->result_array();
		$data = array(
			'judul'		=> 'Edit Data Buku',
			'buku'		=> $buku,
			'kategori'		=> $kategori,
		);
		$this->template->load('template','admin/buku_edit',$data);
	}
	public function simpan(){
		$this->db->from('buku')->where('judul',$this->input->post('judul'));
		$cek = $this->db->get()->row();
		if($cek==NULL){
			$data = array(
				'judul'	=> $this->input->post('judul'),
				'penerbit'	=> $this->input->post('penerbit'),
				'tahunTerbit'	=> $this->input->post('tahunTerbit'),
				'penulis'	=> $this->input->post('penulis'),
				'kategoriID'	=> $this->input->post('kategoriID'),
				'status'	=> 'Tersedia'
			);
			$this->db->insert('buku',$data);
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-primary alert-dismissible" role="alert">
				Berhasil disimpan.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('admin/buku');
		} else {
			$this->session->set_flashdata('notifikasi','
			<div class="alert alert-primary alert-dismissible" role="alert">
				Gagal disimpan, buku sudah ada.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
			redirect('admin/buku');
		}
	}
	public function update(){
        $data = array(
            'judul'	=> $this->input->post('judul'),
            'penerbit'	=> $this->input->post('penerbit'),
            'tahunTerbit'	=> $this->input->post('tahunTerbit'),
            'penulis'	=> $this->input->post('penulis'),
            'kategoriID'	=> $this->input->post('kategoriID')
        );
		$where = array(
			'bukuID'	=> $this->input->post('bukuID'),
		);
		$this->db->update('buku',$data, $where);
		$this->session->set_flashdata('notifikasi','
		<div class="alert alert-primary alert-dismissible" role="alert">
			Berhasil disimpan.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/buku');
	}
	public function hapus($bukuID){
		if($this->session->userdata('role')=='Petugas'){
			redirect('home');
		}
		$where = array(
			'bukuID'	=> $bukuID,
		);
		$this->db->delete('buku',$where);
		$this->session->set_flashdata('notifikasi','
		<div class="alert alert-primary alert-dismissible" role="alert">
			Berhasil dihapus.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/buku');
	}
	public function ulasan($bukuID){
		$this->db->from('buku')->where('bukuID',$bukuID);
		$buku = $this->db->get()->row();
        $this->db->from('ulasanbuku a');
        $this->db->join('user b','a.userID=b.userID','left');
        $this->db->where('a.bukuID',$bukuID);
        $ulasan = $this->db->get()->result_array();
		$data = array(
			'judul'		=> 'Ulasan Buku',
			'buku'		=> $buku,
			'ulasan'		=> $ulasan,
		);
		$this->template->load('template','admin/ulasan',$data);
	}
}
