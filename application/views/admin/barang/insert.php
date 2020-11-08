<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="col-lg-8">

		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">Tambah Barang Baru</h1>

		<hr>

		<form class="user" method="post" action="<?= base_url('barang/insert'); ?>">
			<div class="form-group">
				<input type="hidden" class="form-control" id="stock_id" name="stock_id" value="<?= $idStock ?>" readonly>
			</div>
			<div class="form-group">
				<label for="item_id">Kode Barang</label>
				<input type="text" class="form-control" id="item_id" name="item_id" value="<?= $idBarang ?>" readonly>
			</div>
			<div class="form-group">
				<label for="item_name">Nama Barang</label>
				<input type="text" class="form-control" id="item_name" name="item_name" placeholder="Masukkan nama barang" value="<?= set_value('item_name') ?>">
				<?= form_error('item_name', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="mb-2">Jenis Barang</div>
			<select name="selectType" class="form-control mb-4 col-lg-4" onchange="changeValue(this.value)">
				<option value="">Pilih jenis...</option>
				<?php

				$jsArray = "var prdName = new Array();\n";
				foreach ($getJenis as $row) {
					echo '<option value="' . $row->jenis . '">' . $row->jenis . '</option>';
					$jsArray .= "prdName['" . $row->jenis . "'] = {satuan:'" . addslashes($row->satuan) . "'};\n";
				}
				?>
			</select>
			<?= form_error('selectType', '<small class="text-danger pl-3">', '</small>'); ?>
			<div class="form-group" id="keterangan">
				<label for="keterangan">Keterangan</label>
				<input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Contoh 30x40, Rubber dll." value="<?= set_value('keterangan') ?>">
				<?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group" style="display: none">
				<label for="satuan">Satuan</label>
				<div class="row ml-0">
					<input type="text" class="form-control col-4" id="satuan" name="satuan">
				</div>
			</div>
			<div class="form-group">
				<label for="color">Warna</label>
				<input type="text" class="form-control" id="color" name="color" placeholder="Masukkan warna barang" value="<?= set_value('color') ?>">
				<?= form_error('color', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="buy_price">Harga Beli</label>
				<input type="text" class="form-control" id="buy_price" name="buy_price" placeholder="Masukkan angka" value="<?= set_value('buy_price') ?>">
				<?= form_error('buy_price', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="min_jumlah">Minimal Stok</label>
				<input type="text" class="form-control" id="min_jumlah" name="min_jumlah" placeholder="Masukkan angka" value="<?= set_value('min_jumlah') ?>">
				<?= form_error('min_jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="maks_jumlah">Maksimal Stok</label>
				<input type="text" class="form-control" id="maks_jumlah" name="maks_jumlah" placeholder="Masukkan angka" value="<?= set_value('maks_jumlah') ?>">
				<?= form_error('maks_jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<button class="btn btn-primary mt-3 col-lg-3 col-sm-4 mb-5" type="submit" onclick="combine();">Kirim</button>
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

<script type="text/javascript">
	<?php echo $jsArray; ?>

	function changeValue(x) {
		document.getElementById('satuan').value = prdName[x].satuan;
	};
</script>