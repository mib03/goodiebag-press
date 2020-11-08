<!-- Begin Page Content -->
<div class="container-fluid">

	<?php if ($this->session->flashdata('flashCreate')) { ?>
		<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button> <?= $this->session->flashdata('flashCreate') ?> </div>
	<?php } else if ($this->session->flashdata('flashUpdate')) { ?>
		<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button> <?= $this->session->flashdata('flashUpdate') ?> </div>
	<?php } else if ($this->session->flashdata('flashDelete')) { ?>
		<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button> <?= $this->session->flashdata('flashDelete') ?> </div>
	<?php } ?>

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800 ">Rincian Pesanan Pembelian</h1>

	<div class="clearfix">
		<a href="<?= base_url('purchase/reportdetails/' . $getFaktur['no_faktur']) ?>" class="btn btn-primary mb-3 ml-auto float-left col-lg-2"><i class="fas fa fa-fw fa-print"></i> Cetak</a>
	</div>

	<!-- DataTables Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="clearfix">
				<label for="no_faktur" class="float-left mt-2 mr-2">No. Faktur: </label>
				<input type="text" class="form-control col-lg-3 mb-3 float-left" id="no_faktur" name="no_faktur" value="<?= $getFaktur['no_faktur'] ?>" readonly>
				<input type="text" class="form-control col-lg-3 mb-3 float-right" id="nama_pemasok" name="nama_pemasok" value="<?= $getPemasok['nama_pemasok'] ?>" readonly>
				<label for="nama_pemasok" class="float-right mt-2 mr-2">Nama Pemasok: </label>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Barang</th>
							<th>Keterangan</th>
							<th>Warna</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>Subtotal</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php
							$no = 1;
							$total = 0;
							foreach ($getData as $gd) :
							?>
								<td><?= $no++ ?></td>
								<td><?= $gd->nama_barang ?></td>
								<td><?= $gd->keterangan ?></td>
								<td><?= $gd->warna ?></td>
								<td><?= number_format($gd->harga, 0, ',', '.') ?></td>
								<td><?= $gd->jumlah ?></td>
								<td><?= number_format($gd->subtotal, 0, ',', '.') ?></td>
								<?php $total += $gd->subtotal; ?>
						</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="6"><b class="h5">Total :</b></td>
						<td><?= number_format($total, 0, ',', '.')  ?></td>
					</tr>
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