<?php
include '../../koneksi.php';

// Pastikan nilai 'id' dari parameter URL adalah angka, untuk menghindari serangan SQL Injection
if (isset($_GET['id_transaksi']) && is_numeric($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];

    // Gunakan prepared statement untuk mencegah serangan SQL Injection
    $stmt = $conn->prepare("DELETE FROM transaksi WHERE `transaksi`.`id_transaksi` = ?");
    $stmt->bind_param("i", $id_transaksi);
    $stmt->execute();

    // Cek apakah data telah dihapus
    if ($stmt->affected_rows > 0) {
        // Redirect kembali ke halaman 'data list siswa'
        header("location: ../pesanan.php");
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