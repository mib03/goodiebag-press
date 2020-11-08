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
	<h1 class="h3 mb-4 text-gray-800 ">Pesanan Pembelian</h1>

	<div class="clearfix">
		<button class="btn btn-primary mb-3 ml-auto float-left" data-toggle="modal" data-target="#inModal"><i class="fas fa fa-fw fa-plus"></i> Pesan Barang</button>
	</div>

	<!-- DataTables Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<form class="form-horizontal" method="post" action="<?= base_url() . 'purchase/buy' ?>">
				<div class="clearfix">
					<label for="no_faktur" class="float-left mt-2 mr-2">No. Faktur: </label>
					<input type="text" class="form-control col-3 mb-3 float-left" id="no_faktur" name="no_faktur" value="<?= $idPurchase ?>" readonly>
					<select class="form-control col-3 float-right" id="nama_pemasok" name="nama_pemasok">
						<option value="">Pilih pemasok...</option>
						<?php foreach ($dataSupplier as $key => $value) : ?>
							<option value="<?= $value->nama_pemasok ?>"><?= $value->nama_pemasok ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<input type="hidden" class="form-control col-3 mb-3 float-right" id="tanggal" name="tanggal" value="<?= $dateNow; ?>" readonly>
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
								foreach ($potable as $pt) :
								?>
									<td><?= $no++ ?></td>
									<td><?= $pt->nama_barang ?></td>
									<td><?= $pt->keterangan ?></td>
									<td><?= $pt->warna ?></td>
									<td><?= number_format($pt->harga, 0, ',', '.') ?></td>
									<td><?= $pt->jumlah ?></td>
									<td><?= number_format($pt->subtotal, 0, ',', '.') ?></td>
									<?php $total += $pt->subtotal; ?>
							</tr>
						<?php endforeach; ?>
						<tr>
							<td colspan="6"><b class="h5">Total :</b></td>
							<td><?= number_format($total, 0, ',', '.')  ?></td>
						</tr>
						</tbody>
					</table>
					<div class="clearfix mt-3">
						<input type="hidden" class="form-control col-3 mb-3 float-left" id="total" name="total" value="<?= $total ?>" readonly>
						<input type="hidden" class="form-control col-lg-12" id="added_by" name="added_by" value="<?= $user['name'] ?>" readonly>
						<button class="btn btn-primary col-xl-1 float-right ml-2">Kirim</button>
						<button type="button" class="btn btn-secondary col-xl-1 float-right" data-toggle="modal" data-target="#cancelConfirm">Batal</button>
					</div>
				</div>
			</form>
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

<!-- Modal Tambah -->

<div class="modal fade" id="inModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Pesan Barang</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="form-horizontal" method="post" action="<?= base_url('purchase/insert') ?>">
				<div class="modal-body">
					<input type="hidden" class="form-control col-lg-6" id="no_faktur" name="no_faktur" value="<?= $idPurchase ?>" readonly>
					<div class="form-group">
						<label for="name">Kode Barang</label>
						<select name="id_barang" class="form-control mb-4 col-lg-4" onchange="changeValue(this.value)">
							<option value="">Pilih kode...</option>
							<?php

							$jsArray = "var prdName = new Array();\n";
							foreach ($barangtable as $row) {
								echo '<option value="' . $row->id_barang . '">' . $row->id_barang . '</option>';
								$jsArray .= "prdName['" . $row->id_barang . "'] = {harga:'" . addslashes($row->harga_beli) . "'};\n";
							}
							?>
						</select>
						<?= form_error('id_barang', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label for="harga">Harga</label>
						<div class="row ml-0">
							<input type="text" class="form-control col-6" id="harga" name="harga" readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="jumlah">Jumlah</label>
						<div class="row ml-0">
							<input type="text" class="form-control col-6" placeholder="Masukkan angka" id="jumlah" name="jumlah">
						</div>
					</div>
					<div class="form-group">
						<label for="subtotal">Subtotal</label>
						<div class="row ml-0">
							<input type="text" class="form-control col-6" id="subtotal" name="subtotal" readonly>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary">Kirim</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- End Modal Tambah -->

<!-- Modal Cancel -->

<div class="modal fade" id="cancelConfirm" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Konfirmasi Batal</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="form-horizontal" method="post" action="<?= base_url('purchase/delete') ?>">
				<div class="modal-body">
					Apakah anda yakin ingin membatalkan pesanan ini? Pesanan yang telah dimasukkan akan dihapus secara permanen.
				</div>
				<div class="modal-footer">
					<button class="btn btn-light" data-dismiss="modal" aria-label="Close">Batal</button>
					<button class="btn btn-danger">Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- End Modal Tambah -->

<script type="text/javascript">
	<?php echo $jsArray; ?>

	function changeValue(x) {
		document.getElementById('harga').value = prdName[x].harga;
	};

	$(document).ready(function() {
		/*
		 * binding onChange event here
		 * you can replace .change with .blur
		 */
		$('#harga').change(hasilJumlah);
		$('#jumlah').change(hasilJumlah);
	});

	function hasilJumlah() {
		var harga = $('#harga').val();
		var jumlah = $('#jumlah').val();
		var subtotal = harga * jumlah;
		$('#subtotal').val(subtotal);
	}
</script>