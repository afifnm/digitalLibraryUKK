<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Peminjaman extends CI_Controller {
	public function __construct(){ //underscore 2x
        parent::__construct();
		if($this->session->userdata('is_login')==FALSE){
			redirect('auth');
		}
        if($this->session->userdata('role')=='Admin'){
			redirect('home');
		}
        if($this->session->userdata('role')=='Petugas'){
			redirect('home');
		}
	}
	public function index(){
		$this->db->from('peminjaman a')->order_by('a.tanggalPeminjaman','DESC');
        $this->db->join('buku b','a.bukuID=b.bukuID','left');
        $this->db->where('userID',$this->session->userdata('userID'));
		$buku = $this->db->get()->result_array();
		$data = array(
			'judul'		    => 'Riwayat Peminjaman',
			'buku'		    => $buku,
		);
		$this->template->load('template','peminjam/riwayat',$data);
	}
    public function batal($peminjamanID){
		$data = array(
			'statusPeminjaman'	=> 'Dibatalkan',
		);
		$where = array(
			'peminjamanID'	=> $peminjamanID,
		);
		$this->db->update('peminjaman',$data, $where);
		$this->session->set_flashdata('notifikasi','
		<div class="alert alert-primary alert-dismissible" role="alert">
			Anda telah membatalkan peminjaman buku.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('peminjam/peminjaman');
	}
}
