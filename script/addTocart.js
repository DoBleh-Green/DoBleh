// Fungsi untuk menambahkan produk ke keranjang
function addToCart(event) {
  const product = event.target.parentElement.parentElement;
  const productName = product.querySelector(".product-title").innerText;
  const productPrice = parseFloat(
    product.querySelector(".product-price").innerText
  );

  // Kirim request ke server menggunakan AJAX
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "addToCart.php", true); // Ganti 'addToCart.php' dengan lokasi file PHP yang menangani penambahan ke keranjang
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (xhr.status === 200) {
      // Tampilkan notifikasi jika berhasil ditambahkan ke keranjang
      document.getElementById("notification").style.display = "block";
      setTimeout(function () {
        document.getElementById("notification").style.display = "none";
      }, 3000); // Notifikasi akan hilang setelah 3 detik
    } else {
      // Handle jika terjadi kesalahan saat menambahkan ke keranjang
      console.error("Terjadi kesalahan saat menambahkan ke keranjang.");
    }
  };

  // Kirim data produk yang akan ditambahkan ke keranjang
  const data =
    "productName=" +
    encodeURIComponent(productName) +
    "&productPrice=" +
    encodeURIComponent(productPrice);
  xhr.send(data);
}

// Tambahkan event listener ke setiap tombol "Add to Cart"
const addToCartButtons = document.querySelectorAll(".add-to-cart .btn");
addToCartButtons.forEach((button) => {
  button.addEventListener("click", addToCart);
});
