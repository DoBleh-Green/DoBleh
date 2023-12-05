<?php
include '../../koneksi.php';

// Pastikan nilai 'id' dari parameter URL adalah angka, untuk menghindari serangan SQL Injection
if (isset($_GET['id_cart']) && is_numeric($_GET['id_cart'])) {
    $id_cart = $_GET['id_cart'];

    // Gunakan prepared statement untuk mencegah serangan SQL Injection
    $stmt = $conn->prepare("DELETE FROM cart_kwitansi WHERE `cart_kwitansi`.`id_cart` = ?");
    $stmt->bind_param("i", $id_cart);
    $stmt->execute();

    // Cek apakah data telah dihapus
    if ($stmt->affected_rows > 0) {
        // Redirect kembali ke halaman 'data list siswa'
        header("location: ../view-cart.php");
        exit();
    } else {
        echo "Gagal menghapus data sayuran.";
    }

    // Tutup prepared statement
    $stmt->close();
} else {
    echo "ID sayuran tidak valid.";
}
?>