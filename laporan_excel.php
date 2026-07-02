<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include "config/koneksi.php";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Pelatihan.xls");

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Laporan Excel</title>

</head>

<body>

<h2 align="center">

LAPORAN DATA PELATIHAN PEMROGRAMAN

</h2>

<table border="1" cellpadding="8" cellspacing="0">

<tr style="background:#dddddd;">

<th>No</th>

<th>Nama Pelatihan</th>

<th>Instruktur</th>

<th>Kategori</th>

<th>Tanggal</th>

<th>Jumlah Peserta</th>

</tr>

<?php

$no=1;

$data=mysqli_query(
$koneksi,
"SELECT * FROM pelatihan ORDER BY id DESC"
);

while($row=mysqli_fetch_assoc($data)){

?>

<tr>

<td align="center"><?= $no++; ?></td>

<td><?= $row['nama_pelatihan']; ?></td>

<td><?= $row['instruktur']; ?></td>

<td><?= $row['kategori']; ?></td>

<td><?= date('d-m-Y',strtotime($row['tanggal'])); ?></td>

<td align="center"><?= $row['peserta']; ?></td>

</tr>

<?php } ?>

</table>

</body>

</html>