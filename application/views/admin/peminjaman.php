<?= $this->session->flashdata('notifikasi',TRUE); ?>
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#smallModal">
	Laporan Peminjaman
</button>
<div class="card">
	<h5 class="card-header">Daftar Pengajuan Peminjaman Buku</h5>
	<div class="table-responsive text-nowrap">
		<table class="table">
			<thead>
				<tr class="text-nowrap">
					<th>#</th>
					<th>Judul</th>
					<th>Peminjam</th>
					<th>Tanggal Peminjaman</th>
					<th>Tanggal Pengembalian</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach($buku as $row){ ?>
				<tr>
					<th scope="row"><?= $no; ?></th>
					<td><?= $row['judul']; ?></td>
					<td><?= $row['namaLengkap']; ?></td>
					<td><?= $row['tanggalPeminjaman']; ?></td>
					<td><?= $row['tanggalPengembalian']; ?></td>
					<td>
						<?php if($row['statusPeminjaman']=='Proses'){
                        echo "Menunggu persetujuan";   
                        } else { echo $row['statusPeminjaman']; } ?>
					</td>
					<td>
						<?php if($row['statusPeminjaman']=='Proses'){ ?>
						<a onclick="return confirm('Apakah Anda yakin ingin menyetujui peminjaman ini?');"
							href="<?= base_url('admin/peminjaman/terima/'.$row['peminjamanID'].'/'.$row['bukuID']) ?>"
							class="btn-sm btn-success">terima</a>
						<a onclick="return confirm('Apakah Anda yakin ingin menolak peminjaman ini?');"
							href="<?= base_url('admin/peminjaman/tolak/'.$row['peminjamanID']) ?>"
							class="btn-sm btn-danger">tolak</a>
						<?php  } ?>
						<?php if($row['statusPeminjaman']=='Dipinjam'){ ?>
						<a onclick="return confirm('Apakah peminjam sudah mengembalikan peminjaman ini?');"
							href="<?= base_url('admin/peminjaman/kembali/'.$row['peminjamanID'].'/'.$row['bukuID']) ?>"
							class="btn-sm btn-success">kembalikan</a>
						<?php  } ?>
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<form action="<?= base_url('admin/peminjaman/laporan') ?>" method="get" target="_blank">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel2">Laporan Peminjaman</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col mb-3">
							<label for="nameSmall" class="form-label">Tanggal Awal</label>
							<input type="date" class="form-control" name="tanggal1" />
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label for="nameSmall" class="form-label">Tanggal Berakhir</label>
							<input type="date" class="form-control" name="tanggal2" />
						</div>
					</div>
					<div class="row">
						<div class="col mb-3">
							<label for="nameSmall" class="form-label">Status</label>
							<select name="status" class="form-control">
								<option value="-">Semua</option>
								<option value="Dipinjam">Dipinjam</option>
								<option value="Dibatalkan">Dibatalkan</option>
								<option value="Ditolak">Ditolak</option>
								<option value="Proses">Menunggu Persetujuan</option>
								<option value="Sudah Kembali">Sudah Kembalikan</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
						Close
					</button>
					<button type="submit" class="btn btn-primary">Lihat Laporan</button>
				</div>
			</div>
		</form>
	</div>
</div>
