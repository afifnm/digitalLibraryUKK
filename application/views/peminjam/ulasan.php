<?= $this->session->flashdata('notifikasi',TRUE); ?>
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<form action="<?= base_url('peminjam/buku/submitUlasan') ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col mb-3">
							<label class="form-label">Judul</label>
							<input type="text" name="judul" class="form-control" value="<?= $buku->judul ?>" readonly>
							<input type="hidden" name="bukuID" value="<?= $buku->bukuID ?>">
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label class="form-label">Penulis</label>
							<input type="text" name="penulis" class="form-control" value="<?= $buku->penulis ?>"
								readonly>
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label class="form-label">Rating</label>
							<select name="rating" class="form-control">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label class="form-label">Ulasan</label>
							<textarea name="ulasan" class="form-control"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Berikan Ulasan</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-6">
        <?php foreach ($ulasan as $row) { ?>
        <div class="card mb-1">
			<div class="card-body">
				<h5 class="card-title text-primary"><?= $row['namaLengkap'] ?> (<?= $row['rating'] ?>)</h5>
				<p class="mb-1">
                    <?= $row['ulasan'] ?>
				</p>
                <?php if($row['userID']==$this->session->userdata('userID')){ ?>
				    <a href="<?= base_url('peminjam/buku/ulasanHapus/'.$row['bukuID']) ?>" class="btn btn-sm btn-outline-primary">hapus</a>
                <?php } ?>
            </div>
		</div>
        <?php } ?>
	</div>
</div>
