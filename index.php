<?php
session_start();
include 'koneksi.php';
if ($_SESSION['status'] != "login") {
  header('location:login/login.php?pesan=belum_login');
  exit();
}
$sql = 'SELECT * FROM sayuran';
$result1 = $conn->query($sql);

// Ambil id_user dari sesi
$id_user = $_SESSION['id_user'];

// Cek apakah id_user ada di tabel cart_kwitansi
$sql_check_order = "SELECT * FROM cart_kwitansi WHERE id_user = $id_user";
$result_check_order = $conn->query($sql_check_order);
$is_ordering = ($result_check_order->num_rows > 0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <title>FreshVegs</title>
  <link rel="icon" type="image/jpg" href="image/favicon.ico" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
  <header class="header">
    <img src="image/logo.png" />

    <nav class="navbar">
      <a href="index.php">home</a>
      <a href="page/about us.php">about us</a>
    </nav>

    <div class="icons">
      <a class="fas fa-shopping-cart" href="page/cart.php" id="cart-btn"></a>
      <a class="fas fa-right-from-bracket" id="logout-btn" href="login/logout.php"></a>
      <a class="fas fa-box" id="Box-btn" href="page/pesanan-user.php"></a>
      <a class="fas fa-bars" id="menu-btn"></a>
    </div>
  </header>

  <section class="home" id="home">
    <div class="content">
      <h3>Sayuran Terbaik</h3>
      <p>
        Selamat datang di website FreshVegs Di sini, kami hadirkan beragam
        sayuran berkualitas, lengkap dengan layanan yang ramah. Dengan produk
        segar dan tim yang siap membantu, mari berbelanja di FreshVegs untuk
        pengalaman berbelanja sayur yang berbeda!
      </p>
      <a href="#prdct" class="btn">Ayo Beli!</a>
    </div>
  </section>

  <section class="features" id="features">
    <h1 class="heading" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">
      <span>our features</span>
    </h1>
    <div class="box-container">
      <div class="box">
        <img src="image/fitur1-preview (1).png" alt="" />
        <h3>Segar dan Sehat</h3>
        <p>
          Setiap sayuran yang kami tawarkan ditanam dan dipetik dengan teliti,
          memastikan kesegaran dan nilai gizi tertinggi. Setiap gigitan adalah
          pesta rasa dan kesehatan, membantu Anda menjaga kebugaran dan energi
          sepanjang hari.
        </p>
      </div>

      <div class="box">
        <img src="image/fitur3-preview(3).png" alt="" />
        <h3>Pengantaran Aman</h3>
        <p>
          Kami mengutamakan keamanan dalam setiap langkah pengantaran. Pesanan
          Anda dikemas secara hati-hati untuk memastikan tiba dalam keadaan
          sempurna. Dengan layanan pengiriman andal.
        </p>
      </div>

      <div class="box">
        <img src="image/fitur2-preview(2).jpg" alt="" />
        <h3>Pembayaran Ditempat</h3>
        <p>
          Tidak perlu bayar di muka! Dapatkan pesanan terlebih dahulu, cek barangnya, baru bayar saat sampai di tangan
          Anda. Pengalaman berbelanja yang lebih nyaman dan praktis!
        </p>
      </div>
    </div>
  </section>

  <div id="notification" style="display: none">
    Produk ditambahkan ke keranjang.
  </div>

  <h1 class="heading" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">
    <span id="prdct">The Product</span>
  </h1>
  <div class="container">
    <?php
    // Periksa apakah query berhasil dieksekusi
    if ($result1->num_rows > 0) {
      // Tampilkan data produk
      while ($row = $result1->fetch_assoc()) {
        echo "<div class='product'>";
        echo "<img src='" . $row['gambar_sayuran'] . "' alt='" . $row['nama_sayuran'] . "' />";
        echo "<div class='product-info'>";
        echo "<h2 class='product-title'>" . $row['nama_sayuran'] . "</h2>";
        echo "<p class='product-price'>" . $row['harga_sayuran'] . $row['satuan'] . "</p>";
        echo "<form class='add_to_cart' method='post' action='page/add_to_cart.php'>";
        echo "<input type='hidden' name='id_sayuran' value='" . $row['id_sayuran'] . "'>";
        if ($is_ordering) {
          // Jika id_user ada di tabel cart_kwitansi
          echo "<input type='text' value='Anda sedang melakukan pemesanan.' readonly>";
          // Lakukan tindakan tambahan sesuai kebutuhan
      } else {
          echo "<input type='submit' name='add_to_cart' value='Add to Cart'>";
      }
        echo "</form>";
        echo "</div>";
        echo "</div>";
      }
    } else {
      echo "Tidak ada produk yang tersedia.";
    } ?>
  </div>

  <footer class="footer">
    <div class="row">
      <div class="col-md-6">
        <h3>Contact</h3>
        <p>Email: VegsF@gmail.com</p>
        <p>Phone: (012)312-334-43</p>
      </div>
    </div>
  </footer>

  <!-- JAVA -->
  <script>
    // Ambil semua tombol "Add to Cart"
    var addToCartButtons = document.querySelectorAll('.add_to_cart input[type="submit"]');

    // Tambahkan event listener untuk setiap tombol
    addToCartButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        // Tampilkan alert
        alert("Anda telah menambahkan sayuran ke dalam keranjang!");
      });
    });
  </script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <script src="script/addTocart.js"></script>
</body>

</html>