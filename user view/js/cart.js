// const products = [
//     {
//         id: 1,
//         name: "Cafe Irish",
//         price: "$4.60",
//         discount: "-13%",
//         image: "img/cafe-irish.jpg",
//         category: "all"
//     },
//     {
//         id: 2,
//         name: "Cafe Inglés",
//         price: "$5.70",
//         discount: "-22%",
//         image: "img/cafe-ingles.jpg",
//         category: "popular"
//     },
//     {
//         id: 3,
//         name: "Cafe Australiano",
//         price: "$3.20",
//         image: "img/cafe-australiano.jpg",
//         category: "new"
//     },
//     {
//         id: 4,
//         name: "Cafe Helado",
//         price: "$5.60",
//         image: "img/cafe-helado.jpg",
//         category: "all"
//     },
//     {
//         id: 5,
//         name: "Cafe Australiano",
//         price: "$3.20",
//         image: "img/m1.png",
//         category: "new"
//     },
//     {
//         id: 6,
//         name: "Cafe Australiano",
//         price: "$3.20",
//         image: "img/m2.png",
//         category: "new"
//     },
//     {
//         id: 7,
//         name: "Cafe Australiano",
//         price: "$3.20",
//         image: "img/m3.png",
//         category: "new"
//     },
//     {
//         id: 8,
//         name: "Cafe Australiano",
//         price: "$3.20",
//         image: "img/m4.png",
//         category: "popular"
//     },
//     {
//         id: 9,
//         name: "Cafe Australiano",
//         price: "$3.20",
//         image: "img/m5.png",
//         category: "new"
//     },
//     {
//         id: 10,
//         name: "Cafe Australiano",
//         price: "$3.20",
//         image: "img/m6.png",
//         category: "popular"
//     },
// ];

// let cart = [];

// function loadCart() {
//     const savedCart = localStorage.getItem('cart');
//     if (savedCart) {
//         cart = JSON.parse(savedCart);
//     }
// }

// function renderCart() {
//     const cartContainer = document.getElementById('cart-container');
//     if (!cartContainer) return;

//     if (cart.length === 0) {
//         cartContainer.innerHTML = '<p>Your cart is empty.</p>';
//         return;
//     }

//     cartContainer.innerHTML = cart.map(item => `
//         <div class="cart-item">
//             <img src="${item.image}" alt="${item.name}" />
//             <div class="cart-item-info">
//                 <h5>${item.name}</h5>
//                 <p>${item.price}</p>
//                 <div class="quantity-controls">
//                     <button onclick="decreaseQuantity(${item.id})">-</button>
//                     <span>${item.quantity}</span>
//                     <button onclick="increaseQuantity(${item.id})">+</button>
//                 </div>
//                 <button onclick="removeFromCart(${item.id})">Remove</button>
//             </div>
//         </div>
//     `).join('');

//     const totalPrice = calculateTotal();
//     cartContainer.innerHTML += `<div class="cart-total"><strong>Total: $${totalPrice}</strong></div>`;
// }

// function calculateTotal() {
//     return cart.reduce((total, item) => total + (parseFloat(item.price.replace('$', '')) * item.quantity), 0).toFixed(2);
// }

// function increaseQuantity(productId) {
//     const product = cart.find(p => p.id === productId);
//     if (product) {
//         product.quantity += 1;
//         saveCart();
//         renderCart();
//     }
// }

// function decreaseQuantity(productId) {
//     const product = cart.find(p => p.id === productId);
//     if (product && product.quantity > 1) {
//         product.quantity -= 1;
//         saveCart();
//         renderCart();
//     }
// }

// function removeFromCart(productId) {
//     cart = cart.filter(p => p.id !== productId);
//     saveCart();
//     renderCart();
// }

// function saveCart() {
//     localStorage.setItem('cart', JSON.stringify(cart));
// }

// document.addEventListener('DOMContentLoaded', () => {
//     loadCart();
//     renderCart();
// });