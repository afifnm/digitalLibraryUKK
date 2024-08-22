<?= $this->session->flashdata('notifikasi',TRUE); ?>
<div class="card">
	<form action="<?= base_url('auth/updatePassword') ?>" method="post">
		<div class="modal-body">
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Password Baru</label>
					<input type="password" name="passwordBaru" class="form-control" placeholder="Masukan password baru" required>
				</div>
			</div>
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Ulangi Password Baru</label>
					<input type="password" name="passwordKonf" class="form-control" placeholder="Masukan password konfirmasi" required>
				</div>
			</div>

		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
