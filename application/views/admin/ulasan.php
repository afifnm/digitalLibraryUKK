<?= $this->session->flashdata('notifikasi',TRUE); ?>
<div class="row">
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
        <?php } 
        if($ulasan==NULL){ echo "Belum ada ulasan"; }
        ?>
	</div>
</div>
