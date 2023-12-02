<?php
session_start();
include '../koneksi.php';

if (isset($_POST['add_to_cart'])) {
    // Ambil data dari formulir
    $id_sayuran = $_POST['id_sayuran'];
    $id_user = $_SESSION['id_user']; // Sesuaikan dengan cara Anda mendapatkan id_user dari sesi atau autentikasi
    $qty = 1; // Misalkan default quantity adalah 1, bisa disesuaikan sesuai kebutuhan

    // Periksa apakah item sudah ada di keranjang user
    $query_cek_cart = "SELECT * FROM cart_user WHERE id_sayuran = '$id_sayuran' AND id_user = '$id_user'";
    $result_cek_cart = mysqli_query($conn, $query_cek_cart);

    if (mysqli_num_rows($result_cek_cart) > 0) {
        // Jika item sudah ada di keranjang, tingkatkan jumlah qty
        $row_cart = mysqli_fetch_assoc($result_cek_cart);
        $qty = $row_cart['qty'] + 1;
        $query_update_cart = "UPDATE cart_user SET qty = '$qty' WHERE id_sayuran = '$id_sayuran' AND id_user = '$id_user'";

        if (mysqli_query($conn, $query_update_cart)) {
            $message = "Jumlah item di keranjang berhasil diperbarui.";

            header('Location: ../'); // Arahkan ke halaman tujuan

            echo "<script>
            alert('$message');
            </script>";
            exit(); // Pastikan untuk keluar dari skrip setelah melakukan pengalihan
        } else {
            $error_message = "Gagal memperbarui jumlah item di keranjang: " . mysqli_error($conn);
            echo "<script>
                    alert('$error_message');
                  </script>";
            header('Location: halaman_error.php'); // Arahkan ke halaman error jika terjadi kesalahan
            exit(); // Pastikan untuk keluar dari skrip setelah melakukan pengalihan
        }

    } else {
        // Jika item belum ada di keranjang, tambahkan ke dalam keranjang
        $query_tambah_ke_cart = "INSERT INTO cart_user (id_sayuran, id_user, qty) VALUES ('$id_sayuran', '$id_user', '$qty')";

        if (mysqli_query($conn, $query_tambah_ke_cart)) {
            header('Location: ../index.php?msg= sayuran berhasil di masukan ke keranjang');
        } else {
            echo "Gagal menambahkan item ke keranjang: " . mysqli_error($conn);
        }
    }
}
?>