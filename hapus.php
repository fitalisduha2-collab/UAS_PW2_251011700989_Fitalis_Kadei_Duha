<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include "config/koneksi.php";
include "controller/Pelatihan.php";

$pelatihan = new Pelatihan($koneksi);

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $data = $pelatihan->tampilById($id);

    if($data['gambar'] != ""){

        $file = "assets/upload/".$data['gambar'];

        if(file_exists($file)){
            unlink($file);
        }

    }

    $pelatihan->hapus($id);

    echo "<script>

        alert('Data berhasil dihapus');

        window.location='dashboard.php';

    </script>";

}else{

    header("Location: dashboard.php");

}

?>