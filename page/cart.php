<?php
session_start();
include '../koneksi.php';

if (isset($_SESSION['id_user'])) {
  $id_user = $_SESSION['id_user'];

  // Ambil data penerima dari tabel data_penerima berdasarkan id_user
  $sql_penerima = "SELECT * FROM data_penerima WHERE id_user = $id_user";
  $query_penerima = mysqli_query($conn, $sql_penerima);

  // Jika data penerima ditemukan untuk id_user tertentu
  if ($query_penerima && mysqli_num_rows($query_penerima) > 0) {
    $penerima_data = mysqli_fetch_assoc($query_penerima);
  }
} else {
  echo "Anda belum login, silakan <a href='../login/login.php'>login</a> terlebih dahulu.";
}

$sql2 = "SELECT * FROM cart_user WHERE id_user = $id_user";
$query2 = mysqli_query($conn, $sql2);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
  <link rel="icon" type="../image/jpg" href="../image/favicon.ico" />
  <link rel="stylesheet" href="../css/cart.css">
</head>

<body>
  <header class="header">
    <img src="../image/logo.png" />

    <nav class="navbar">
      <a href="../index.php">home</a>
      <a href="about us.html">about us</a>
    </nav>

    <div class="icons">
      <a class="fas fa-shopping-cart" href="cart.php" id="cart-btn"></a>
      <a class="fas fa-right-from-bracket" id="logout-btn" href="../login/logout.php"></a>
      <a class="fas fa-bars" id="menu-btn"></a>
    </div>
  </header>


  <?php
  // Periksa apakah ada baris yang dikembalikan oleh query
  if (mysqli_num_rows($query2) > 0) {
    // Buat array untuk menampung data keranjang belanja
    $keranjang = array();

    // Mulai iterasi data yang dikembalikan oleh query
    while ($row = mysqli_fetch_assoc($query2)) {
      // Ambil informasi mengenai sayuran berdasarkan id_sayuran
      $sql_sayuran = "SELECT * FROM sayuran WHERE id_sayuran = $row[id_sayuran]";
      $query_sayuran = mysqli_query($conn, $sql_sayuran);
      $data_sayuran = mysqli_fetch_assoc($query_sayuran);

      // Masukkan informasi sayuran dan jumlah beli ke dalam array keranjang
      $keranjang[] = array(
        'id_cart' => $row['id_cart'],
        'id_sayuran' => $row['id_sayuran'],
        'id_user' => $row['id_user'],
        'qty' => $row['qty'],
        'nama_sayuran' => $data_sayuran['nama_sayuran'],
        'harga_sayuran' => $data_sayuran['harga_sayuran'],
        'gambar_sayuran' => $data_sayuran['gambar_sayuran'],
        'satuan' => $data_sayuran['satuan']
      );
    }

    // Tampilkan data keranjang belanja
    foreach ($keranjang as $item) {
      echo "<div class='cart-card-container'>";
      echo "<div class='cart-card'>";
      echo "<div class='cart-item'>";
      echo "<div class='cart-item-img'>";
      // Menampilkan gambar sayuran
      echo "<img src='../" . $item['gambar_sayuran'] . "' alt='gambar_sayuran' class='gambar_sayuran'>"; // Ganti 'gambar_sayuran' dengan key yang sesuai di dalam array
      echo "</div>";

      echo "<div class='cart-text'>";
      echo "<label>Nama Sayuran: </label>" . $item['nama_sayuran'] . "<br>";
      echo "<label>Jumlah Beli: </label>" . $item['qty'] . "<br>";
      echo "<label>Harga: </label>Rp" . number_format($item['harga_sayuran']) . $item['satuan'] . "<br>";
      echo "</div>";

      echo "<div class='btn-qty'>"; // Memindahkan div btn-qty ke dalam cart-item
      // Form untuk mengurangi quantity
      echo "<form method='post' action='kurangi_cart.php' class='quantity-form'>";
      echo "<input type='hidden' name='action' value='subtract'>";
      echo "<input type='hidden' name='id_cart' value='" . $item['id_cart'] . "'>";
      echo "<button type='submit' class='kurang'>";
      echo "<i class='fas fa-minus-circle'></i>";
      echo "</button>";
      echo "</form>";

      // Form untuk menambah quantity
      echo "<form method='post' action='tambah_cart.php' class='quantity-form'>";
      echo "<input type='hidden' name='id_cart' value='" . $item['id_cart'] . "'>";
      echo "<input type='hidden' name='action' value='add'>";
      echo "<button type='submit' class='tambah'>";
      echo "<i class='fas fa-plus-circle'></i>";
      echo "</button>";
      echo "</form>";

      //  Form untuk Menghapus pesanan
      echo "<form method='post' action='hapus_cart.php' class='quantity-form'>";
      echo "<input type='hidden' name='id_cart' value=" . $item['id_cart'] . ">";
      echo "<input type='hidden' name='action' value='delete'>"; // Mengubah nilai dari 'add' menjadi 'delete' sesuai tujuan aksi
      echo "<button type='submit' class='hapus'>";
      echo "<i class='fas fa-trash'></i>"; // Mengganti ikon menjadi yang sesuai dengan aksi 'hapus'
      echo "</button>";
      echo "</form>";
      echo "</div>"; // .btn-qty
  
      echo "</div>"; // .cart-item
      echo "</div>"; // .cart-card
      echo "</div>"; // .cart-card-container
    }


    // Hitung total harga
    $total_harga = 0;
    foreach ($keranjang as $item) {
      $total_harga += $item['qty'] * $item['harga_sayuran'];
    }

    // Tampilkan total harga dan tombol check out
    echo "<div class='total-checkout-container'>";
    echo "<div class='total-harga'>Total Harga: Rp" . number_format($total_harga) . "</div>"; // Menampilkan total harga dengan format angka
    echo "<a class='btn-penerima' onclick='showPopup()'>Data penerima</a>";
    echo "<a class='btn-checkout' onclick='showPopup()' href='checkOut.php'>Check Out</a>";
    echo "</div>";

  } else {
    echo "<div ><h1 class='no-item'>Keranjang belanja Anda masih kosong.</h1></div>";
  }
  ?>

  <div id="penerima-popup" class="popup-container">
    <div class="popup-content">
      <h1>Data Penerima</h1>
      <span class="close-btn" onclick="closePopup()">&times;</span>
      <form id="formPenerima" action="edit.php" method="POST" onsubmit="submitForm(); return true;">
        <?php
        if (isset($_SESSION['id_user'])) {
          echo '<input type="text" id="id_user" name="id_user" readonly value="' . $id_user . '">';
          if (isset($penerima_data)) {
            echo '<label for="nama">Nama:</label><br>';
            echo '<input type="text" id="nama" name="nama" value="' . $penerima_data['nama'] . '"><br>';
            echo '<label for="no_tlp">Nomor Telepon:</label><br>';
            echo '<input type="tel" id="no_tlp" name="no_tlp" value="' . $penerima_data['no_tlp'] . '"><br>';
            echo '<label for="alamat">Alamat:</label><br>';
            echo '<textarea id="alamat" name="alamat">' . $penerima_data['alamat'] . '</textarea><br><br>';
          } else {
            echo '<label for="nama">Nama:</label><br>';
            echo '<input type="text" id="nama" name="nama"><br>';
            echo '<label for="no_tlp">Nomor Telepon:</label><br>';
            echo '<input type="tel" id="no_tlp" name="no_tlp"><br>';
            echo '<label for="alamat">Alamat:</label><br>';
            echo '<textarea id="alamat" name="alamat"></textarea><br><br>';
          }
        }
        ?>
        <input type="submit" value="Kirim">
      </form>
    </div>
  </div>

</body>
<script src="https://kit.fontawesome.com/d7c9159410.js" crossorigin="anonymous"></script>
<script>

  function showPopup() {
    // Periksa apakah bidang data penerima sudah diisi
    var nama = document.getElementById('nama').value;
    var no_tlp = document.getElementById('no_tlp').value;
    var alamat = document.getElementById('alamat').value;

    if (nama === '' || no_tlp === '' || alamat === '') {
      alert('Mohon lengkapi terlebih dahulu data penerima.');
    } else {
      document.getElementById('penerima-popup').style.display = 'block';
    }
  }

  // Fungsi untuk menampilkan pop-up
  function showPopup() {
    document.getElementById('penerima-popup').style.display = 'block';
  }

  // Fungsi untuk menutup pop-up
  function closePopup() {
    document.getElementById('penerima-popup').style.display = 'none';
  }
</script>


</html>