<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="col-lg-8">

		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">Tambah Pemasok Baru</h1>

		<hr>

		<form class="user" method="post" action="<?= base_url('supplier/insert'); ?>">
			<div class="form-group">
				<label for="supplier_id">Kode Pemasok</label>
				<input type="text" class="form-control" id="supplier_id" name="supplier_id" value="<?= $idSupplier ?>" readonly>
				<?= form_error('supplier_id', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="supplier_name">Nama Pemasok</label>
				<input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Masukkan nama pemasok" value="<?= set_value('supplier_name') ?>">
				<?= form_error('supplier_name', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="address">Alamat Toko</label>
				<textarea class="form-control" id="address" name="address" rows="3" placeholder="Alamat lengkap pemasok" value="<?= set_value('address') ?>"></textarea>
			</div>
			<?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
			<div class="form-group">
				<label for="phone">Nomor Telepon/Handphone</label>
				<input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan angka" value="<?= set_value('phone') ?>">
				<?= form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
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
