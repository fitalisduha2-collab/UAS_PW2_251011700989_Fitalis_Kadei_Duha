<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include "config/koneksi.php";
include "controller/Pelatihan.php";

$pelatihan = new Pelatihan($koneksi);

if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $data = $pelatihan->cari($_GET['cari']);
} else {
    $data = $pelatihan->tampil();
}

$totalPelatihan = $pelatihan->totalPelatihan();
$totalPeserta = $pelatihan->totalPeserta();
$totalInstruktur = $pelatihan->totalInstruktur();

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard | Manajemen Pelatihan Pemrograman</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
transition:.3s;
}

/* ===========================
   DARK MODE
=========================== */

body{

background:linear-gradient(135deg,#050505,#111827,#000);
background-size:400% 400%;
animation:bgAnimation 15s ease infinite;
color:white;

}

@keyframes bgAnimation{

0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}

}

.sidebar{

width:250px;
height:100vh;
background:#161b22;
position:fixed;
left:0;
top:0;
overflow:auto;
border-right:1px solid #30363d;
box-shadow:5px 0 20px rgba(0,0,0,.5);

}

.logo{

padding:25px;
text-align:center;
font-size:22px;
font-weight:bold;
color:#58a6ff;
border-bottom:1px solid #30363d;

}

.sidebar a{

display:block;
padding:16px 25px;
color:#f0f6fc;
text-decoration:none;

}

.sidebar a:hover{

background:#238636;
padding-left:35px;

}

.content{

margin-left:250px;
padding:30px;

}

.header{

background:#161b22;
padding:25px;
border-radius:15px;
border:1px solid #30363d;
margin-bottom:25px;

}

.card-box{

padding:25px;
border-radius:15px;
color:white;
cursor:pointer;
position:relative;
overflow:hidden;

}

.card-box:hover{

transform:translateY(-8px);

}

.bg1{

background:linear-gradient(135deg,#0d6efd,#00c6ff);

}

.bg2{

background:linear-gradient(135deg,#198754,#00d68f);

}

.bg3{

background:linear-gradient(135deg,#dc3545,#ff7b7b);

}

.search-box{

background:#161b22;
padding:20px;
border-radius:15px;
margin-bottom:20px;

}

.form-control{

background:#20252d !important;
color:white !important;
border:1px solid #444;

}

.form-control::placeholder{

color:#bbb;

}

.table{

background:white;
border-radius:10px;

}

.table img{

width:70px;
height:70px;
object-fit:cover;
border-radius:10px;

}

/* ===========================
   LIGHT MODE
=========================== */

body.light{

background:#f4f6f9;
color:#222;

}

body.light .sidebar{

background:white;
border-right:1px solid #ddd;

}

body.light .logo{

color:#0d6efd;

}

body.light .sidebar a{

color:#222;

}

body.light .sidebar a:hover{

background:#0d6efd;
color:white;

}

body.light .header{

background:white;
color:#222;

}

body.light .search-box{

background:white;

}

body.light .form-control{

background:white !important;
color:black !important;

}

body.light .table{

background:white;
color:black;

}

body.light .table thead{

background:#0d6efd;
color:white;

}

</style>

</head>

<body>

<div class="sidebar">

<div class="logo">

<i class="fa-solid fa-laptop-code"></i>

<br>

Manajemen Pelatihan

</div>

<a href="dashboard.php">

<i class="fa fa-house"></i>

Dashboard

</a>

<a href="tambah.php">

<i class="fa fa-plus-circle"></i>

Tambah Data

</a>

<a href="laporan.php">

<i class="fa fa-file-lines"></i>

Laporan

</a>

<a href="logout.php">

<i class="fa fa-right-from-bracket"></i>

Logout

</a>

</div>

<div class="content">

<div class="header">

<div class="d-flex justify-content-between align-items-center">

<div>

<h3>

Selamat Datang,
<?= $_SESSION['nama']; ?>

</h3>

<p>

Role :
<b><?= strtoupper($_SESSION['role']); ?></b>

</p>

</div>

<button
id="themeToggle"
class="btn btn-light">

🌙

</button>

</div>

</div>

<div class="row">

<div class="col-md-4">

<div class="card-box bg1">

<h5>Total Pelatihan</h5>

<h2><?= $totalPelatihan; ?></h2>

</div>

</div>

<div class="col-md-4">

<div class="card-box bg2">

<h5>Total Peserta</h5>

<h2><?= $totalPeserta; ?></h2>

</div>

</div>

<div class="col-md-4">

<div class="card-box bg3">

<h5>Total Instruktur</h5>

<h2><?= $totalInstruktur; ?></h2>

</div>

</div>

</div>

<div class="search-box">

<form method="GET">

<div class="input-group">

<input
type="text"
name="cari"
class="form-control"
placeholder="Cari Pelatihan..."
value="<?= isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">

<button class="btn btn-primary">

<i class="fa fa-search"></i>

Cari

</button>

<a href="dashboard.php"
class="btn btn-secondary">

Refresh

</a>

</div>

</form>

</div>

<table class="table table-bordered table-hover align-middle shadow">

<thead class="table-dark">

<tr>

<th width="5%">No</th>

<th width="10%">Foto</th>

<th>Nama Pelatihan</th>

<th>Instruktur</th>

<th>Kategori</th>

<th>Tanggal</th>

<th>Peserta</th>

<th width="18%">Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no = 1;

while($row = mysqli_fetch_assoc($data)){

?>

<tr>

<td class="text-center">

<?= $no++; ?>

</td>

<td class="text-center">

<?php

if($row['gambar']==""){

?>

<span class="badge bg-secondary">

Tidak Ada

</span>

<?php

}else{

?>

<img
src="assets/upload/<?= $row['gambar']; ?>"
alt="Foto Pelatihan">

<?php

}

?>

</td>

<td>

<strong>

<?= $row['nama_pelatihan']; ?>

</strong>

</td>

<td>

<?= $row['instruktur']; ?>

</td>

<td>

<span class="badge bg-primary">

<?= $row['kategori']; ?>

</span>

</td>

<td>

<?= date("d-m-Y",strtotime($row['tanggal'])); ?>

</td>

<td>

<span class="badge bg-success">

<?= $row['peserta']; ?> Peserta

</span>

</td>

<td>

<a
href="edit.php?id=<?= $row['id']; ?>"
class="btn btn-warning btn-sm">

<i class="fa-solid fa-pen-to-square"></i>

Edit

</a>

<a
href="hapus.php?id=<?= $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus data ini?')">

<i class="fa-solid fa-trash"></i>

Hapus

</a>

</td>

</tr>

<?php

}

?>

<?php

if(mysqli_num_rows($data)==0){

?>

<tr>

<td colspan="8" class="text-center">

Belum ada data pelatihan.

</td>

</tr>

<?php

}

?>

</tbody>

</table>

<div class="d-flex justify-content-between mt-4">

<div>

<a
href="tambah.php"
class="btn btn-success">

<i class="fa fa-plus-circle"></i>

Tambah Data

</a>

</div>

<div>

<a
href="laporan.php"
class="btn btn-info text-white">

<i class="fa-solid fa-file-lines"></i>

Laporan

</a>

<a
href="laporan_pdf.php"
class="btn btn-danger">

<i class="fa-solid fa-file-pdf"></i>

PDF

</a>

<a
href="laporan_excel.php"
class="btn btn-success">

<i class="fa-solid fa-file-excel"></i>

Excel

</a>

</div>

</div>

<hr class="mt-5">

<div class="text-center text-secondary">

<p>

&copy; <?= date("Y"); ?>

Manajemen Pelatihan Pemrograman

<br>

Dibuat oleh <strong>Fitalis Duha</strong>

</p>

</div>

<hr class="mt-5">

<div class="text-center text-secondary">

<p>

&copy; <?= date("Y"); ?>

Manajemen Pelatihan Pemrograman

<br>

Dibuat oleh <strong>Fitalis Duha</strong>

</p>

</div>

</div>

<script>

const themeToggle = document.getElementById("themeToggle");

if(localStorage.getItem("theme")=="light"){

    document.body.classList.add("light");
    themeToggle.innerHTML="☀️";

}else{

    themeToggle.innerHTML="🌙";

}

themeToggle.onclick=function(){

    document.body.classList.toggle("light");

    if(document.body.classList.contains("light")){

        localStorage.setItem("theme","light");
        themeToggle.innerHTML="☀️";

    }else{

        localStorage.setItem("theme","dark");
        themeToggle.innerHTML="🌙";

    }

}

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>