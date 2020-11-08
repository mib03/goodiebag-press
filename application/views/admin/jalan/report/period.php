<?php
date_default_timezone_set('Asia/Jakarta');
$currDate = date('d/m/Y');
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetTitle('Laporan Surat Jalan | Goodie Bag Press');
$pdf->SetSubject('Laporan Surat Jalan');
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
$pdf->Cell(0, 7, 'Laporan Surat Jalan (Periode)', 0, 0, 'L');
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(5, 7, $currDate, 0, 1, 'R');
$pdf->Cell(10, 4, '', 0, 1);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetLeftMargin(8);
$pdf->Cell(10, 6, 'NO', 1, 0, 'C');
$pdf->Cell(30, 6, 'KODE SURAT', 1, 0, 'C');
$pdf->Cell(28, 6, 'NO FAKTUR', 1, 0, 'C');
$pdf->Cell(25, 6, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(20, 6, 'KURIR', 1, 0, 'C');
$pdf->Cell(28, 6, 'KENDARAAN', 1, 0, 'C');
$pdf->Cell(28, 6, 'EKSPEDISI', 1, 0, 'C');
$pdf->Cell(27, 6, 'NO POLISI', 1, 1, 'C');
$pdf->SetFont('helvetica', '', 10);
$no = 1;
foreach ($jalan as $row) {
    $pdf->Cell(10, 6, $no++, 1, 0);
    $pdf->Cell(30, 6, $row->id_jalan, 1, 0);
    $pdf->Cell(28, 6, $row->no_faktur, 1, 0);
    $pdf->Cell(25, 6, $row->tanggal, 1, 0);
    $pdf->Cell(20, 6, $row->nama_kurir, 1, 0);
    $pdf->Cell(28, 6, $row->nama_kendaraan, 1, 0);
    $pdf->Cell(28, 6, $row->perusahaan, 1, 0);
    $pdf->Cell(27, 6, $row->no_polisi, 1, 1);
}
$pdf->Output('Laporan Surat Jalan (Periode).pdf', 'I');