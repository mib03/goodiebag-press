<?php
date_default_timezone_set('Asia/Jakarta');
$currDate = date('d/m/Y');
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetTitle('Laporan Stok Barang | Goodie Bag Press');
  $pdf->SetSubject('Laporan Stok Barang');
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
$pdf->Cell(0, 7, 'Laporan Stok Barang', 0, 0, 'L');
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(5, 7, $currDate, 0, 1, 'R');
$pdf->Cell(10, 4, '', 0, 1);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetLeftMargin(8);
$pdf->Cell(10, 6, 'NO', 1, 0, 'C');
$pdf->Cell(50, 6, 'NAMA BARANG', 1, 0, 'C');
$pdf->Cell(30, 6, 'KETERANGAN', 1, 0, 'C');
$pdf->Cell(21, 6, 'WARNA', 1, 0, 'C');
$pdf->Cell(20, 6, 'JUMLAH', 1, 0, 'C');
$pdf->Cell(30, 6, 'MIN JUMLAH', 1, 0, 'C');
$pdf->Cell(35, 6, 'MAKS JUMLAH', 1, 1, 'C');
$pdf->SetFont('helvetica', '', 10);
$no = 1;
foreach ($stock as $row) {
    $pdf->Cell(10, 6, $no++, 1, 0);
    $pdf->Cell(50, 6, $row->nama_barang, 1, 0);
    $pdf->Cell(30, 6, $row->keterangan, 1, 0);
    $pdf->Cell(21, 6, $row->warna, 1, 0);
    $pdf->Cell(20, 6, number_format($row->jumlah, 0, ',', '.'), 1, 0, 'R');
    $pdf->Cell(30, 6, number_format($row->min_jumlah, 0, ',', '.'), 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($row->maks_jumlah, 0, ',', '.'), 1, 1, 'R');
}
$pdf->Output('Laporan Stok Barang.pdf', 'I');

