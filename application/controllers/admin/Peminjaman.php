<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Peminjaman extends CI_Controller {
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
		$this->db->from('peminjaman a')->order_by('a.tanggalPeminjaman','DESC');
        $this->db->join('buku b','a.bukuID=b.bukuID','left');
        $this->db->join('user c','a.userID=c.userID','left');
        $this->db->order_by('a.peminjamanID','DESC');
		$buku = $this->db->get()->result_array();
		$data = array(
			'judul'		    => 'Data Peminjaman',
			'buku'		    => $buku,
		);
		$this->template->load('template','admin/peminjaman',$data);
	}
	public function laporan(){
		$tanggal1 = $this->input->get('tanggal1');
		$tanggal2 = $this->input->get('tanggal2');
		$status = $this->input->get('status');
		$this->db->from('peminjaman a')->order_by('a.tanggalPeminjaman','DESC');
        $this->db->join('buku b','a.bukuID=b.bukuID','left');
        $this->db->join('user c','a.userID=c.userID','left');
        $this->db->order_by('a.peminjamanID','DESC');
        $this->db->where('a.tanggalPeminjaman >=',$tanggal1);
        $this->db->where('a.tanggalPeminjaman <=',$tanggal2);
		if($status!=="-"){
			$this->db->where('a.statusPeminjaman',$status);
		}
		$buku = $this->db->get()->result_array();
		$data = array(
			'judul'		    => 'Data Peminjaman',
			'buku'		    => $buku,
		);
		$this->load->view('admin/laporan',$data);
	}
    public function tolak($peminjamanID){
		$data = array(
			'statusPeminjaman'	=> 'Ditolak',
		);
		$where = array(
			'peminjamanID'	=> $peminjamanID,
		);
		$this->db->update('peminjaman',$data, $where);
		$this->session->set_flashdata('notifikasi','
		<div class="alert alert-primary alert-dismissible" role="alert">
			Anda telah menolak peminjaman buku.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/peminjaman');
	}
	public function terima($peminjamanID,$bukuID){
		$data = array('statusPeminjaman'	=> 'Dipinjam');
		$where = array('peminjamanID'	=> $peminjamanID);
		$this->db->update('peminjaman',$data, $where);

		$data = array('status'	=> 'Dipinjam');
		$where = array('bukuID'	=> $bukuID);
		$this->db->update('buku',$data, $where);
		$this->session->set_flashdata('notifikasi','
		<div class="alert alert-primary alert-dismissible" role="alert">
			Anda telah menolak peminjaman buku.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/peminjaman');
	}
	public function kembali($peminjamanID,$bukuID){
		$data = array(
			'statusPeminjaman'				=> 'Sudah Kembali',
			'tanggalPengembalian'			=> date('Y-m-d')
		);
		$where = array('peminjamanID'	=> $peminjamanID);
		$this->db->update('peminjaman',$data, $where);

		$data = array('status'	=> 'Tersedia');
		$where = array('bukuID'	=> $bukuID);
		$this->db->update('buku',$data, $where);
		$this->session->set_flashdata('notifikasi','
		<div class="alert alert-primary alert-dismissible" role="alert">
			Anda telah menolak peminjaman buku.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/peminjaman');
	}
}
