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
  <link rel="stylesheet" href="../css/pesanan-u.css">
</head>

<body>
  <style>

  </style>
  <header class="header">
    <img src="../image/logo.png">

    <nav class="navbar">
      <a href="../index.php">home</a>
      <a href="about us.php">about us</a>
    </nav>

    <div class="icons">
      <a class="fas fa-shopping-cart" href="cart.php" id="cart-btn"></a>
      <a class="fas fa-right-from-bracket" id="logout-btn" href="../login/logout.php"></a>
      <a class="fas fa-box" id="Box-btn" href="pesanan-user.php"></a>
      <a class="fas fa-bars" id="menu-btn"></a>
    </div>
  </header>

  <h1>Pesanan Anda</h1>


  <div class="container">
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
        echo "Status berhasil diperbarui.";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    // Mendapatkan data transaksi dari database
    $sql = "SELECT t.id_transaksi, t.id_penerima, t.tanggal, t.status, p.nama AS nama_penerima 
    FROM transaksi t 
    LEFT JOIN data_penerima p ON t.id_penerima = p.id_penerima";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table border='1'>
    <tr>
    <th>ID Transaksi</th>
    <th>ID Penerima</th>
    <th>Tanggal</th>
    <th>Status</th>
    <th>Action</th>

    </tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["id_transaksi"] . "</td>
        <td>" . $row["nama_penerima"] . "</td>
        <td>" . $row["tanggal"] . "</td>
        <td>" . $row["status"] . "</td>";

        if ($row["status"] == 'Sudah Sampai') {
          echo "</td>
                <td>
                <a href='selesai-pesanan.php?id_transaksi=" . $row['id_transaksi'] . "'>Selesai <i class='fa-solid fa-check'></i></a>
                                                                      
                </td>";
        } else {
          echo "<td>none</td>";
        }

        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
    $conn->close();
    ?>
  </div>



  <footer class="footer">
    <div class="row">
      <div class="col-md-6">
        <h3>About Us</h3>
        <p>Terimakasih telah berkunjung ke website kami, kami melayani semaksimal mungkin dan memberikan produk produk
          yang terjamin</p>
      </div>
      <div class="col-md-6">
        <h3>Contact</h3>
        <p>Email: info@example.com</p>
        <p>Phone: (123) 456-7890</p>
      </div>
    </div>
  </footer>


  <!-- JAVA -->
  <script src="https://kit.fontawesome.com/d7c9159410.js" crossorigin="anonymous"></script>

  <script src="../script/script.js" href></script>
  <script src="../script/addTocart.js"></script>
</body>

</html>