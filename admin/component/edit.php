<?php
include '../../koneksi.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST['id_sayuran']) &&
        isset($_POST['nama_sayuran']) &&
        isset($_POST['harga_sayuran']) &&
        isset($_POST['satuan'])
    ) {
        $id_sayuran = $_POST['id_sayuran'];
        $nama_sayuran = $_POST['nama_sayuran'];
        $harga_sayuran = $_POST['harga_sayuran'];
        $satuan = $_POST['satuan'];

        // Proses penyuntingan data kecuali gambar
        // Misalnya, lakukan update query untuk mengubah data di database
        $query = "UPDATE sayuran SET 
                    nama_sayuran = '$nama_sayuran',
                    harga_sayuran = '$harga_sayuran',
                    satuan = '$satuan'
                  WHERE id_sayuran = '$id_sayuran'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            if (!empty($_FILES['gambar_sayuran']['name'])) {
                $file_name = $_FILES['gambar_sayuran']['name'];
                $file_temp = $_FILES['gambar_sayuran']['tmp_name'];
                $file_dest = 'image/' . $file_name;

                // Pindahkan gambar yang diunggah ke lokasi penyimpanan
                move_uploaded_file($file_temp, $file_dest);

                // Lakukan proses penyimpanan lokasi gambar ke database untuk sayuran yang bersangkutan
                // Contoh: update query untuk menyimpan lokasi gambar ke database
                $query_image = "UPDATE sayuran SET gambar_sayuran = '$file_dest' WHERE id_sayuran = '$id_sayuran'";
                mysqli_query($conn, $query_image);
            }

            // Redirect ke halaman lain atau tampilkan pesan berhasil tergantung pada hasil dari proses penyuntingan data
            // Misalnya, jika berhasil melakukan penyuntingan data
            // Redirect ke halaman berhasil atau tampilkan pesan berhasil
            header("Location: ../");
            exit();
        } else {
            echo "Gagal melakukan penyuntingan data: " . mysqli_error($conn);
        }
    } else {
        echo "Data yang diterima tidak lengkap.";
    }
} else {
    echo "Akses tidak sah.";
}
?>