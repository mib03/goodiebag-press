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
	<h1 class="h3 mb-4 text-gray-800">Data Kendaraan</h1>

	<div class="clearfix">
		<?= anchor('kendaraan/insert', '<button type="button" name="print" class="btn btn-primary mb-3 ml-auto float-left"><span class="fa fa-fw fa-plus"></span> Tambah Kendaraan</button>') ?>
	</div>

	<!-- DataTables Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Table Kendaraan</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Kode Kendaraan</th>
							<th>Nama Kendaraan</th>
							<th style="width: 165px">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php
							foreach ($kendaraantable as $kt) :
							?>
								<td><?= $kt->id_kendaraan ?></td>
								<td><?= $kt->nama_kendaraan ?></td>
								<td>
									<a class="btn btn-primary" href="<?= base_url('kendaraan/update/' . $kt->id_kendaraan); ?>"><i class="fa fa-fw fa-edit"></i> Edit</a>
									<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $kt->id_kendaraan; ?>"><i class="fa fa-fw fa-trash-alt"></i> Hapus</button>
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

<!-- Modal Delete -->

<?php
foreach ($kendaraantable as $kt) :
?>
	<div class="modal fade" id="deleteModal<?php echo $kt->id_kendaraan; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Konfirmasi Hapus</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url() . 'kendaraan/delete' ?>">
					<div class="modal-body">
						<p>Apakah anda yakin ingin menghapus data kendaraan <b><?= $kt->nama_kendaraan ?> </b>? Proses ini tidak dapat dibatalkan dan akan dihapus secara permanen.</p>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="id" value="<?php echo $kt->id_kendaraan; ?>">
						<button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
						<button class="btn btn-danger">Hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>

<!-- End Modal Delete -->
