<?php
session_start();
include '../koneksi.php';

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];

    // Pindahkan data dari cart_user ke cart_kwitansi
    $sqlMoveData = "INSERT INTO cart_kwitansi (id_sayuran, id_user, qty) 
                    SELECT id_sayuran, id_user, qty FROM cart_user WHERE id_user = $id_user";
    $resultMoveData = mysqli_query($conn, $sqlMoveData);

    if ($resultMoveData) {
        // Jika berhasil memindahkan data, hapus data dari cart_user
        $sqlDeleteData = "DELETE FROM cart_user WHERE id_user = $id_user";
        $resultDeleteData = mysqli_query($conn, $sqlDeleteData);

        if ($resultDeleteData) {
            // Ambil id_penerima dari tabel data_penerima
            $sqlGetReceiverId = "SELECT id_penerima FROM data_penerima WHERE id_user = $id_user";
            $resultReceiverId = mysqli_query($conn, $sqlGetReceiverId);

            if ($resultReceiverId && mysqli_num_rows($resultReceiverId) > 0) {
                $row = mysqli_fetch_assoc($resultReceiverId);
                $id_penerima = $row['id_penerima'];

                // Tambahkan data transaksi
                $status = "Sedang Dikemas"; // Status transaksi
                $tanggal = date("Y-m-d H:i:s"); // Tanggal saat ini

                $sqlAddTransaction = "INSERT INTO transaksi (id_penerima, status, tanggal) 
                                    VALUES ('$id_penerima', '$status', '$tanggal')";
                $resultAddTransaction = mysqli_query($conn, $sqlAddTransaction);

                if ($resultAddTransaction) {
                    header("Location: pesanan-user.php");
                } else {
                    echo "Gagal menambahkan data transaksi: " . mysqli_error($conn);
                }
            } else {
                echo "ID penerima tidak ditemukan untuk pengguna ini.";
            }
        } else {
            echo "Gagal menghapus data dari cart_user: " . mysqli_error($conn);
        }
    } else {
        echo "Gagal memindahkan data ke cart_kwitansi: " . mysqli_error($conn);
    }
} else {
    echo "Anda belum login, silakan <a href='../login/login.php'>login</a> terlebih dahulu.";
}
?>