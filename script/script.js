
// index.html

document.addEventListener("DOMContentLoaded", () => {
  let shoppingCart = document.querySelector(".shopping-cart");
  let cartBtn = document.querySelector("#cart-btn");
  let navbar = document.querySelector(".navbar");
  let menuBtn = document.querySelector("#menu-btn");


  cartBtn.addEventListener("click", () => {
    shoppingCart.classList.toggle("active");
    navbar.classList.remove("active");
  });

  loginBtn.addEventListener("click", () => {
    loginForm.classList.toggle("active");
    navbar.classList.remove("active");
  });

  menuBtn.addEventListener("click", () => {
    navbar.classList.toggle("active");
    loginForm.classList.remove("active");
  });

  window.onscroll = () => {
    searchForm.classList.remove("active");
    navbar.classList.remove("active");
  };
});

function myFunction() {
  var element = document.body;
  element.classList.toggle("dark-mode");
}

function toggleButton() {
  var btn = document.querySelector(".btn");
  if (btn.classList.contains("active")) {
    btn.classList.remove("active");
  } else {
    btn.classList.add("active");
  }
}

// Render Product Dynamicly

const products = [
  {
    id: 1,
    nama: "Wortel Lokal",
    harga: 10000,
    stock: 100,
    gambar: "../img/wortel-lokal.jpg",
    productLink: "product.html?id=1"
  },
  {
    id: 2,
    nama: "Wortel Import",
    harga: 10000,
    stock: 100,
    gambar: "../img/wortel-impor.jpg",
    productLink: "product.html?id=2"
  },
  {
    id: 3,
    nama: "Jengkol",
    harga: 10000,
    stock: 100,
    gambar: "../img/jengkol.jpg",
    productLink: "product.html?id=3"
  },
];


document.addEventListener("DOMContentLoaded", () => {

})