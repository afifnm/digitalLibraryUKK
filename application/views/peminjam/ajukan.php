<?= $this->session->flashdata('notifikasi',TRUE); ?>
<div class="card">
	<form action="<?= base_url('peminjam/buku/pinjam') ?>" method="post">
		<div class="modal-body">
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Judul</label>
					<input type="text" class="form-control" value="<?= $buku->judul ?>" readonly>
					<input type="hidden" name="bukuID" value="<?= $buku->bukuID ?>">
				</div>
			</div>
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Penulis</label>
					<input type="text" class="form-control" value="<?= $buku->penulis ?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Penerbit</label>
					<input type="text" class="form-control" value="<?= $buku->penerbit ?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Tahun Terbit</label>
					<input type="number" class="form-control" value="<?= $buku->tahunTerbit ?>" readonly>
				</div>
			</div>
            <div class="row">
				<div class="col mb-3">
					<label class="form-label">Kategori</label>
					<input type="text" class="form-control" value="<?= $buku->namaKategori ?>" readonly>
				</div>
			</div>
            <div class="row">
				<div class="col mb-3">
					<label class="form-label">Tanggal Peminjaman</label>
					<input type="date" name="tanggalPeminjaman" class="form-control" required>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
		</div>
	</form>
</div>
