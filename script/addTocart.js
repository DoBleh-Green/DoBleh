const cartItems = [];  // Menyimpan informasi produk dalam keranjang

function addToCart(productName, productPrice) {
    const cartContainer = document.querySelector('.shopping-cart');
  
    // Buat elemen div untuk menampilkan produk di keranjang belanja
    const productBox = document.createElement('div');
    productBox.classList.add('box');
    productBox.innerHTML = `
      <i class="fas fa-trash" onclick="removeFromCart(this)"></i>
      <img src="/image/${productName.toLowerCase().replace(' ', '-')}.jpg" alt="">
      <div class="content">
          <h3>${productName}</h3>
          <span class="price">${productPrice}</span>
      </div>
    `;
  
    // Tambahkan produk ke dalam keranjang belanja
    cartContainer.appendChild(productBox);
  
    // Tambahkan produk ke dalam struktur data keranjang
    cartItems.push({ name: productName, price: productPrice });
  
    // Hitung ulang total belanja
    updateTotal();
}

function removeFromCart(element) {
    const productBox = element.parentElement;
    const cartContainer = document.querySelector('.shopping-cart');
  
    // Hapus produk dari tampilan keranjang
    cartContainer.removeChild(productBox);
  
    // Dapatkan indeks produk yang akan dihapus dari struktur data keranjang
    const productIndex = cartItems.findIndex(item => item.name === productBox.querySelector('h3').textContent);
  
    if (productIndex !== -1) {
      // Hapus produk dari struktur data keranjang
      cartItems.splice(productIndex, 1);
    }
  
    // Hitung ulang total belanja
    updateTotal();
}

// Fungsi untuk menghitung total belanja
function updateTotal() {
    const prices = document.querySelectorAll('.price');
    let total = 0;
  
    prices.forEach(price => {
      const priceText = price.textContent.replace('Rp ', '');
      total += parseFloat(priceText.replace(',', ''));
    });
  
    const totalElement = document.querySelector('.total');
    totalElement.textContent = `total : Rp ${total.toLocaleString('en-US')}`;
}
