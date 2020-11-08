<?php
        date_default_timezone_set('Asia/Jakarta');
		$currDate = date('d/m/Y');
		$pdf = new TCPDF('P', 'mm', 'A4');
		$pdf->SetTitle('Laporan Detail Pembelian | Goodie Bag Press');
		$pdf->SetSubject('Laporan Detail Pembelian');
		$pdf->setPrintHeader(false);
		$pdf->SetLeftMargin(18);
		// membuat halaman baru
		$pdf->AddPage();
		// memuat gambar
		$pdf->Image('assets/img/logo.png', 10, 10, 62, 12);
		// setting jenis font yang akan digunakan
		$pdf->SetFont('helvetica', 'B', 16);
		// mencetak string 
		$pdf->Cell(240, 7, 'GOODIE BAG PRESS', 0, 1, 'C');
		$pdf->SetFont('helvetica', '', 10);
		$pdf->Cell(240, 7, 'Jl. Aselih No.53, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta - 12630', 0, 1, 'C');
		$pdf->Cell(240, 2, 'Nomor Telepon/WhatsApp: 0877-7019-2013', 0, 1, 'C');
		$pdf->Cell(240, 7, 'Email: goodiebagnanda@gmail.com', 0, 1, 'C');
		$pdf->Line(7, 35, 210 - 5, 35); // 20mm from each edge
		// Memberikan space kebawah agar tidak terlalu rapat
		$pdf->SetLeftMargin(7);
		$pdf->SetFont('helvetica', 'B', 18);
		$pdf->Cell(10, 4, '', 0, 1);
		$pdf->Cell(0, 7, 'Laporan Detail Pembelian', 0, 0, 'L');
		$pdf->SetFont('helvetica', '', 12);
		$pdf->Cell(5, 7, $currDate, 0, 1, 'R');
		$pdf->Cell(10, 4, '', 0, 1);
        $pdf->Cell(0, 7, 'No. Faktur: '. $getFaktur['no_faktur'], 0, 0, 'L');
        $pdf->Cell(5, 7, 'Nama Pemasok: '. $getPemasok['nama_pemasok'], 0, 1, 'R');
		$pdf->SetFont('helvetica', 'B', 10);
		$pdf->SetLeftMargin(13);
		$pdf->Cell(10, 6, 'NO', 1, 0);
		$pdf->Cell(40, 6, 'NAMA BARANG', 1, 0);
		$pdf->Cell(35, 6, 'KETERANGAN', 1, 0);
		$pdf->Cell(25, 6, 'WARNA', 1, 0);
		$pdf->Cell(20, 6, 'HARGA', 1, 0);
		$pdf->Cell(25, 6, 'JUMLAH', 1, 0);
		$pdf->Cell(30, 6, 'SUBTOTAL', 1, 1);
		$pdf->SetFont('helvetica', '', 10);
		$getdetail = $this->purchase->getPembelian2();
		$no = 1;
		$total = 0;
			foreach ($getdetail as $row) {
				$pdf->Cell(10, 6, $no++, 1, 0);
				$pdf->Cell(40, 6, $row->nama_barang, 1, 0);
				$pdf->Cell(35, 6, $row->keterangan, 1, 0);
				$pdf->Cell(25, 6, $row->warna, 1, 0);
				$pdf->Cell(20, 6, number_format($row->harga, 0, ',', '.'), 1, 0, 'R');
				$pdf->Cell(25, 6, $row->jumlah, 1, 0, 'R');
	
				$pdf->Cell(30, 6, number_format($row->subtotal, 0, ',', '.'), 1, 1, 'R');
				$total += $row->subtotal;
		}
		$pdf->Cell(10, 6, '', 0, 0);
			$pdf->Cell(40, 6, '', 0, 0);
			$pdf->Cell(35, 6, '', 0, 0);
			$pdf->Cell(25, 6, '', 0, 0);
			$pdf->Cell(20, 6, '', 0, 0);
			$pdf->SetFont('helvetica', '', 12);
			$pdf->Cell(25, 6, 'Total:', 0, 0);
			$pdf->SetFont('helvetica', '', 10);
		$pdf->Cell(30, 6, number_format($total, 0, ',', '.'), 1, 1, 'R');
		$pdf->Output('Laporan Detail Pembelian.pdf', 'I');