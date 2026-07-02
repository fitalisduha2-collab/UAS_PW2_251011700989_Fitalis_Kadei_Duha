<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include "config/koneksi.php";
include "controller/Pelatihan.php";

$pelatihan = new Pelatihan($koneksi);

$id = $_GET['id'];

$data = $pelatihan->tampilById($id);

if(isset($_POST['update'])){

    $nama = $_POST['nama_pelatihan'];
    $instruktur = $_POST['instruktur'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal'];
    $peserta = $_POST['peserta'];

    if($_FILES['gambar']['name']!=""){

        $gambar = $pelatihan->upload($_FILES['gambar']);

        if($gambar===false){

            echo "<script>
            alert('Format gambar harus JPG, JPEG atau PNG');
            window.location='edit.php?id=$id';
            </script>";

            exit;

        }

    }else{

        $gambar="";

    }

    $pelatihan->edit(
        $id,
        $nama,
        $instruktur,
        $kategori,
        $tanggal,
        $peserta,
        $gambar
    );

    echo "<script>
        alert('Data berhasil diubah');
        window.location='dashboard.php';
    </script>";

}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Edit Pelatihan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{

background:#181818;

}

.card{

margin-top:40px;

background:#242424;

color:white;

border-radius:15px;

}

.form-control,
.form-select{

background:#2d2d2d;

color:white;

border:none;

}

.form-control:focus,
.form-select:focus{

background:#2d2d2d;

color:white;

}

img{

width:150px;

margin-top:10px;

border-radius:10px;

}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card">

<div class="card-header">

<h3>

<i class="fa fa-pen"></i>

Edit Data Pelatihan

</h3>

</div>

<div class="card-body">

<form
method="POST"
enctype="multipart/form-data">

<div class="mb-3">

<label>Nama Pelatihan</label>

<input
type="text"
name="nama_pelatihan"
class="form-control"
value="<?= $data['nama_pelatihan']; ?>"
required>

</div>

<div class="mb-3">

<label>Instruktur</label>

<input
type="text"
name="instruktur"
class="form-control"
value="<?= $data['instruktur']; ?>"
required>

</div>

<div class="mb-3">

<label>Kategori</label>

<select
name="kategori"
class="form-select"
required>

<option <?= ($data['kategori']=="Web")?"selected":""; ?>>Web</option>

<option <?= ($data['kategori']=="Framework")?"selected":""; ?>>Framework</option>

<option <?= ($data['kategori']=="Mobile")?"selected":""; ?>>Mobile</option>

<option <?= ($data['kategori']=="AI")?"selected":""; ?>>AI</option>

<option <?= ($data['kategori']=="Desktop")?"selected":""; ?>>Desktop</option>

</select>

</div>

<div class="mb-3">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control"
value="<?= $data['tanggal']; ?>"
required>

</div>

<div class="mb-3">

<label>Jumlah Peserta</label>

<input
type="number"
name="peserta"
class="form-control"
value="<?= $data['peserta']; ?>"
required>

</div>

<div class="mb-3">

<label>Foto Saat Ini</label>

<br>

<?php
if($data['gambar']!=""){
?>

<img
src="assets/upload/<?= $data['gambar']; ?>"
id="preview">

<?php
}else{
?>

<img
id="preview"
style="display:none;">

<?php
}
?>

</div>

<div class="mb-3">

<label>Ganti Foto (Opsional)</label>

<input
type="file"
name="gambar"
class="form-control"
accept=".jpg,.jpeg,.png"
onchange="previewGambar(event)">

</div>

<button
class="btn btn-warning"
name="update">

<i class="fa fa-save"></i>

Update

</button>

<a
href="dashboard.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</div>

</div>

<script>

function previewGambar(event){

let img=document.getElementById("preview");

img.src=URL.createObjectURL(event.target.files[0]);

img.style.display="block";

}

</script>

</body>

</html>