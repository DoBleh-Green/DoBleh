<?php
session_start();
include '../koneksi.php';

if ($_SESSION['status'] != "login") {
    header('location:../login/login.php?pesan=belum_login');
    exit();
} elseif ($_SESSION['role'] !== "admin") {
    echo "Anda bukan admin. Anda tidak memiliki akses ke halaman ini.";
    exit();
}
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
                            <a class="nav-link" href="pesanan.php">
                                <span data-feather="users"></span>
                                Users
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
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal"
                                data-target="#addModal" onclick="toggleAddForm()">Add</button>
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
                            echo "<button class='fas fa-edit btn btn-primary' data-toggle='modal' data-target='#editModal' data-id='" . $row['id_sayuran'] . "' data-nama='" . $row['nama_sayuran'] . "' data-harga='" . $row['harga_sayuran'] . "' data-satuan='" . $row['satuan'] . "'> Edit</button>";
                            echo "<br>";
                            // Link untuk menghapus (sesuaikan dengan alamat yang benar)
                            echo "<a href='javascript:void(0);' onclick='confirmDelete(" . $row['id_sayuran'] . ")' class='fas fa-trash btn btn-danger'> Delete</a>";

                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "No results";
                    }
                    ?>

                    <!-- form add -->
                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Tambah Sayuran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="component/add.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nama_sayuran">Nama Sayuran</label>
                                                <input type="text" class="form-control" id="nama_sayuran"
                                                    name="nama_sayuran" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="harga_sayuran">Harga Sayuran</label>
                                                <input type="text" class="form-control" id="harga_sayuran"
                                                    name="harga_sayuran" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="satuan">Satuan</label>
                                                <input type="text" class="form-control" id="satuan" name="satuan"
                                                    required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="gambar_sayuran">Gambar Sayuran</label>
                                                <input type="file" class="form-control-file" id="gambar_sayuran"
                                                    name="gambar_sayuran">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form untuk Edit -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Sayuran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="component/edit.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" id="edit_id" name="id_sayuran">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nama_sayuran">Nama Sayuran</label>
                                                <input type="text" class="form-control" id="edit_nama_sayuran"
                                                    name="nama_sayuran" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="harga_sayuran">Harga Sayuran</label>
                                                <input type="text" class="form-control" id="edit_harga_sayuran"
                                                    name="harga_sayuran" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="satuan">Satuan</label>
                                                <input type="text" class="form-control" id="edit_satuan" name="satuan"
                                                    required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="gambar_sayuran">Gambar Sayuran</label>
                                                <input type="file" class="form-control-file" id="edit_gambar_sayuran"
                                                    name="gambar_sayuran">
                                                <img id="edit_gambar_preview" src="" alt="gambar_sayuran" height="100"
                                                    width="100">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
    <script>

        // Fungsi untuk konfirmasi sebelum menghapus
        function confirmDelete(id_sayuran) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                window.location.href = 'component/delete.php?id_sayuran=' + id_sayuran;
            }
        }

        // untuk pop up form add    
        function toggleAddForm() {
            const addForm = document.getElementById('addForm');
            if (addForm.style.display === 'none') {
                addForm.style.display = 'block';
            } else {
                addForm.style.display = 'none';
            }
        }

        // Fungsi untuk menampilkan preview gambar yang dipilih oleh pengguna
        $("#edit_gambar_sayuran").change(function () {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#edit_gambar_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


        // untuk get data form edit
        $(document).on("click", ".fa-edit", function () {
            var id = $(this).data('id'); // Menggunakan 'data-id' sebagai referensi ID sayuran
            var nama = $(this).data('nama');
            var harga = $(this).data('harga');
            var satuan = $(this).data('satuan');
            var gambar = $(this).data('gambar');

            $("#edit_id").val(id);
            $("#edit_nama_sayuran").val(nama);
            $("#edit_harga_sayuran").val(harga);
            $("#edit_satuan").val(satuan);
            // Pastikan memperbarui atribut 'src' untuk menampilkan gambar sayuran yang ingin diedit
            $("#edit_gambar_sayuran").attr("src", "../" + gambar); // Update 'src' dari tag gambar

            $("#editModal").modal('show');
        });

    </script>

</body>

</html>