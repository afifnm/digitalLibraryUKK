<?= $this->session->flashdata('notifikasi',TRUE); ?>
<div class="mb-3">
	<!-- Button trigger modal -->
	<?php if($this->session->userdata('role')=='Admin'){ ?>
	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
		Tambah Buku
	</button>
	<?php } ?>
	<!-- Modal -->
	<div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel1">Tambah Buku</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="<?= base_url('admin/buku/simpan') ?>" method="post">
					<div class="modal-body">
						<div class="row">
							<div class="col mb-3">
								<label class="form-label">Judul</label>
								<input type="text" name="judul" class="form-control" placeholder="Judul" required>
							</div>
						</div>
						<div class="row">
							<div class="col mb-3">
								<label class="form-label">Penulis</label>
								<input type="text" name="penulis" class="form-control" placeholder="penulis" required>
							</div>
						</div>
                        <div class="row">
							<div class="col mb-3">
								<label class="form-label">Penerbit</label>
								<input type="text" name="penerbit" class="form-control" placeholder="penerbit" required>
							</div>
						</div>
						<div class="row">
							<div class="col mb-3">
								<label class="form-label">Tahun Terbit</label>
								<input type="number" name="tahunTerbit" class="form-control" placeholder="Tahun Terbit" required>
							</div>
						</div>
                        <div class="row">
							<div class="col mb-3">
								<label class="form-label">Kategori</label>
								<select name="kategoriID" class="form-control">
                                    <?php foreach($kategori as $kk){ ?>
                                        <option value="<?= $kk['kategoriID'] ?>"><?= $kk['namaKategori'] ?></option>
                                    <?php } ?>
                                </select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
							Close
						</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="card">
	<h5 class="card-header">Data Buku</h5>
	<div class="table-responsive text-nowrap">
		<table class="table">
			<thead>
				<tr class="text-nowrap">
					<th>#</th>
					<th>Judul</th>
					<th>Penulis</th>
					<th>Kategori</th>
					<th>Penerbit</th>
					<th>Tahun Terbit</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
                <?php $no=1; foreach($buku as $row){ ?>
				<tr>
					<th scope="row"><?= $no; ?></th>
					<td><?= $row['judul']; ?></td>
					<td><?= $row['penulis']; ?></td>
					<td><?= $row['namaKategori']; ?></td>
					<td><?= $row['penerbit']; ?></td>
					<td><?= $row['tahunTerbit']; ?></td>
					<td><?= $row['status']; ?></td>
					<td>
						<?php if($this->session->userdata('role')=='Admin'){ ?>
							<a onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
							href="<?= base_url('admin/buku/hapus/'.$row['bukuID']) ?>" class="btn-sm btn-danger">hapus</a>
							<a href="<?= base_url('admin/buku/edit/'.$row['bukuID']) ?>" class="btn-sm btn-warning">edit</a>
						<?php } ?>
						<a href="<?= base_url('admin/buku/ulasan/'.$row['bukuID']) ?>" class="btn-sm btn-success">ulasan</a>
                    </td>
				</tr>
                <?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>
