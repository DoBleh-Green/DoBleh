<?php
session_start();
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];

    if ($_POST['action'] === 'subtract' && isset($_POST['id_cart'])) {
        $id_cart = $_POST['id_cart'];

        // Periksa jumlah beli sebelum dikurangi
        $sql_check_qty = "SELECT qty FROM cart_user WHERE id_cart = $id_cart";
        $query_check_qty = mysqli_query($conn, $sql_check_qty);

        if ($query_check_qty) {
            $row = mysqli_fetch_assoc($query_check_qty);
            $current_qty = $row['qty'];

            // Periksa jika qty lebih dari 1, baru kurangi
            if ($current_qty > 1) {
                $new_qty = $current_qty - 1;

                // Update jumlah beli pada keranjang belanja
                $sql_update_qty = "UPDATE cart_user SET qty = $new_qty WHERE id_cart = $id_cart";
                $query_update_qty = mysqli_query($conn, $sql_update_qty);

                if ($query_update_qty) {
                    // Redirect kembali ke halaman keranjang belanja
                    header("Location: cart.php");
                    exit();
                } else {
                    echo "Gagal memperbarui jumlah beli.";
                }
            } else {
                echo "Jumlah beli tidak dapat dikurangi lagi.";
            }
        } else {
            echo "Terjadi kesalahan saat memperoleh data jumlah beli.";
        }
    } else {
        echo "Permintaan tidak valid untuk mengurangi jumlah beli.";
    }
} else {
    echo "Akses tidak diizinkan.";
}
?>