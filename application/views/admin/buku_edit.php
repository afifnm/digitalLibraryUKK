<?= $this->session->flashdata('notifikasi',TRUE); ?>
<div class="card">
	<form action="<?= base_url('admin/buku/update') ?>" method="post">
		<div class="modal-body">
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Judul</label>
					<input type="text" name="judul" class="form-control" value="<?= $buku->judul ?>">
					<input type="hidden" name="bukuID" value="<?= $buku->bukuID ?>">
				</div>
			</div>
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Penulis</label>
					<input type="text" name="penulis" class="form-control" value="<?= $buku->penulis ?>">
				</div>
			</div>
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Penerbit</label>
					<input type="text" name="penerbit" class="form-control" value="<?= $buku->penerbit ?>">
				</div>
			</div>
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Tahun Terbit</label>
					<input type="number" name="tahunTerbit" class="form-control" value="<?= $buku->tahunTerbit ?>">
				</div>
			</div>
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Kategori</label>
					<select name="kategoriID" class="form-control">
						<?php foreach($kategori as $kk){ ?>
						<option value="<?= $kk['kategoriID'] ?>"
							<?php if($buku->kategoriID==$kk['kategoriID']){ echo "selected"; } ?>>
							<?= $kk['namaKategori'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Save changes</button>
		</div>
	</form>
</div>
