<?php
include '../koneksi.php';

// Pastikan nilai 'id_transaksi' dari parameter URL adalah angka, untuk menghindari serangan SQL Injection
if (isset($_GET['id_transaksi']) && is_numeric($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];

    // Gunakan prepared statement untuk mencegah serangan SQL Injection
    // Hapus terlebih dahulu entri di tabel cart_kwitansi berdasarkan id_user
    $stmt_cart = $conn->prepare("DELETE FROM cart_kwitansi WHERE id_user IN (SELECT id_user FROM transaksi WHERE id_transaksi = ?)");
    $stmt_cart->bind_param("i", $id_transaksi);
    $stmt_cart->execute();

    // Hapus entri dari tabel transaksi berdasarkan id_transaksi
    $stmt_delete_transaksi = $conn->prepare("DELETE FROM transaksi WHERE id_transaksi = ?");
    $stmt_delete_transaksi->bind_param("i", $id_transaksi);
    $stmt_delete_transaksi->execute();

    // Cek apakah data telah dihapus dari tabel transaksi
    if ($stmt_delete_transaksi->affected_rows > 0) {
        // Redirect kembali ke halaman 'data list siswa'
        header("location: ../pesanan-user.php");
        exit();
    } else {
        echo "Gagal menghapus data transaksi.";
    }

    // Tutup prepared statement
    $stmt_cart->close();
    $stmt_delete_transaksi->close();
} else {
    echo "ID transaksi tidak valid.";
}
?>
