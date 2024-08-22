<div class="row">
	<div class="col-lg-8 mb-4 order-0">
		<div class="card">
			<div class="d-flex align-items-end row">
				<div class="col-sm-7">
					<div class="card-body">
						<h5 class="card-title text-primary">Selamat datang di Digital Library 🎉</h5>
						<p class="mb-4">
							Halo, <span class="fw-bold"><?= $this->session->userdata('namaLengkap') ?></span> anda login 
                            sebagai <?= $this->session->userdata('role') ?>
						</p>
					</div>
				</div>
				<div class="col-sm-5 text-center text-sm-left">
					<div class="card-body pb-0 px-0 px-md-4">
						<img src="<?= base_url('sneat')?>/assets/img/illustrations/man-with-laptop-light.png" height="140">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 order-1">
		<div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
				<div class="card">
					<div class="card-body">
						<span class="fw-semibold d-block mb-1">Buku</span>
						<h3 class="card-title mb-2"><?= $this->db->count_all_results('buku') ?></h3>
					</div>
				</div>
			</div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
				<div class="card">
					<div class="card-body">
						<span class="fw-semibold d-block mb-1">Peminjaman</span>
						<h3 class="card-title mb-2"><?= $this->db->count_all_results('peminjaman') ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>