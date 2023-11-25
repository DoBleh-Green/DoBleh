<?php
session_start(); // Mulai sesi PHP
require '../koneksi.php';

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array(); // Inisialisasi keranjang belanja jika belum ada
}

// Fungsi untuk menambahkan item ke keranjang belanja
function addToCart($id_sayuran, $nama_sayuran, $harga_sayuran)
{
  $item = array(
    'id_sayuran' => $id_sayuran,
    'nama_sayuran' => $nama_sayuran,
    'harga_sayuran' => $harga_sayuran,
    'satuan' => 1
  );

  // Periksa apakah produk sudah ada di keranjang
  foreach ($_SESSION['cart'] as &$cartItem) {
    if ($cartItem['id_sayuran'] === $id_sayuran) {
      $cartItem['satuan']++;
      return;
    }
  }

  // Jika produk belum ada di keranjang, tambahkan ke keranjang
  $_SESSION['cart'][] = $item;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Cart - FreshVegs</title>
  <!-- Tambahkan stylesheet atau style yang diperlukan -->
</head>

<body>
  <header class="header">
    <!-- Tambahkan header sesuai dengan desain Anda -->
  </header>

  <div class="cart-page">
    <table>
      <thead>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="cart-items">
        <?php
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
          $subtotal = $item['harga_sayuran'] * $item['satuan'];
          $total += $subtotal;
          ?>
          <tr>
            <td>
              <?php echo $item['nama_sayuran']; ?>
            </td>
            <td>
              <?php echo $item['satuan']; ?>
            </td>
            <td>
              <?php echo 'Rp ' . number_format($item['harga_sayuran'], 0, ',', '.'); ?>
            </td>
            <td>
              <?php echo 'Rp ' . number_format($subtotal, 0, ',', '.'); ?>
            </td>
            <td>
              <!-- Tombol untuk menghapus item dari keranjang -->
              <form method="post">
                <input type="hidden" name="remove_item" value="<?php echo $item['id_sayuran']; ?>">
                <button type="submit">Remove</button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <div class="total">
      <h4>Total: <span>
          <?php echo 'Rp ' . number_format($total, 0, ',', '.'); ?>
        </span></h4>
      <a href="CheckOut.php" class="btn">Checkout</a>
    </div>
  </div>

  <footer class="footer">
    <!-- Tambahkan bagian footer jika diperlukan -->
  </footer>

  <!-- Javascript -->
  <!-- Tambahkan script yang diperlukan -->

  <?php
  // Hapus item dari keranjang jika tombol "Remove" diklik
  if (isset($_POST['remove_item'])) {
    $remove_id = $_POST['remove_item'];
    foreach ($_SESSION['cart'] as $key => $item) {
      if ($item['id_sayuran'] === $remove_id) {
        unset($_SESSION['cart'][$key]);
        break;
      }
    }
    // Perbarui halaman setelah menghapus item
    echo "<meta http-equiv='refresh' content='0'>";
  }
  ?>
</body>

</html>