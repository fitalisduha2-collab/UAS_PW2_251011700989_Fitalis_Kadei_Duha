<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include "config/koneksi.php";
include "controller/Pelatihan.php";

$pelatihan = new Pelatihan($koneksi);

if(isset($_POST['simpan'])){

    $nama = $_POST['nama_pelatihan'];
    $instruktur = $_POST['instruktur'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal'];
    $peserta = $_POST['peserta'];

    $gambar = $pelatihan->upload($_FILES['gambar']);

    if($gambar === false){

        echo "<script>
                alert('Format gambar harus JPG, JPEG atau PNG');
                window.location='tambah.php';
              </script>";

        exit;
    }

    $pelatihan->tambah(
        $nama,
        $instruktur,
        $kategori,
        $tanggal,
        $peserta,
        $gambar
    );

    echo "<script>
            alert('Data berhasil ditambahkan');
            window.location='dashboard.php';
          </script>";

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Pelatihan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
    background:#181818;
}

.card{

    background:#242424;
    color:white;
    border-radius:15px;
    margin-top:40px;
    box-shadow:0 0 20px rgba(0,0,0,.5);

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

    margin-top:10px;
    width:120px;
    border-radius:10px;
    display:none;

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

<i class="fa fa-plus-circle"></i>

Tambah Data Pelatihan

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
required>

</div>

<div class="mb-3">

<label>Instruktur</label>

<input
type="text"
name="instruktur"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Kategori</label>

<select
name="kategori"
class="form-select"
required>

<option value="">-- Pilih --</option>

<option>Web</option>

<option>Framework</option>

<option>Mobile</option>

<option>AI</option>

<option>Desktop</option>

</select>

</div>

<div class="mb-3">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Jumlah Peserta</label>

<input
type="number"
name="peserta"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Upload Foto</label>

<input
type="file"
name="gambar"
class="form-control"
accept=".jpg,.jpeg,.png"
onchange="preview(event)"
required>

<img id="preview">

</div>

<button
class="btn btn-success"
name="simpan">

<i class="fa fa-save"></i>

Simpan

</button>

<a
href="dashboard.php"
class="btn btn-secondary">

<i class="fa fa-arrow-left"></i>

Kembali

</a>

</form>

</div>

</div>

</div>

</div>

</div>

<script>

function preview(event){

let gambar=document.getElementById("preview");

gambar.src=URL.createObjectURL(event.target.files[0]);

gambar.style.display="block";

}

</script>

</body>

</html>