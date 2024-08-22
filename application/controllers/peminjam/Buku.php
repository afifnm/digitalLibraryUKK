<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Buku extends CI_Controller {
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
		$this->template->load('template','peminjam/buku',$data);
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
		$this->template->load('template','peminjam/ulasan',$data);
	}
    public function ajukan($bukuID){
		$this->db->from('buku a')->where('a.bukuID',$bukuID);
        $this->db->join('kategori b','a.kategoriID=b.kategoriID','left');
		$buku = $this->db->get()->row();
		$data = array(
			'judul'		=> 'Peminjaman',
			'buku'		=> $buku
		);
		$this->template->load('template','peminjam/ajukan',$data);
	}
    public function pinjam(){
        $this->db->from('peminjaman')
                 ->where('bukuID',$this->input->post('bukuID'))
                 ->where('statusPeminjaman','Proses');
		$cek = $this->db->get()->row();
		if($cek==NULL){
            $data = array(
                'bukuID'	=> $this->input->post('bukuID'),
                'userID'	=> $this->session->userdata('userID'),
                'tanggalPeminjaman'	=> $this->input->post('tanggalPeminjaman'),
                'statusPeminjaman'	=> 'Proses',
            );
            $this->db->insert('peminjaman',$data);
            $this->session->set_flashdata('notifikasi','
            <div class="alert alert-primary alert-dismissible" role="alert">
                Berhasil mengajukan peminjaman, silahkan tunggu konfirmasi oleh admin.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('peminjam/buku');
        } else {
            $this->session->set_flashdata('notifikasi','
            <div class="alert alert-primary alert-dismissible" role="alert">
                Anda sudah mengajukan peminjaman atau sudah ada yang mengajukan peminjaman buku oleh orang lain, silahkan tunggu konfirmasi oleh admin.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('peminjam/buku');
        }
    }
    public function addKoleksi($bukuID){
        $this->db->from('koleksi')
                ->where('bukuID',$bukuID)
                ->where('userID',$this->session->userdata('userID'));
        $cek = $this->db->get()->row();
        if($cek==NULL){
            $data = array(
                'bukuID'	=> $bukuID,
                'userID'	=> $this->session->userdata('userID')
            );
            $this->db->insert('koleksi',$data);
            $this->session->set_flashdata('notifikasi','
            <div class="alert alert-primary alert-dismissible" role="alert">
                Berhasil menambah koleksi buku.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('peminjam/buku');
        } else {
            $this->session->set_flashdata('notifikasi','
            <div class="alert alert-primary alert-dismissible" role="alert">
                Anda sudah menambah koleksi buku sebelumnya.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('peminjam/buku');
        }
    }
    public function submitUlasan(){
        $data = array(
            'bukuID'	=> $this->input->post('bukuID'),
            'userID'	=> $this->session->userdata('userID'),
            'ulasan'	=> $this->input->post('ulasan'),
            'rating'	=> $this->input->post('rating')
        );
        $this->db->insert('ulasanbuku',$data);
        $this->session->set_flashdata('notifikasi','
        <div class="alert alert-primary alert-dismissible" role="alert">
            Anda berhasil memberikan ulasan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('peminjam/buku');
    }
    public function ulasanHapus($bukuID){
		$where = array(
			'bukuID'	=> $bukuID,
			'userID'	=> $this->session->userdata('userID'),
		);
		$this->db->delete('ulasanbuku',$where);
		$this->session->set_flashdata('notifikasi','
		<div class="alert alert-primary alert-dismissible" role="alert">
			Ulasan berhasil dihapus.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('peminjam/buku/ulasan/'.$bukuID);
	}
}
