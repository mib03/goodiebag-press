<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="col-lg-8">

		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">Tambah Kendaraan Baru</h1>

		<hr>

		<form class="user" method="post" action="<?= base_url('kendaraan/insert'); ?>">
			<div class="form-group">
				<label for="id_kendaraan">Kode Kendaraan</label>
				<input type="text" class="form-control" id="id_kendaraan" name="id_kendaraan" value="<?= $idKendaraan ?>" readonly>
			</div>
			<div class="form-group">
				<label for="nama_kendaraan">Nama Kendaraan</label>
				<input type="text" class="form-control" id="nama_kendaraan" name="nama_kendaraan" placeholder="Masukkan nama kendaraan" value="<?= set_value('nama_kendaraan') ?>">
				<?= form_error('nama_kendaraan', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
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
