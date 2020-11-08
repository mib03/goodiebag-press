<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Akun Saya</h1>
	<div class="card mb-3" style="max-width: 600px;">
		<div class="row no-gutters">
			<div class="col-md-4">
				<img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="card-img">
			</div>
			<div class="col-md-8">
				<div class="card-body">
					<h5 class="card-title"><?= $user['name'] ?></h5>
					<p class="card-text pt-2">Username: <?= $user['username'] ?></p>
					<p class="card-text pt-4"><small class="text-muted">Akun dibuat pada <?php $dt = new DateTime($user['date_created']);
																												$date = $dt->format('F');
																												if ($date == "January") {
																													echo $dt->format('d') . " Januari " . $dt->format('Y');
																												} else if ($date == "February") {
																													echo $dt->format('d') . " Februari " . $dt->format('Y');
																												} else if ($date == "March") {
																													echo $dt->format('d') . " Maret " . $dt->format('Y');
																												} else if ($date == "May") {
																													echo $dt->format('d') . " Mei " . $dt->format('Y');
																												} else if ($date == "July") {
																													echo $dt->format('d') . " Juli " . $dt->format('Y');
																												} else if ($date == "August") {
																													echo $dt->format('d') . " Agustus " . $dt->format('Y');
																												} else if ($date == "October") {
																													echo $dt->format('d') . " Oktober " . $dt->format('Y');
																												}
																												?></small></p>
				</div>
			</div>
		</div>
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
