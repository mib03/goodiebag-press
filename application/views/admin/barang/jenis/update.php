<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="col-lg-8">

		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">Edit Jenis Barang</h1>

		<hr>

		<form class="user" method="post" action="<?= base_url('jenis/update/'. $getJenis['id_jenis']); ?>">
			<div class="form-group">
				<label for="id_jenis">Kode Jenis</label>
				<input type="text" class="form-control" id="id_jenis" name="id_jenis" value="<?= $getJenis['id_jenis'] ?>" readonly>
			</div>
			<div class="form-group">
				<label for="nama_jenis">Nama Jenis</label>
				<input type="text" class="form-control" id="nama_jenis" name="nama_jenis" value="<?= $getJenis['jenis']; set_value('nama_jenis') ?>">
				<?= form_error('nama_jenis', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="satuan">Satuan</label>
				<input type="text" class="form-control" id="satuan" name="satuan" placeholder="Masukkan Nama Barang" value="<?= $getJenis['satuan']; set_value('satuan') ?>">
				<?= form_error('satuan', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<button class="btn btn-primary mt-3 col-lg-3 col-sm-4 mb-5" type="submit" onclick="combine();">Kirim</button>
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
