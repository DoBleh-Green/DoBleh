<?
session_start();
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['id_user'])) {
        $id_user = $_SESSION['id_user'];
        $nama = $_POST['nama'];
        $no_tlp = $_POST['no_tlp'];
        $alamat = $_POST['alamat'];

        // Insert data pemesanan ke tabel data_pelanggan
        $insert_pelanggan = "INSERT INTO data_pelanggan (nama, no_tlp, alamat, id_user) VALUES ('$nama', '$no_tlp', '$alamat', $id_user)";
        mysqli_query($conn, $insert_pelanggan);

        // Ambil ID pelanggan yang baru saja dimasukkan
        $id_pelanggan = mysqli_insert_id($conn);

        // Update status transaksi di tabel transaksi
        $update_transaksi = "UPDATE transaksi SET status = 'Sedang Dikemas' WHERE id_pelanggan = $id_pelanggan";
        mysqli_query($conn, $update_transaksi);

        // Kosongkan keranjang belanja pengguna setelah checkout
        $hapus_keranjang = "DELETE FROM cart_user WHERE id_user = $id_user";
        mysqli_query($conn, $hapus_keranjang);

        // Redirect atau tampilkan pesan sukses, dll.
    } else {
        echo "Anda belum login, silakan <a href='login.php'>login</a> terlebih dahulu.";
    }
}
?>