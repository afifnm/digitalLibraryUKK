<?= $this->session->flashdata('notifikasi',TRUE); ?>
<div class="card">
	<h5 class="card-header">Data Buku</h5>
	<div class="table-responsive text-nowrap">
		<table class="table">
			<thead>
				<tr class="text-nowrap">
					<th>#</th>
					<th>Judul</th>
					<th>Tanggal Peminjaman</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
                <?php $no=1; foreach($buku as $row){ ?>
				<tr>
					<th scope="row"><?= $no; ?></th>
					<td><?= $row['judul']; ?></td>
					<td><?= $row['tanggalPeminjaman']; ?></td>
					<td>
                        <?php if($row['statusPeminjaman']=='Proses'){
                        echo "Menunggu persetujuan";   
                        } else { echo $row['statusPeminjaman']; } ?>
                    </td>
					<td>
                        <?php if($row['statusPeminjaman']=='Proses'){ ?>
                            <a onclick="return confirm('Apakah Anda yakin ingin membatalkan peminjaman ini?');"
                            href="<?= base_url('peminjam/peminjaman/batal/'.$row['peminjamanID']) ?>" class="btn-sm btn-danger">batalkan</a>
                        <?php  } ?>
                    </td>
				</tr>
                <?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>
