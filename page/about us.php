<?php
session_start();
include '../koneksi.php';
if ($_SESSION['status'] != "login") {
  header('location:login/login.php?pesan=belum_login');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="stylesheet" href="../css/about us.css" />
  <title>FreshVegs</title>
  <link rel="icon" type="/image/jpg" href="../image/favicon.ico" />
</head>

<body>
  <header class="header">
    <img src="../image/logo.png" alt="" />

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
      <a href="product.html" class="btn">Ayo Beli!</a>
    </div>
  </section>
  <h1 class="heading" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">
    <span>about us</span>
  </h1>

  <div class="about-us">
    <div class="box-container">
      <div class="box">
        <section class="container-vm" data-aos="flip-up" data-aos-offset="300">
          <div class="visi-misi">
            <h1>Visi kami</h1>
            <p>
              Menjadi sumber utama yang unggul dan terpercaya melalui
              pemanfaatan sayuran segar dan berkualitas tinggi.
            </p>
            <h2>Misi Kami</h2>

            <ul class="mission-list">
              <li>[Mengutamakan Kepuasan Pelanggan]</li>
              <li>[Memastikan Ketersediaan Sayuran Segar]</li>
              <li>[Memberikan Pelayanan Terbaik]</li>
              <p>sama seperti di fitur kami ada di bawah ini</p>
            </ul>
          </div>
        </section>
        <div class="addtion" data-aos="flip-up" data-aos-offset="300">
          <h1>perlu di ingat</h1>
          <p>
            Selain makan anda juga harus menjaga kesehatan tubuh. Namun, kami
            percaya kesehatan sejati adalah hasil dari harmoni antara pola
            makan yang baik, aktivitas fisik yang teratur, keseimbangan
            emosional, dan pemeliharaan pikiran yang positif. Kami memahami
            bahwa gaya hidup sehat adalah sebuah perjalanan holistik yang
            melibatkan berbagai aspek kehidupan Anda.
          </p>
        </div>
      </div>

      <section class="container-nm">
        <div class="box" data-aos="zoom-in-down">
          <h1>Nilai Kami</h1>
          <br />
          <ul class="values-list">
            <li>
              <strong>Kualitas Unggul:</strong><br />
              Kualitas adalah fondasi dari setiap sayur yang kami tawarkan.
              Kami memilih dengan cermat dan menghadirkan sayuran segar
              terbaik untuk memastikan Anda mendapatkan produk yang tidak
              hanya lezat, tetapi juga bernutrisi tinggi. Keunggulan dalam
              kualitas adalah prinsip utama kami.
            </li>
            <li>
              <strong>Kepercayaan dan Transparansi:</strong><br />
              Kami membangun hubungan yang kuat dengan pelanggan melalui
              kepercayaan dan transparansi. Kami selalu berkomitmen untuk
              memberikan informasi yang jujur mengenai produk kami dan menjaga
              standar yang konsisten. Anda dapat mengandalkan kami sebagai
              mitra yang terpercaya dalam memenuhi kebutuhan sayur segar Anda.
            </li>
            <li>
              <strong>Pelayanan Ramah dan Efisien:</strong><br />
              Pelayanan pelanggan adalah fokus utama kami. Tim kami hadir
              dengan senyum dan kesiapan untuk membantu Anda dengan setiap
              pertanyaan atau permintaan. Kami percaya bahwa pelayanan yang
              ramah dan efisien menciptakan pengalaman berbelanja yang
              menyenangkan dan membuat Anda merasa dihargai sebagai pelanggan
              kami.
            </li>
          </ul>
        </div>
      </section>
    </div>
  </div>

  <section class="features" id="features" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">
    <h1 class="heading"><span>features</span></h1>
    <div class="box-container" data-aos="fade-up" data-aos-delay="500">
      <div class="box">
        <img src="../image/fitur1-preview (1).png" alt="" />
        <h3>Segar dan Sehat</h3>
        <p>
          Setiap sayuran yang kami tawarkan ditanam dan dipetik dengan teliti,
          memastikan kesegaran dan nilai gizi tertinggi. Setiap gigitan adalah
          pesta rasa dan kesehatan, membantu Anda menjaga kebugaran dan energi
          sepanjang hari.
        </p>
      </div>

      <div class="box">
        <img src="../image/fitur3-preview(3).png" alt="" />
        <h3>Pengantaran Aman</h3>
        <p>
          Kami mengutamakan keamanan dalam setiap langkah pengantaran. Pesanan
          Anda dikemas secara hati-hati untuk memastikan tiba dalam keadaan
          sempurna. Dengan layanan pengiriman andal.
        </p>
      </div>

      <div class="box">
        <img src="../image/fitur2-preview(2).jpg" alt="" />
        <h3>Pembayaran Ditempat</h3>
        <p>
          Tidak perlu bayar di muka! Dapatkan pesanan terlebih dahulu, cek barangnya, baru bayar saat sampai di tangan
          Anda. Pengalaman berbelanja yang lebih nyaman dan praktis!
        </p>
      </div>
    </div>
  </section>

  <footer class="footer">
    <div class="row">
      <div class="col-md-6">
        <h3>About Us</h3>
        <p>
          Terimakasih telah berkunjung ke website kami, kami melayani
          semaksimal mungkin dan memberikan produk produk yang terjamin
        </p>
      </div>
      <div class="col-md-6">
        <h3>Contact</h3>
        <p>Email: VegsF@gmail.com</p>
        <p>Phone: (012)312-334-43</p>
      </div>
    </div>
  </footer>

  <!-- JAVA -->

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <script src="/script/script.js"></script>
</body>

</html>