<?php
require '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 'buyer'; // Menggunakan string 'buyer' untuk peran pengguna

    $query = "INSERT INTO data_user (username, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        // Registrasi berhasil
        header("Location: login.php"); // Redirect ke halaman login setelah registrasi sukses
        exit();
    } else {
        // Registrasi gagal
        echo "Registrasi gagal. Silakan coba lagi.";
        // Tambahkan tindakan lain yang sesuai jika registrasi gagal, seperti menampilkan pesan error atau menampilkan form registrasi lagi.
    }

    $stmt->close();
}

$conn->close();
?>