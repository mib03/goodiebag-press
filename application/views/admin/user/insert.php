<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="col-lg-8">

		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">Tambah Pengguna Baru</h1>

		<hr>

		<form class="user" method="post" action="<?= base_url('user/insert'); ?>">
			<div class="form-group">
				<label for="name">Nama Anda</label>
				<input type="text" class="form-control" id="name" name="name" placeholder="Nama lengkap" value="<?= set_value('name') ?>">
				<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="username">Username</label>
				<input type="username" class="form-control" id="username" name="username" placeholder="Nama Pengguna" value="<?= set_value('username') ?>">
				<?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= set_value('password') ?>">
				<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="passconf">Konfirmasi Password</label>
				<input type="password" class="form-control" id="passconf" name="passconf" placeholder="Ulangi password" value="<?= set_value('passconf') ?>">
				<?= form_error('passconf', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="mb-2">
				Status Pengguna
			</div>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="role" id="admin" value="Admin" <?= set_radio('role', 'Admin', true) ?>>
				<label class="form-check-label" for="admin">
					Admin
				</label>
			</div>
			<div class="form-check mt-1">
				<input class="form-check-input" type="radio" name="role" id="operator" value="Operator" <?= set_radio('role', 'Operator') ?>>
				<label class="form-check-label" for="operator">
					Operator
				</label>
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