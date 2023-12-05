<!DOCTYPE html>
<html>

<head>
    <title>Tampilkan Informasi Pesanan</title>
</head>

<body>
    <a href='pesanan.php'>Keluar</a>

    <table border="1">
        <tr>
            <th>ID Cart</th>
            <th>Id Sayuran</th>
            <th>Id User</th>
            <th>jumlah</th>
            <th>Action</th>
        </tr>

        <?php
        // Koneksi ke database
        include '../koneksi.php';

        // Mendapatkan nilai id_user dari parameter URL
        $id_user = $_GET['id_user'];

        // Melakukan sanitasi input untuk mencegah SQL Injection
        $id_user = mysqli_real_escape_string($conn, $id_user);

        // Query untuk mendapatkan data penerima berdasarkan id_penerima
        $sql = "SELECT * FROM cart_kwitansi WHERE id_user = '$id_user'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            // Menampilkan data dari setiap baris
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_cart"] . "</td>";
                echo "<td>" . $row["id_sayuran"] . "</td>";
                echo "<td>" . $row["id_user"] . "</td>";
                echo "<td>" . $row["qty"] . "</td>";
                echo "<td><a href='javascript:void(0);' onclick='confirmDelete(" . $row['id_cart'] . ")'> Selesai</a></td>";

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