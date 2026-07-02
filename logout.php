<?php
session_start();

// Menghapus semua data session
$_SESSION = array();

// Menghancurkan session
session_destroy();

// Kembali ke halaman utama
header("Location: index.php");
exit;
?>