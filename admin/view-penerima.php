<!DOCTYPE html>
<html>

<head>
    <title>Tampilkan Informasi Penerima</title>
</head>

<body>

<table border="1">
    <tr>
        <th>ID Penerima</th>
        <th>Nama</th>
        <th>Nomor Telepon</th>
        <th>Alamat</th>
        <th>ID Pengguna</th>
    </tr>

    <?php
    // Koneksi ke database
    include '../koneksi.php';

    // Mendapatkan nilai id_penerima dari parameter URL
    $id_penerima = $_GET['id_penerima'];

    // Melakukan sanitasi input untuk mencegah SQL Injection
    $id_penerima = mysqli_real_escape_string($conn, $id_penerima);

    // Query untuk mendapatkan data penerima berdasarkan id_penerima
    $sql = "SELECT * FROM data_penerima WHERE id_penerima = '$id_penerima'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Menampilkan data dari setiap baris
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_penerima"] . "</td>";
            echo "<td>" . $row["nama"] . "</td>";
            echo "<td>" . $row["no_tlp"] . "</td>";
            echo "<td>" . $row["alamat"] . "</td>";
            echo "<td>" . $row["id_user"] . "</td>";
            
            echo "</tr>";
            echo "<a href='pesanan.php'>Keluar</a>";

        }
    } else {
        echo "<tr><td colspan='6'>Tidak ada data penerima.</td></tr>";
    }

    // Menutup koneksi ke database
    $conn->close();
    ?>
</table>


</body>

</html>