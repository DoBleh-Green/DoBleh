<?php
include '../koneksi.php';
session_start(); // Mulai sesi

// Periksa apakah ID pengguna tersedia dalam sesi
if (isset($_SESSION['id_user'])) {
    // Ambil ID pengguna dari sesi
    $id_user = $_SESSION['id_user'];

    // Query untuk mengambil data penerima dari tabel data_penerima berdasarkan id_user tertentu
    $sql_penerima = "SELECT * FROM data_penerima WHERE id_user = $id_user";
    $result_penerima = $conn->query($sql_penerima);

    // Query untuk mengambil pesanan dari tabel cart_kwitansi berdasarkan id_user tertentu
    $sql_pesanan = "SELECT c.id_sayuran, c.qty, s.nama_sayuran, s.harga_sayuran, s.satuan FROM cart_kwitansi c INNER JOIN sayuran s ON c.id_sayuran = s.id_sayuran WHERE c.id_user = $id_user";
    $result_pesanan = $conn->query($sql_pesanan);

    if ($result_penerima->num_rows > 0 && $result_pesanan->num_rows > 0) {
        // Ambil data penerima dari hasil query
        $data_penerima = $result_penerima->fetch_assoc();

        // Tampilkan struktur HTML dan judul kwitansi
        ?>


        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Data Penerima</title>
            <link rel="stylesheet" href="../test/style.css" />
        </head>

        <body>
            <div class="kwitansi">
                <h1>Kwitansi Pembelian</h1>
                <p>
                    Nama :
                    <?php echo $data_penerima['nama']; ?>
                </p>
                <p>
                    Nomor Telpon :
                    <?php echo $data_penerima['no_tlp']; ?>
                </p>
                <p>
                    Alamat :
                    <?php echo $data_penerima['alamat']; ?>
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sayuran</th>
                            <th>Jumlah</th>
                            <th>Harga / pc</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Tampilkan data pesanan ke dalam tabel
                        $total_pembelian = 0;
                        $nomor = 1;

                        while ($row = $result_pesanan->fetch_assoc()) {
                            $subtotal = $row['qty'] * $row['harga_sayuran'];
                            $total_pembelian += $subtotal;

                            // Tampilkan setiap baris pembelian
                            echo "<tr>
                        <td>" . $nomor . "</td>
                        <td>" . $row['nama_sayuran'] . "</td>
                        <td>" . $row['qty'] . "</td>
                        <td>Rp " . number_format($row['harga_sayuran'], 0, ',', '.') . "</td>
                        <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
                    </tr>";

                            $nomor++;
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">Jumlah</td>
                            <td>Rp
                                <?php echo number_format($total_pembelian, 0, ',', '.'); ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </body>

        </html>
        <?php
    } else {
        // Jika tidak ada data pesanan
        echo "Tidak ada data pesanan.";
    }

    // Tutup koneksi ke database
    $conn->close();
} else {
    // Jika ID pengguna tidak tersedia dalam sesi, lakukan redirect atau tindakan lainnya
    header("Location: login.php"); // Ganti 'login.php' dengan halaman login Anda
    exit();
}
?>