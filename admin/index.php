<?php
require '../koneksi.php';

$sql = 'SELECT * FROM sayuran';
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="css/index.css">
    <style>
        .icon-size {
            font-size: 40px;
            color: #20c997;
        }
    </style>
</head>

<body class='text-capitalize'>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="users"></span>
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../" target="_blank">
                                <span data-feather="credit-card"></span>
                                Dashboard shop
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Add</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='col-6 col-md-4 col-lg-2' style='margin-right: 5rem;'>";
                            echo "<div class='card bg-light m-3' style='height:25rem; width:15rem;'>";
                            echo "<div class='card-body text-center' >";

                            // Menampilkan gambar (pastikan 'gambar_sayuran' adalah kolom yang sesuai)
                            if (!empty($row['gambar_sayuran'])) {
                                echo "<img class='img-thumbnail h-2' src='../" . $row['gambar_sayuran'] . "' alt='" . $row['nama_sayuran'] . "' />";
                            } else {
                                // Jika gambar kosong, tampilkan placeholder atau pesan lain
                                echo "<img src='noimage.png' height='100' width='100' />";
                            }

                            echo "<h5>" . ($row['nama_sayuran']) . "</h5>";
                            echo "<h6 class='card-title'>" . ($row['harga_sayuran'] . $row['satuan']) . "</h6>";

                            // Link ke halaman edit (sesuaikan dengan alamat yang benar)
                            echo "<a class='fas fa-edit btn btn-primary ' href='component/f-edit?id=" . $row['id_sayuran'] . "'> Edit</a>";
                            echo "<br>";
                            // Link untuk menghapus (sesuaikan dengan alamat yang benar)
                            echo "<a class='fas fa-trash btn btn-danger' href='component/f-delete?id=" . $row['id_sayuran'] . "'> Delete</a>";

                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "No results";
                    }
                    ?>

                </div>
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
</body>

</html>