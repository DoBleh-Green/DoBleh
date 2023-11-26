// addTocart.js

document.addEventListener("DOMContentLoaded", function () {
  const addToCartButtons = document.querySelectorAll(".add-to-cart-btn");

  addToCartButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const productId = this.getAttribute("data-id");

      // Kirim request AJAX untuk menambahkan produk ke keranjang (Anda membutuhkan PHP backend untuk menangani ini)
      // Contoh request menggunakan Fetch API
      fetch("add_to_cart.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "id_sayuran=" + productId,
      })
        .then((response) => {
          if (response.ok) {
            // Tampilkan notifikasi jika produk berhasil ditambahkan
            document.getElementById("notification").style.display = "block";
            setTimeout(function () {
              document.getElementById("notification").style.display = "none";
            }, 3000); // Atur notifikasi hilang setelah 3 detik
          } else {
            console.log("Gagal menambahkan produk ke keranjang.");
          }
        })
        .catch((error) => console.error("Error:", error));
    });
  });
});
