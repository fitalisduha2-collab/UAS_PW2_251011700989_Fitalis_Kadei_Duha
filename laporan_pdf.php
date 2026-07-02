<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

require('fpdf/fpdf.php');
include "config/koneksi.php";

$pdf = new FPDF('L','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,10,'LAPORAN DATA PELATIHAN PEMROGRAMAN',0,1,'C');

$pdf->SetFont('Arial','',11);
$pdf->Cell(0,8,'Tanggal Cetak : '.date('d-m-Y'),0,1,'R');

$pdf->Ln(3);

$pdf->SetFont('Arial','B',11);

$pdf->Cell(15,10,'No',1,0,'C');
$pdf->Cell(70,10,'Nama Pelatihan',1,0,'C');
$pdf->Cell(50,10,'Instruktur',1,0,'C');
$pdf->Cell(40,10,'Kategori',1,0,'C');
$pdf->Cell(35,10,'Tanggal',1,0,'C');
$pdf->Cell(30,10,'Peserta',1,0,'C');

$pdf->Ln();

$pdf->SetFont('Arial','',10);

$no = 1;

$data = mysqli_query($koneksi,"SELECT * FROM pelatihan ORDER BY id DESC");

while($row = mysqli_fetch_assoc($data)){

    $pdf->Cell(15,10,$no++,1,0,'C');
    $pdf->Cell(70,10,$row['nama_pelatihan'],1);
    $pdf->Cell(50,10,$row['instruktur'],1);
    $pdf->Cell(40,10,$row['kategori'],1);
    $pdf->Cell(35,10,date('d-m-Y',strtotime($row['tanggal'])),1,0,'C');
    $pdf->Cell(30,10,$row['peserta'],1,0,'C');

    $pdf->Ln();

}

$pdf->Output(
    'I',
    'Laporan_Pelatihan.pdf'
);

?>