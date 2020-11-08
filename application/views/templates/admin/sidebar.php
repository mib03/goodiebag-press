<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
		<div class="sidebar-brand-text mx-3 col-12">Goodie Bag Press</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Administrator
	</div>

	<!-- Nav Item - Dashboard -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('admin') ?>">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Master Data
	</div>

	<!-- Nav Item - Dashboard -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBarang" aria-expanded="true" aria-controls="collapseBarang">
			<i class="far fa-fw fa-clipboard"></i>
			<span>Data Barang</span>
		</a>
		<div id="collapseBarang" class="collapse" aria-labelledby="headingBarang" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Kontrol Barang:</h6>
				<a class="collapse-item" href="<?= base_url('barang') ?>">Barang</a>
				<a class="collapse-item" href="<?= base_url('jenis') ?>">Jenis</a>
				<a class="collapse-item" href="<?= base_url('kendaraan') ?>">Kendaraan</a>
			</div>
		</div>
	</li>
	<!-- Nav Item - Dashboard -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('supplier') ?>">
			<i class="fas fa-fw fa-truck"></i>
			<span>Data Pemasok</span></a>
	</li>
	<!-- Nav Item - Dashboard -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('user') ?>">
			<i class="fas fa-fw fa-user"></i>
			<span>Data Pengguna</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Menu Pengelolaan
	</div>

	<!-- Nav Item - Purchase -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('purchase') ?>">
			<i class="fas fa-fw fa-boxes"></i>
			<span>Pesanan Pembelian</span></a>
	</li>

	<!-- Nav Item - Transaksi -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('transaction') ?>">
			<i class="fas fa-fw fa-exchange-alt"></i>
			<span>Transaksi Barang</span></a>
	</li>

	<!-- Nav Item - Transaksi -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('jalan') ?>">
			<i class="fas fa-fw fa-file-alt"></i>
			<span>Surat Jalan</span></a>
	</li>

	<!-- Nav Item - Laporan Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFinances" aria-expanded="true" aria-controls="collapseFinances">
			<i class="far fa-fw fa-clipboard"></i>
			<span>Laporan</span>
		</a>
		<div id="collapseFinances" class="collapse" aria-labelledby="headingFinances" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Kontrol Laporan:</h6>
				<a class="collapse-item" href="<?= base_url('stock/report') ?>">Stok Barang</a>
				<a class="collapse-item" href="<?= base_url('purchase/report') ?>">Pesanan Pembelian</a>
				<a class="collapse-item" href="<?= base_url('in/report') ?>">Barang Masuk</a>
				<a class="collapse-item" href="<?= base_url('out/report') ?>">Barang Keluar</a>
				<a class="collapse-item" href="<?= base_url('jalan/report') ?>">Surat Jalan</a>
			</div>
		</div>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Dashboard -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
			<i class="fas fa-fw fa-sign-out-alt"></i>
			<span>Logout</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
<!-- End of Sidebar -->