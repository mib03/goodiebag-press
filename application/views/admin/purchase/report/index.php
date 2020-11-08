<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Cetak Pesanan Pembelian</h1>

	<div class="card col-10">
		<div class="card-body pl-0">
			<form class="col-10" method="post" action="<?= base_url('purchase/report') ?>">
				<div class="form-check">
					<div class="form-row">
						<input class="form-check-input mt-3" type="radio" name="showData" id="allData" value="allData">
						<label for="allData" class="h5 mt-2">Tampilkan Semua Data</label>
					</div>
				</div>
				<div class="form-check mt-2">
					<div class="form-row">
						<input class="form-check-input mt-3" type="radio" name="showData" id="dateRange" value="dateRange">
						<label for="dateRange" class="h5 m-auto">Tanggal</label>
						<div class="col mx-3">
							<input type="date" class="form-control col-lg-12" placeholder="Dari Tanggal" name="tgl_awal" id="tgl_awal">
						</div>
						<span class="m-auto">s/d</span>
						<div class="col ml-3">
							<input type="date" class="form-control col-lg-12" placeholder="Sampai Tanggal" name="tgl_akhir" id="tgl_akhir">
						</div>
					</div>
				</div>
				<div class="form-row mt-3">
					<button type="submit" class="btn btn-primary col-lg-2 pl-0"><i class="fas fa-fw fa-print"></i> Cetak</button>
				</div>
			</form>
		</div>
	</div>

	<hr>

	<!-- Page Heading -->
	<h1 class="mt-3 h3 mb-4 text-gray-800">Laporan Pesanan Pembelian</h1>

	<!-- DataTables Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Table Pesanan Pembelian</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No Faktur</th>
							<th>Tanggal</th>
							<th>Nama Pemasok</th>
							<th>Harga</th>
							<th>Ditambahkan Oleh</th>
							<th>Tanggal Ditambahkan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php
							foreach ($getData as $gd) :
							?>
								<td><?= $gd->no_faktur ?></td>
								<td><?= date("d/m/Y", strtotime($gd->tanggal)) ?></td>
								<td><?= $gd->nama_pemasok ?></td>
								<td><?= number_format($gd->harga, 0, ',', '.') ?></td>
								<td><?= $gd->added_by ?></td>
								<td><?= date("d/m/Y H:i:s", strtotime($gd->date_added)) ?></td>
								<td><a class="btn btn-primary" href="<?= base_url('purchase/details/' . $gd->no_faktur); ?>"><i class="fa fa-fw fa-clipboard"></i> Rincian</a></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
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