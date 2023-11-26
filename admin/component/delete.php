<?php
include '../../koneksi.php';

// Pastikan nilai 'id' dari parameter URL adalah angka, untuk menghindari serangan SQL Injection
if (isset($_GET['id_sayuran']) && is_numeric($_GET['id_sayuran'])) {
    $id_sayuran = $_GET['id_sayuran'];

    // Gunakan prepared statement untuk mencegah serangan SQL Injection
    $stmt = $conn->prepare("DELETE FROM sayuran WHERE id_sayuran = ?");
    $stmt->bind_param("i", $id_sayuran);
    $stmt->execute();

    // Cek apakah data telah dihapus
    if ($stmt->affected_rows > 0) {
        // Redirect kembali ke halaman 'data list siswa'
        header("location: ../");
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