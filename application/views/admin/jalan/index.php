<!-- Begin Page Content -->
<div class="container-fluid">
	<?php if ($this->session->flashdata('flashCreate')) { ?>
		<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button> <?= $this->session->flashdata('flashCreate') ?> </div>
	<?php } ?>
	<div class="col-lg-8">

		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">Surat Jalan</h1>

		<hr>

		<form class="user" method="post" action="<?= base_url('jalan'); ?>">
			<div class="form-group">
				<label for="id_jalan">Kode Surat Jalan</label>
				<input type="text" class="form-control" id="id_jalan" name="id_jalan" value="<?= $getId ?>" readonly>
				<?= form_error('id_jalan', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="no_faktur">Nomor Faktur</label>
				<input type="text" class="form-control" id="no_faktur" name="no_faktur" placeholder="Masukkan nomor faktur">
				<?= form_error('no_faktur', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="tanggal">Tanggal</label>
				<input type="date" class="form-control" name="tanggal" id="tanggal">
				<?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="col ml-3">
			</div>
			<div class="form-group">
				<label for="nama_kurir">Nama Kurir</label>
				<input type="text" class="form-control" id="nama_kurir" name="nama_kurir" placeholder="Masukkan nama kurir">
				<?= form_error('nama_kurir', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="kendaraan">Kendaraan</label>
				<select name="kendaraan" class="form-control mb-4 col-lg-4" onchange="changeValue(this.value)">
					<option value="">Pilih kode...</option>
					<?php foreach ($getKendaraan as $key => $value) : ?>
						<option value="<?= $value->nama_kendaraan ?>"><?= $value->nama_kendaraan ?></option>
					<?php endforeach ?>
				</select>
				<?= form_error('kendaraan', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="perusahaan">Nama Perusahaan</label>
				<input type="text" class="form-control" id="perusahaan" name="perusahaan" placeholder="Perusahaan kurir">
				<?= form_error('perusahaan', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="no_pol">Nomor Polisi</label>
				<input type="text" class="form-control" id="no_pol" name="no_pol" placeholder="Plat nomor kendaraan">
				<?= form_error('no_pol', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<input type="hidden" class="form-control col-lg-12" id="added_by" name="added_by" value="<?= $user['name'] ?>" readonly>
			<button class="btn btn-primary mt-3 col-lg-3 col-sm-4 mb-5" type="submit">Kirim</button>
		</form>

	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>
