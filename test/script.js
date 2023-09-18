// JavaScript for adding products to the cart and updating quantities

const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
const cartItemsList = document.getElementById('cart-items');
const cartTotal = document.getElementById('cart-total');
const cartPopup = document.getElementById('cart-popup');

const cart = [];

addToCartButtons.forEach(button => {
    button.addEventListener('click', () => {
        const productName = button.getAttribute('data-product');
        const productPrice = parseFloat(button.getAttribute('data-price'));

        // Check if the product is already in the cart
        const existingProduct = cart.find(item => item.name === productName);

        if (existingProduct) {
            // If the product is already in the cart, increase its quantity
            existingProduct.quantity++;
        } else {
            // If not, add the product to the cart
            cart.push({ name: productName, price: productPrice, quantity: 1 });
        }

        // Update the cart popup
        updateCartPopup();

        // Show a notification
        showNotification('Product added to cart');
    });
});

function updateCartPopup() {
    cartItemsList.innerHTML = '';
    let total = 0;

    cart.forEach(item => {
        const listItem = document.createElement('li');
        listItem.textContent = `${item.name} - $${item.price} x ${item.quantity}`;
        cartItemsList.appendChild(listItem);
        total += item.price * item.quantity;
    });

    cartTotal.textContent = `Total: $${total.toFixed(2)}`;
    cartPopup.style.display = 'block';
}

function showNotification(message) {
    const notification = document.createElement('div');
    notification.textContent = message;
    notification.className = 'notification';
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.remove();
    }, 3000);
}
