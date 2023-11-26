<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Selamat Datang,
        <?php echo $_SESSION['username']; ?>!
    </h1>
    <a onclick="location.href='../login/logout.php'">Logout</a>
</body>

</html>