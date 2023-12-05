<?php
session_start();
include '../koneksi.php'

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="css/index.css">

</head>

<body class='text-capitalize'>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pesanan.php">
                                <span data-feather="users"></span>
                                Users
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>




            <?php
            // Fungsi untuk mendapatkan nilai enum dari database
            function getEnumValues($conn, $table, $column)
            {
                $result = $conn->query("SHOW COLUMNS FROM $table LIKE '$column'");
                $row = $result->fetch_assoc();
                $enum_str = $row['Type'];
                preg_match_all("/'([\w\s]+)'/", $enum_str, $matches);
                return $matches[1];
            }

            // Mendapatkan nilai enum dari database
            $statusEnumValues = getEnumValues($conn, 'transaksi', 'status');

            // Jika terdapat perubahan pada status enum
            if (isset($_POST['update_status'])) {
                $id_transaksi = $_POST['id_transaksi'];
                $new_status = $_POST['new_status'];

                // Mengupdate status enum pada database
                $sql = "UPDATE transaksi SET status='$new_status' WHERE id_transaksi=$id_transaksi";

                if ($conn->query($sql) === TRUE) {
                    $_SESSION['success_message'] = "Status berhasil diperbarui.";
                    header("Location: pesanan.php");
                    exit();
                } else {
                    $_SESSION['error_message'] = "Terjadi kesalahan: " . $conn->error;
                    header("Location: pesanan.php");
                    exit();
                }
            }


            // Mendapatkan data transaksi dari database
            $sql = "SELECT id_transaksi, id_penerima, tanggal,status, id_user
            FROM transaksi";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='container mt-4'>
                <table class='table table-striped table-hover'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>ID Penerima</th>
                            <th>ID Cart</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

                while ($row = $result->fetch_assoc()) {
                    $id_penerima = $row["id_penerima"];
                    $id_user = $row["id_user"];
                    echo "<tr>
                                <td>" . $row["id_transaksi"] . "</td>
                                <td>" . $row["id_penerima"] . " <a href='view-penerima.php?id_penerima=$id_penerima'>view</a></td>
                                <td>" . $row["id_user"] . " <a href='view-cart.php?id_user=$id_user'>view</a></td>
                                <td>" . $row["tanggal"] . "</td>
                                <td>
                                    <!-- Form untuk mengubah status -->
                                    <form method='post' action='' class='d-flex align-items-center'>
                                        <div class='input-group'>
                                            <select name='new_status' class='form-select'>";
                    // Menampilkan dropdown dengan nilai enum dari database
                    foreach ($statusEnumValues as $enumValue) {
                        echo "<option value='$enumValue'";
                        if ($row["status"] === $enumValue) {
                            echo " selected='selected'";
                        }
                        echo ">$enumValue</option>";
                    }
                    echo "</select>
                                        <button type='submit' name='update_status' class='btn btn-primary'>Update</button>
                                    </div>
                                    <td><a style='background:blue; border-radius:5px; color:#fff; padding:7px;' href='javascript:void(0);' onclick='confirmDelete(" . $row['id_transaksi'] . ")'> Selesai</a></td>;
                                    
                                </form>
                            </td>
                        </tr>";
                }

                echo "</tbody></table></div>";
            } else {
                echo "<div class='container mt-4'>0 results</div>";
            }
            $conn->close();
            ?>


        </div>
    </div>
    <!-- JAVA -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            <?php if (isset($_SESSION['success_message'])) { ?>
                alert("<?php echo $_SESSION['success_message']; ?>");
                <?php unset($_SESSION['success_message']); ?>
            <?php } elseif (isset($_SESSION['error_message'])) { ?>
                alert("<?php echo $_SESSION['error_message']; ?>");
                <?php unset($_SESSION['error_message']); ?>
            <?php } ?>
        });
    </script>
    <!-- Setelah kode JavaScript sebelumnya -->
    <script>
        // Logika JavaScript untuk Tombol Generate Kwitansi Admin
        document.addEventListener('DOMContentLoaded', function () {
            const adminBtns = document.querySelectorAll('.admin-btn');
            adminBtns.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    // Kirim ID transaksi ke generate_kwitansi.php menggunakan AJAX
                    const idTransaksi = this.parentNode.querySelector('input[name="id_transaksi"]').value;
                    $.ajax({
                        type: 'POST',
                        url: 'generate_kwitansi.php', // Ganti dengan lokasi file yang sesuai
                        data: {
                            id_transaksi: idTransaksi
                        },
                        success: function (response) {
                            // Handle response jika diperlukan
                            console.log('Kwitansi berhasil di-generate!');
                        },
                        error: function () {
                            // Handle error jika diperlukan
                            console.log('Terjadi kesalahan saat membuat kwitansi.');
                        }
                    });
                });
            });
        });
    </script>
    <script>
        // Fungsi untuk konfirmasi sebelum menghapus
        function confirmDelete(id_transaksi) {
            if (confirm('Apakah Pesanan ini sudah selesai?')) {
                window.location.href = 'component/selesai-pesanan.php?id_transaksi=' + id_transaksi;
            }
        }
    </script>
    <script>
        feather.replace()
    </script>
</body>

</html>