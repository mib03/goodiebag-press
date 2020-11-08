<?php
date_default_timezone_set('Asia/Jakarta');
$currDate = date('d/m/Y');
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetTitle('Laporan Barang Masuk | Goodie Bag Press');
$pdf->SetSubject('Laporan Barang Masuk');
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
$pdf->SetLeftMargin(8);
$pdf->SetFont('helvetica', 'B', 18);
$pdf->Cell(10, 4, '', 0, 1);
$pdf->Cell(0, 7, 'Laporan Barang Masuk (Periode)', 0, 0, 'L');
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(5, 7, $currDate, 0, 1, 'R');
$pdf->Cell(10, 4, '', 0, 1);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetLeftMargin(8);
$pdf->Cell(8, 6, 'NO', 1, 0, 'C');
$pdf->Cell(35, 6, 'NAMA BARANG', 1, 0, 'C');
$pdf->Cell(28, 6, 'KETERANGAN', 1, 0, 'C');
$pdf->Cell(17, 6, 'WARNA', 1, 0, 'C');
$pdf->Cell(18, 6, 'JUMLAH', 1, 0, 'C');
$pdf->Cell(24, 6, 'HARGA BELI', 1, 0, 'C');
$pdf->Cell(22, 6, 'SUBTOTAL', 1, 0, 'C');
$pdf->Cell(21, 6, 'PEMASOK', 1, 0, 'C');
$pdf->Cell(23, 6, 'TANGGAL', 1, 1, 'C');
$pdf->SetFont('helvetica', '', 10);
$no = 1;
foreach ($in as $row) {
    $pdf->Cell(8, 6, $no++, 1, 0);
    $pdf->Cell(35, 6, $row->nama_barang, 1, 0);
    $pdf->Cell(28, 6, $row->keterangan, 1, 0);
    $pdf->Cell(17, 6, $row->warna, 1, 0);
    $pdf->Cell(18, 6, number_format($row->jumlah, 0, ',', '.'), 1, 0, 'R');
    $pdf->Cell(24, 6, number_format($row->harga_beli, 0, ',', '.'), 1, 0, 'R');
    $pdf->Cell(22, 6, number_format($row->jumlah * $row->harga_beli, 0, ',', '.'), 1, 0, 'R');
    $pdf->Cell(21, 6, $row->nama_pemasok, 1, 0);
    $pdf->Cell(23, 6, date("d/m/Y", strtotime($row->date_in)), 1, 1);
}
$pdf->Output('Laporan Barang Masuk (Periode).pdf', 'I');