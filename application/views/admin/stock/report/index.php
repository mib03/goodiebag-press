<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="mt-3 h3 mb-4 text-gray-800">Laporan Stok Barang</h1>

	<a href="<?= base_url('stock/all') ?>" class="btn btn-primary col-lg-2 pl-0 mb-3"><i class="fas fa-fw fa-print"></i> Cetak</a>

	<!-- DataTables Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Table Stok Barang</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Kode Barang</th>
							<th>Nama Barang</th>
							<th>Jenis Barang</th>
							<th>Keterangan</th>
							<th style="width: 80px">Warna</th>
							<th>Jumlah</th>
							<th>Min Jumlah</th>
							<th>Maks Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php
							foreach ($getData as $gd) :
							?>
								<td><?= $gd->id_barang ?></td>
								<td><?= $gd->nama_barang ?></td>
								<td><?= $gd->jenis ?></td>
								<td><?= $gd->keterangan ?></td>
								<td><?= $gd->warna ?></td>
								<td><?= $gd->jumlah ?></td>
								<td><?= $gd->min_jumlah ?></td>
								<td><?= $gd->maks_jumlah ?></td>
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