<!-- Begin Page Content -->
<div class="container-fluid">

	<?php if ($this->session->flashdata('flashCreate')) { ?>
		<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button> <?= $this->session->flashdata('flashCreate') ?> </div>
	<?php } else if ($this->session->flashdata('flashWrong')) { ?>
		<div class="alert alert-sdanger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button> <?= $this->session->flashdata('flashUpdate') ?> </div>
	<?php } ?>

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Transaksi Barang</h1>

	<!-- DataTables Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Table Barang</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th style="width: 70px">Kode Barang</th>
							<th>Nama Barang</th>
							<th style="width: 80px">Jenis Barang</th>
							<th>Keterangan</th>
							<th>Warna</th>
							<th style="width: 80px">Harga Beli</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php
							foreach ($barangtable as $bt) :
							?>
								<td><?= $bt->id_barang ?></td>
								<td><?= $bt->nama_barang ?></td>
								<td><?= $bt->jenis ?></td>
								<td><?= $bt->keterangan ?></td>
								<td><?= $bt->warna ?></td>
								<td><?= $bt->harga_beli ?></td>
								<td style="width:200px">
									<button class="btn btn-primary" data-toggle="modal" data-target="#inModal<?= $bt->id_barang; ?>"><i class="fas fa-fw fa-long-arrow-alt-up"></i> Masuk</button>
									<button class="btn btn-danger" data-toggle="modal" data-target="#outModal<?= $bt->id_barang; ?>"><i class="fas fa-fw fa-long-arrow-alt-down"></i> Keluar</button>
								</td>
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

<!-- Modal Masuk -->

<?php
foreach ($barangtable as $bt) :
?>
	<div class="modal fade" id="inModal<?php echo $bt->id_barang; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Barang Masuk</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="form-horizontal" method="post" action="<?= base_url() . 'transaction/in' ?>">
					<div class="modal-body">
						<input type="hidden" class="form-control col-lg-12" id="processin_id" name="processin_id" value="<?= $idIn ?>" readonly>
						<?= form_error('processin_id', '<small class="text-danger pl-3">', '</small>'); ?>
						<input type="hidden" class="form-control col-lg-12" id="item_id" name="item_id" value="<?= $bt->id_barang ?>" readonly>
						<?= form_error('item_id', '<small class="text-danger pl-3">', '</small>'); ?>
						<div class="form-group">
							<label for="name">Sumber</label>
							<select class="form-control mb-4 col-lg-8" id="supplier_name" name="supplier_name">
								<option value="">Pilih pemasok...</option>
								<?php foreach ($dataSupplier as $key => $value) : ?>
									<option value="<?= $value['nama_pemasok'] ?>"><?= $value['nama_pemasok'] ?></option>
								<?php endforeach ?>
							</select>
							<?= form_error('supplier_name', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-group">
							<label for="quantity">Jumlah Barang</label>
							<input type="text" class="form-control col-lg-12" id="quantity" name="quantity" placeholder="Masukkan angka" value="<?= set_value('quantity') ?>">
							<?= form_error('quantity', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<input type="hidden" class="form-control col-lg-12" id="added_by" name="added_by" value="<?= $user['name'] ?>" readonly>
						<?= form_error('added_by', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
						<button class="btn btn-primary">Kirim</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>

<!-- End Modal Masuk -->

<!-- Modal Keluar -->

<?php
foreach ($barangtable as $bt) :
?>
	<div class="modal fade" id="outModal<?php echo $bt->id_barang; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Barang Keluar</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="form-horizontal" method="post" action="<?= base_url() . 'transaction/out' ?>">
					<div class="modal-body">
						<input type="hidden" class="form-control col-lg-12" id="processout_id" name="processout_id" value="<?= $idOut ?>" readonly>
						<?= form_error('processout_id', '<small class="text-danger pl-3">', '</small>'); ?>
						<input type="hidden" class="form-control col-lg-12" id="item_id" name="item_id" value="<?= $bt->id_barang ?>" readonly>
						<?= form_error('item_id', '<small class="text-danger pl-3">', '</small>'); ?>
						<input type="hidden" class="form-control col-lg-12" id="process" name="process" value="Keluar" readonly>
						<?= form_error('process', '<small class="text-danger pl-3">', '</small>'); ?>
						<div class="form-group">
							<label for="name">Distribusi</label>
							<select class="form-control mb-4 col-lg-8" id="distribution" name="distribution">
								<option value="">Pilih pemindahan...</option>
								<option value="Produksi">Produksi</option>
								<option value="Penjualan">Penjualan</option>
							</select>
							<?= form_error('distribution', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-group">
							<label for="quantity">Jumlah Barang</label>
							<input type="text" class="form-control col-lg-12" id="quantity" name="quantity" placeholder="Masukkan angka" value="<?= set_value('quantity') ?>">
							<?= form_error('quantity', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<input type="hidden" class="form-control col-lg-12" id="added_by" name="added_by" value="<?= $user['name'] ?>" readonly>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
						<button class="btn btn-primary">Kirim</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>

<!-- End Modal Keluar -->
