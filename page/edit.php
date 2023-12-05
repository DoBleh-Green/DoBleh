<?php
// checkOut.php

// Mulai sesi
session_start();

include '../koneksi.php';

// Memeriksa data yang dikirim dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari form
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $no_tlp = $_POST['no_tlp'];
    $alamat = $_POST['alamat'];

    // Periksa apakah data pengguna sudah ada di database
    $check_stmt = $conn->prepare("SELECT * FROM data_penerima WHERE id_user = ?");
    $check_stmt->bind_param("i", $id_user);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika data pengguna sudah ada, lakukan UPDATE
        $update_stmt = $conn->prepare("UPDATE data_penerima SET nama = ?, no_tlp = ?, alamat = ? WHERE id_user = ?");
        $update_stmt->bind_param("sssi", $nama, $no_tlp, $alamat, $id_user);

        if ($update_stmt->execute()) {
            header('Location:cart.php');
        } else {
            echo "Error saat memperbarui data: " . $update_stmt->error;
        }
        $update_stmt->close();
    } else {
        // Jika data pengguna belum ada, lakukan INSERT
        $insert_stmt = $conn->prepare("INSERT INTO data_penerima (id_user, nama, no_tlp, alamat) VALUES (?, ?, ?, ?)");
        $insert_stmt->bind_param("isss", $id_user, $nama, $no_tlp, $alamat);

        if ($insert_stmt->execute()) {
            header('Location:cart.php');
        } else {
            echo "Error saat menyimpan data: " . $insert_stmt->error;
        }
        $insert_stmt->close();
    }

    // Simpan data ke dalam sesi
    $_SESSION['penerima_data'] = [
        'id_user' => $id_user,
        'nama' => $nama,
        'no_tlp' => $no_tlp,
        'alamat' => $alamat
    ];

    $check_stmt->close();
}

// Menutup koneksi database
$conn->close();
?>