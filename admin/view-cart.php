<?php
session_start();
include '../koneksi.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan User</title>
    <link rel="stylesheet" href="css/cart.css">
</head>

<body>
    <a href='pesanan.php'> Keluar</a>
    <h1>Pesanan</h1>
    <table border="1">
        <tr>
            <th>ID Cart</th>
            <th>Id Sayuran</th>
            <th>Id User</th>
            <th>jumlah</th>
        </tr>

        <?php
        // Mendapatkan nilai id_user dari parameter URL
        $id_user = $_GET['id_user'];

        // Melakukan sanitasi input untuk mencegah SQL Injection
        $id_user = mysqli_real_escape_string($conn, $id_user);

        // Query untuk mendapatkan data penerima berdasarkan id_penerima dan nama sayuran
        $sql = "SELECT cart_kwitansi.id_cart, sayuran.nama_sayuran, cart_kwitansi.id_user, cart_kwitansi.qty 
        FROM cart_kwitansi 
        INNER JOIN sayuran ON cart_kwitansi.id_sayuran = sayuran.id_sayuran 
        WHERE cart_kwitansi.id_user = '$id_user'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            // Menampilkan data dari setiap baris
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_cart"] . "</td>";
                echo "<td>" . $row["nama_sayuran"] . "</td>";
                echo "<td>" . $row["id_user"] . "</td>";
                echo "<td>" . $row["qty"] . "</td>";

                echo "</tr>";

            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data penerima.</td></tr>";
        }

        // Menutup koneksi ke database
        $conn->close();
        ?>
    </table>
    <script>
        // Fungsi untuk konfirmasi sebelum menghapus
        function confirmDelete(id_cart) {
            if (confirm('Apakah Pesanan ini sudah selesai?')) {
                window.location.href = 'component/selesai-cart.php?id_cart=' + id_cart;
            }
        }
    </script>
</body>

</html>