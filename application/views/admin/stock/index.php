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
	<h1 class="h3 mb-4 text-gray-800">Stok Barang</h1>

	<!-- DataTables Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Table Stok</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="barangTable" width="100%" cellspacing="0">
					<thead>
						<tr style="cursor:pointer">
							<th>No</th>
							<th style="width: 180px">Nama Barang</th>
							<th>Tipe</th>
							<th>Satuan</th>
							<th>Keterangan</th>
							<th>Warna</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<?php
					foreach ($stoktable as $st) :
						?>
						<tbody>
							<tr>
								<td><?= ++$start ?></td>
								<td><?= $st->item_name ?></td>
								<td><?= $st->type ?></td>
								<td><?= $st->unit ?></td>
								<td><?= $st->information ?></td>
								<td><?= $st->color ?></td>
            					<td><?= $st->quantity ?></td>							</tr>
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

<script>
	$(document).ready(function() {
		$('#barangTable').DataTable();
	});
</script>
