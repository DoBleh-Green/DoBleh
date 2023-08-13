// index.html

document.addEventListener("DOMContentLoaded", () => {
  let searchForm = document.querySelector(".search-from");
  let searchBtn = document.querySelector("#search-btn");
  let shoppingCart = document.querySelector(".shopping-cart");
  let cartBtn = document.querySelector("#cart-btn");
  let loginForm = document.querySelector(".login-form");
  let loginBtn = document.querySelector("#login-btn");
  let navbar = document.querySelector(".navbar");
  let menuBtn = document.querySelector("#menu-btn");

  searchBtn.addEventListener("click", () => {
    searchForm.classList.toggle("active");
    shoppingCart.classList.remove("active");
    loginForm.classList.remove("active");
    navbar.classList.remove("active");
  });

  cartBtn.addEventListener("click", () => {
    shoppingCart.classList.toggle("active");
    searchForm.classList.remove("active");
    loginForm.classList.remove("active");
    navbar.classList.remove("active");  
  });

  loginBtn.addEventListener("click", () => {
    loginForm.classList.toggle("active");
    searchForm.classList.remove("active");
    shoppingCart.classList.remove("active");
    navbar.classList.remove("active");
  });

  menuBtn.addEventListener("click", () => {
    navbar.classList.toggle("active");
    searchForm.classList.remove("active");
    shoppingCart.classList.remove("active");
    loginForm.classList.remove("active");
  });

  window.onscroll = () => {
    searchForm.classList.remove("active");
    shoppingCart.classList.remove("active");
    loginForm.classList.remove("active");
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




// product.html














// about us.html










// 