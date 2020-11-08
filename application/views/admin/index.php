<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	</div>

	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Barang</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countBarang; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pembelian (<?= $currMonth; ?>)</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countBeli; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Barang Masuk (<?= $currMonth; ?>)</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countMasuk; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-arrow-up fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Pending Requests Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Barang Keluar (<?= $currMonth; ?>) </div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countKeluar; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-arrow-down fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Stok Barang</h1>
	</div>

	<!-- Content Row -->
	<div class="row">

		<div class="col-6">
			<!-- DataTables Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Kekurangan Stok</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Barang</th>
										<th>Stok</th>
										<th>Min Stok</th>
										<th>Maks Stok</th>
									</tr>
								</thead>
							<tbody>
								<tr>
									<?php
									$no = 1;
									foreach ($getStokDikit as $row) :
									?>
										<td><?= $no++ ?></td>
										<td><?= $row->id_barang ?></td>
										<td><?= $row->jumlah ?></td>
										<td><?= $row->min_jumlah ?></td>
										<td><?= $row->maks_jumlah ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-6">
			<!-- DataTables Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Kelebihan Stok</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Barang</th>
										<th>Stok</th>
										<th>Min Stok</th>
										<th>Maks Stok</th>
									</tr>
								</thead>
							<tbody>
								<tr>
									<?php
									if (is_array($getStokBanyak)) {
										$no = $this->uri->segment(3) + 1;
										foreach ($getStokBanyak as $row) :
									?>
											<td><?= $no++ ?></td>
											<td><?= $row->id_barang ?></td>
											<td><?= $row->jumlah ?></td>
											<td><?= $row->min_jumlah ?></td>
											<td><?= $row->maks_jumlah ?></td>
								</tr>
							<?php endforeach; ?>
						<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Riwayat Transaksi</h1>
	</div>

	<!-- Content Row -->
	<div class="row">

		<div class="col-6">
			<!-- DataTables Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Barang Masuk</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<thead>
									<tr>
										<th>No</th>
										<th>Bulan</th>
										<th>Jumlah Masuk</th>
									</tr>
								</thead>
							<tbody>
								<tr>
									<?php
									$no = 1;

									foreach ($getMasuk as $row) :
										$monthNum = $row->month;
										$dateObj = DateTime::createFromFormat('!m', $monthNum);
										$monthName = $dateObj->format('F');
										if ($monthName == "January") {
											$monthName = "Januari";
										} else if ($monthName == "February") {
											$monthName = "Februari";
										} else if ($monthName == "March") {
											$monthName = "Maret";
										} else if ($monthName == "May") {
											$monthName = "Mei";
										} else if ($monthName == "June") {
											$monthName = "Juni";
										} else if ($monthName == "July") {
											$monthName = "July";
										} else if ($monthName == "August") {
											$monthName = "Agustus";
										} else if ($monthName == "October") {
											$monthName = "Oktober";
										}
									?>
										<td><?= $no++ ?></td>
										<td><?= $monthName ?></td>
										<td><?= $row->total_masuk ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-6">
			<!-- DataTables Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Barang Keluar</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<thead>
									<tr>
										<th>No</th>
										<th>Bulan</th>
										<th>Jumlah Keluar</th>
									</tr>
								</thead>
							<tbody>
								<tr>
									<?php
									$no = 1;
									foreach ($getKeluar as $row) :
										$monthNum = $row->month;
										$dateObj = DateTime::createFromFormat('!m', $monthNum);
										$monthName = $dateObj->format('F');
										if ($monthName == "January") {
											$monthName = "Januari";
										} else if ($monthName == "February") {
											$monthName = "Februari";
										} else if ($monthName == "March") {
											$monthName = "Maret";
										} else if ($monthName == "May") {
											$monthName = "Mei";
										} else if ($monthName == "June") {
											$monthName = "Juni";
										} else if ($monthName == "July") {
											$monthName = "July";
										} else if ($monthName == "August") {
											$monthName = "Agustus";
										} else if ($monthName == "October") {
											$monthName = "Oktober";
										}
									?>
										<td><?= $no++ ?></td>
										<td><?= $monthName ?></td>
										<td><?= $row->total_keluar ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
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