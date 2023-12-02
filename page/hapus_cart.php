<?php
session_start();
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];

    if ($_POST['action'] === 'delete' && isset($_POST['id_cart'])) {
        $id_cart = $_POST['id_cart'];

        // Hapus item dari keranjang belanja
        $sql_delete_item = "DELETE FROM cart_user WHERE id_cart = $id_cart";
        $query_delete_item = mysqli_query($conn, $sql_delete_item);

        if ($query_delete_item) {
            // Redirect kembali ke halaman keranjang belanja
            header("Location: cart.php");
            exit();
        } else {
            echo "Gagal menghapus item dari keranjang belanja.";
        }
    } else {
        echo "Permintaan tidak valid untuk menghapus item.";
    }
} else {
    echo "Akses tidak diizinkan.";
}
?>