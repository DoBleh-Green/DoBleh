<?php
session_start();

// Menghapus semua variabel sesi
session_unset();

// Menghancurkan sesi
session_destroy();

// Mengarahkan pengguna ke halaman login atau halaman lain yang sesuai
header("Location:login.php?msg=Logout-success");
$_SESSION['status'] = "logout";
exit();
?>