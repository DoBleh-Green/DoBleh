<?php
session_start();
include '../koneksi.php';

// Periksa apakah pengguna sudah login dan ada informasi id_user dalam sesi
if (isset($_SESSION['id_user'])) {
  $id_user = $_SESSION['id_user'];

  // Query untuk mengambil data keranjang belanja berdasarkan id_user yang sedang login
  $sql = "SELECT id_cart, id_sayuran, id_user, qty FROM cart_user WHERE id_user = $id_user";
  $query = mysqli_query($conn, $sql);
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/cart.css">
  </head>

  <body>


    <?php
    // Periksa apakah ada baris yang dikembalikan oleh query
    if (mysqli_num_rows($query) > 0) {
      // Buat array untuk menampung data keranjang belanja
      $keranjang = array();

      // Mulai iterasi data yang dikembalikan oleh query
      while ($row = mysqli_fetch_assoc($query)) {
        // Ambil informasi mengenai sayuran berdasarkan id_sayuran
        $sql_sayuran = "SELECT id_sayuran, nama_sayuran, harga_sayuran FROM sayuran WHERE id_sayuran = $row[id_sayuran]";
        $query_sayuran = mysqli_query($conn, $sql_sayuran);
        $data_sayuran = mysqli_fetch_assoc($query_sayuran);

        // Masukkan informasi sayuran dan jumlah beli ke dalam array keranjang
        $keranjang[] = array(
          'id_cart' => $row['id_cart'],
          'id_sayuran' => $row['id_sayuran'],
          'id_user' => $row['id_user'],
          'qty' => $row['qty'],
          'nama_sayuran' => $data_sayuran['nama_sayuran'],
          'harga_sayuran' => $data_sayuran['harga_sayuran']
        );
      }

      // Tampilkan data keranjang belanja
      foreach ($keranjang as $item) {
        echo "<div class='cart-card'>";
        echo "<div class='cart-item'>";
        echo "<label>Nama Sayuran: </label>" . $item['nama_sayuran'] . "<br>";
        echo "<label>Jumlah Beli: </label>" . $item['qty'] . "<br>";
        echo "<label>Harga: </label>" . $item['harga_sayuran'] . "<br>";

        echo "<div class='btn-qty' style='display:flex;'>";
        // Form untuk mengurangi quantity dengan ikon Font Awesome
        echo "<form method='post' action='update_cart.php' class='quantity-form'>";
        echo "<input type='hidden' name='action' value='subtract'>";
        echo "<input type='hidden' name='id_cart' value='" . $item['id_cart'] . "'>";
        echo "<button type='submit' class='kurang'>";
        echo "<i class='fas fa-minus-circle'></i> Kurangi";
        echo "</button>";
        echo "</form>";


        // Form untuk menambah quantity dengan ikon Font Awesome
        echo "<form method='post' action='update_cart.php' class='quantity-form'>";
        echo "<input type='hidden' name='id_cart' value='" . $item['id_cart'] . "'>";
        echo "<input type='hidden' name='action' value='add'>";
        echo "<button type='submit' class='tambah'>";
        echo "<i class='fas fa-plus-circle'></i> Tambah";
        echo "</button>";

        echo "</form>";
        echo "</div>";
        echo "</div>"; // .cart-item
        echo "</div>"; // .cart-card
      }


    } else {
      echo "Keranjang belanja Anda masih kosong.";
    }
} else {
  echo "Anda belum login, silakan <a href='login.php'>login</a> terlebih dahulu.";
}
?>
</body>

</html>