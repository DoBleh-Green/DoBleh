<?php
// Pastikan Anda memiliki koneksi ke database di sini
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang dikirimkan dari form
    $nama_sayuran = $_POST['nama_sayuran'];
    $harga_sayuran = $_POST['harga_sayuran'];
    $satuan = $_POST['satuan'];

    // Proses unggah gambar jika dibutuhkan
    $gambar_sayuran = ''; // variabel untuk menyimpan nama file gambar

    if (!empty($_FILES['gambar_sayuran']['name'])) {
        $nama_file = $_FILES['gambar_sayuran']['name'];
        $ukuran_file = $_FILES['gambar_sayuran']['size'];
        $tipe_file = $_FILES['gambar_sayuran']['type'];
        $tmp_file = $_FILES['gambar_sayuran']['tmp_name'];

        // Direktori penyimpanan gambar (pastikan Anda sudah membuat folder tempat menyimpan gambar)
        $upload_dir = "image/"; // Ganti dengan direktori yang sesuai
        $gambar_sayuran = $upload_dir . $nama_file;

        // Pindahkan file gambar ke direktori yang ditentukan
        move_uploaded_file($tmp_file, $gambar_sayuran);
    }

    // Buat query untuk memasukkan data ke dalam database
    $sql = "INSERT INTO sayuran (nama_sayuran, harga_sayuran, satuan, gambar_sayuran) 
            VALUES ('$nama_sayuran', '$harga_sayuran', '$satuan', '$gambar_sayuran')";

    if ($conn->query($sql) === TRUE) {
        // Jika data berhasil ditambahkan, redirect ke halaman dashboard
        header("Location: ../");
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi database setelah selesai
    $conn->close();
}
?>