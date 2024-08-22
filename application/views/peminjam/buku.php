<?= $this->session->flashdata('notifikasi',TRUE); ?>
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
						<a onclick="return confirm('Apakah Anda yakin memasukan buku ini ke koleksi?');"
						href="<?= base_url('peminjam/buku/addKoleksi/'.$row['bukuID']) ?>" class="btn-sm btn-danger">add favorite</a>
                        <?php if($row['status']=='Tersedia'){ ?>
                            <a href="<?= base_url('peminjam/buku/ajukan/'.$row['bukuID']) ?>" class="btn-sm btn-warning">pinjam</a>
                        <?php  } ?>
						<a href="<?= base_url('peminjam/buku/ulasan/'.$row['bukuID']) ?>" class="btn-sm btn-success">ulasan</a>
                    </td>
				</tr>
                <?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>
