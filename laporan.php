<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include "config/koneksi.php";

$data = mysqli_query($koneksi,"SELECT * FROM pelatihan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Laporan Data Pelatihan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#181818;
    color:white;
}

.card{
    margin-top:40px;
    background:#242424;
    border-radius:15px;
}

</style>

</head>

<body>

<div class="container">

<div class="card">

<div class="card-header d-flex justify-content-between">

<h3>Laporan Data Pelatihan</h3>

<div>

<a href="laporan_pdf.php" class="btn btn-danger">

Export PDF

</a>

<a href="laporan_excel.php" class="btn btn-success">

Export Excel

</a>

<a href="dashboard.php" class="btn btn-secondary">

Kembali

</a>

</div>

</div>

<div class="card-body">

<table class="table table-dark table-bordered table-hover">

<thead>

<tr>

<th>No</th>
<th>Nama Pelatihan</th>
<th>Instruktur</th>
<th>Kategori</th>
<th>Tanggal</th>
<th>Peserta</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($row=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama_pelatihan']; ?></td>

<td><?= $row['instruktur']; ?></td>

<td><?= $row['kategori']; ?></td>

<td><?= date('d-m-Y',strtotime($row['tanggal'])); ?></td>

<td><?= $row['peserta']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</body>

</html>