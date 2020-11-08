<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="col-lg-8">

		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">Edit Pengguna</h1>

		<hr>
		<?= form_open_multipart('user/update/' . $getUser['user_id']); ?>

		<div class="form-group">
			<label for="name">Nama Anda</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="<?= $getUser['name'];
																											set_value('name'); ?>">
			<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
		</div>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="username" class="form-control" id="username" name="username" placeholder="name@example.com" value="<?= $getUser['username'];
																													set_value('username'); ?>">
			<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= set_value('password') ?>">
			<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
		</div>
		<div class="form-group">
			<label for="passconf">Konfirmasi Password</label>
			<input type="password" class="form-control" id="passconf" name="passconf" placeholder="Ulangi Password" value="<?= set_value('passconf') ?>">
			<?= form_error('passconf', '<small class="text-danger pl-3">', '</small>'); ?>
		</div>
		<div class="mb-2">
			Status Pengguna
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="role" id="admin" value="Admin" checked>
			<label class="form-check-label" for="admin">
				Admin
			</label>
		</div>
		<div class="form-check mt-1 mb-3">
			<input class="form-check-input" type="radio" name="role" id="operator" value="operator">
			<label class="form-check-label" for="operator">
				Operator
			</label>
		</div>
		<div class="mb-2">Status Aktif</div>
		<select name="selectActive" class="form-control mb-4 col-lg-4">
			<option name="option1" value="Aktif">Aktif</option>
			<option name="option2" value="Tidak Aktif">Tidak Aktif</option>
		</select>

		<input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?= $getUser['user_id']; ?>">
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
