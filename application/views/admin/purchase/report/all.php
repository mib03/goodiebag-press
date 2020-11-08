<?php
date_default_timezone_set('Asia/Jakarta');
$currDate = date('d/m/Y');
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetTitle('Laporan Pembelian Barang | Goodie Bag Press');
$pdf->SetSubject('Laporan Pembelian Barang');
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
$pdf->Cell(0, 7, 'Laporan Pesanan Pembelian (Semua)', 0, 0, 'L');
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(5, 7, $currDate, 0, 1, 'R');
$pdf->Cell(10, 4, '', 0, 1);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetLeftMargin(10);
$pdf->Cell(10, 6, 'NO', 1, 0, 'C');
$pdf->Cell(30, 6, 'NO FAKTUR', 1, 0, 'C');
$pdf->Cell(25, 6, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(35, 6, 'NAMA PEMASOK', 1, 0, 'C');
$pdf->Cell(20, 6, 'HARGA', 1, 0, 'C');
$pdf->Cell(36, 6, 'PENGGUNA', 1, 0, 'C');
$pdf->Cell(35, 6, 'WAKTU', 1, 1, 'C');
$pdf->SetFont('helvetica', '', 10);
$no = 1;
foreach ($purchase as $row) {
    $pdf->Cell(10, 6, $no++, 1, 0);
    $pdf->Cell(30, 6, $row->no_faktur, 1, 0);
    $pdf->Cell(25, 6, $row->tanggal, 1, 0);
    $pdf->Cell(35, 6, $row->nama_pemasok, 1, 0);
    $pdf->Cell(20, 6, number_format($row->harga, 0, ',', '.'), 1, 0, 'R');
    $pdf->Cell(36, 6, $row->added_by, 1, 0);
    $pdf->Cell(35, 6, date("d/m/Y H:i:s", strtotime($row->date_added)), 1, 1);
}
$pdf->Output('Laporan Pembelian Barang (Semua).pdf', 'I');