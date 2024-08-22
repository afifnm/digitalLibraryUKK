<div class="card">
	<form action="<?= base_url('admin/kategori/update') ?>" method="post">
		<div class="modal-body">
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Kategori</label>
					<input type="text" name="namaKategori" class="form-control" value="<?= $user->namaKategori; ?>">
                    <input type="hidden" name="kategoriID" value="<?= $user->kategoriID; ?>">
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
