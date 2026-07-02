<?php
session_start();

if(isset($_SESSION['login'])){
    header("Location: dashboard.php");
    exit;
}

include "config/koneksi.php";
include "controller/User.php";

$user = new User($koneksi);

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = $user->login($username,$password);

    if($data){

        $_SESSION['login'] = true;
        $_SESSION['id'] = $data['id'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];

        header("Location: dashboard.php");
        exit;

    }else{

        $error = "Username atau Password salah!";

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login | Manajemen Pelatihan Pemrograman</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{

    background:#f5f7fa;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    font-family:Arial, Helvetica, sans-serif;

}

.card-login{

    width:400px;
    background:#ffffff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 0 15px rgba(0,0,0,0.15);

}

.logo{

    text-align:center;
    font-size:55px;
    color:#0d6efd;
    margin-bottom:10px;

}

h3{

    text-align:center;
    margin-bottom:5px;

}

p{

    text-align:center;
    color:#666;
    margin-bottom:25px;

}

.form-control{

    height:45px;

}

.btn-login{

    height:45px;
    font-weight:bold;

}

</style>

</head>

<body>

<div class="card-login">

<div class="logo">

<i class="fa-solid fa-user-lock"></i>

</div>

<h3>

Manajemen Pelatihan Pemrograman

</h3>

<p>

Silakan login terlebih dahulu

</p>

<?php

if(isset($error)){

?>

<div class="alert alert-danger">

<?= $error; ?>

</div>

<?php

}

?>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Username

</label>

<input
type="text"
name="username"
class="form-control"
placeholder="Masukkan Username"
required>

</div>

<div class="mb-3">

<label class="form-label">

Password

</label>

<div class="input-group">

<input
type="password"
name="password"
id="password"
class="form-control"
placeholder="Masukkan Password"
required>

<button
type="button"
class="btn btn-outline-secondary"
onclick="showPassword()">

<i class="fa-solid fa-eye" id="icon"></i>

</button>

</div>

</div>

<button
type="submit"
name="login"
class="btn btn-primary btn-login w-100">

<i class="fa-solid fa-right-to-bracket"></i>

Login

</button>

</form>

<hr>

<p class="mt-3">

Belum punya akun?

<a href="register.php">

Daftar Sekarang

</a>

</p>

</div>

<script>

function showPassword(){

let password=document.getElementById("password");

let icon=document.getElementById("icon");

if(password.type==="password"){

password.type="text";

icon.classList.remove("fa-eye");

icon.classList.add("fa-eye-slash");

}else{

password.type="password";

icon.classList.remove("fa-eye-slash");

icon.classList.add("fa-eye");

}

}

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>