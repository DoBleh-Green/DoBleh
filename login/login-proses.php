<?php
session_start();
require '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT id_user, username, role FROM data_user WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($id_user, $username, $role);

    if ($stmt->fetch()) {
        $_SESSION['id_user'] = $id_user;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role; // Simpan peran pengguna dalam sesi
        $_SESSION['status'] = "login";

        if ($role == 'admin') {
            header("Location: ../admin/index.php");
        } elseif ($role == 'buyer') {
            header("Location: ../");
        }
    } else {
        $_SESSION['login_error'] = "Login failed. Invalid username or password.";
        header("Location: login.php");
    }

    $stmt->close();
}

$conn->close();
?>