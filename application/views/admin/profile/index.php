<!-- Begin Page Content -->
<div class="container-fluid">

	<?php if ($this->session->flashdata('flashUpdate')) { ?>
		<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button> <?= $this->session->flashdata('flashUpdate') ?> </div>
	<?php } ?>

	<div class="col-lg-8">

		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">Edit Profil</h1>
		<hr>

		<?= form_open_multipart('admin/profile'); ?>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" readonly>
		</div>
		<div class="form-group">
			<label for="full_name">Nama Lengkap</label>
			<input type="text" class="form-control" id="full_name" name="full_name" placeholder="Masukkan nama anda" value="<?= $user['name'] ?>">
			<?= form_error('full_name', '<small class="text-danger pl-3">', '</small>'); ?>
		</div>
		<div class="form-group">
			<label>Foto Profil</label>
			<div class="row">
				<div class="col-sm-3">
					<img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-thumbnail">
				</div>
				<div class="col-sm-9">
					<div class="custom-file mt-5">
						<input type="file" class="custom-file-input" id="image" name="image">
						<label class="custom-file-label" for="image">Pilih foto (format .png atau .jpg)</label>
					</div>
				</div>
			</div>
		</div>
		<button class="btn btn-primary mt-3 col-lg-3 col-sm-4 mb-5" type="submit">Edit</button>
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