// // Product Data
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

// function renderProducts(category) {
//     const filteredProducts = category === 'all' ? products : products.filter(product => product.category === category);
//     const productContainer = document.getElementById(category);

//     console.log(`Rendering ${category} products:`, filteredProducts); // Debugging

//     productContainer.innerHTML = filteredProducts.map(product => `
//         <div class="col-md-6 col-lg-3">
//             <div class="card-product card shadow-sm border-0">
//                 <div class="container-img position-relative overflow-hidden">
//                     <img src="${product.image}" alt="${product.name}" class="img-fluid" />
//                     ${product.discount ? `<span class="discount badge bg-primary position-absolute top-0 start-0 m-2">${product.discount}</span>` : ''}
//                     <div class="button-group position-absolute top-0 end-0 d-flex flex-column gap-2 p-2">
//                         <button class="btn btn-outline-primary rounded-circle p-2" aria-label="View Product" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
//                             <i class="fa-regular fa-eye"></i>
//                         </button>
//                         <button class="btn btn-outline-primary rounded-circle p-2" aria-label="Add to Wishlist" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist">
//                             <i class="fa-regular fa-heart"></i>
//                         </button>
//                         <button class="btn btn-outline-primary rounded-circle p-2" aria-label="Compare Product" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
//                             <i class="fa-solid fa-code-compare"></i>
//                         </button>
//                     </div>
//                 </div>
//                 <div class="content-card-product p-3 text-center">
//                     <div class="stars mb-2">
//                         <i class="fa-solid fa-star text-warning"></i>
//                         <i class="fa-solid fa-star text-warning"></i>
//                         <i class="fa-solid fa-star text-warning"></i>
//                         <i class="fa-solid fa-star text-warning"></i>
//                         <i class="fa-regular fa-star text-warning"></i>
//                     </div>
//                     <h3 class="h5 mb-2">${product.name}</h3>
//                     <div class="d-flex justify-content-between align-items-center">
//                         <button class="add-cart btn btn-outline-primary rounded-circle p-2" aria-label="Add to Cart">
//                             <i class="fa-solid fa-basket-shopping"></i>
//                         </button>
//                         <p class="price mb-0">
//                             <span class="text-primary fw-bold">${product.price}</span>
//                             ${product.discount ? `<span class="text-muted text-decoration-line-through ms-2">$5.30</span>` : ''}
//                         </p>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     `).join('');
// }

// document.querySelectorAll('.container-options .btn').forEach(button => {
//     button.addEventListener('click', () => {
//         const target = button.getAttribute('data-target');
//         document.querySelectorAll('.product-section').forEach(section => {
//             section.classList.add('d-none');
//         });
//         document.getElementById(target).classList.remove('d-none');
//         renderProducts(target);
//     });
// });

// setTimeout(() => {
//     document.getElementById('loading').style.display = 'none';
//     renderProducts('all');
// }, 1000);
// let lovedProducts = [];

// // Render Products
// function renderProducts(category) {
// const filteredProducts = category === 'all' ? products : products.filter(product => product.category === category);
// const productContainer = document.getElementById(category);

// productContainer.innerHTML = filteredProducts.map(product => `
// <div class="col-md-6 col-lg-3">
//     <div class="card-product card shadow-sm border-0">
//         <div class="container-img position-relative overflow-hidden">
//             <img src="${product.image}" alt="${product.name}" class="img-fluid" />
//             ${product.discount ? `<span class="discount badge bg-primary position-absolute top-0 start-0 m-2">${product.discount}</span>` : ''}
//             <div class="button-group position-absolute top-0 end-0 d-flex flex-column gap-2 p-2">
//                 <button class="btn btn-outline-primary rounded-circle p-2" aria-label="View Product" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
//                     <i class="fa-regular fa-eye"></i>
//                 </button>
//                 <button class="btn btn-outline-primary rounded-circle p-2 love-btn" aria-label="Add to Wishlist" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist" data-id="${product.id}">
//                     ${lovedProducts.some(p => p.id === product.id) ? '<i class="fa-solid fa-heart"></i>' : '<i class="fa-regular fa-heart"></i>'}
//                 </button>
//                 <button class="btn btn-outline-primary rounded-circle p-2" aria-label="Compare Product" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
//                     <i class="fa-solid fa-code-compare"></i>
//                 </button>
//             </div>
//         </div>
//         <div class="content-card-product p-3 text-center">
//             <div class="stars mb-2">
//                 <i class="fa-solid fa-star text-warning"></i>
//                 <i class="fa-solid fa-star text-warning"></i>
//                 <i class="fa-solid fa-star text-warning"></i>
//                 <i class="fa-solid fa-star text-warning"></i>
//                 <i class="fa-regular fa-star text-warning"></i>
//             </div>
//             <h3 class="h5 mb-2">${product.name}</h3>
//             <div class="d-flex justify-content-between align-items-center">
//                 <button class="add-cart btn btn-outline-primary rounded-circle p-2" aria-label="Add to Cart">
//                     <i class="fa-solid fa-basket-shopping"></i>
//                 </button>
//                 <p class="price mb-0">
//                     <span class="text-primary fw-bold">${product.price}</span>
//                     ${product.discount ? `<span class="text-muted text-decoration-line-through ms-2">$5.30</span>` : ''}
//                 </p>
//             </div>
//         </div>
//     </div>
// </div>
// `).join('');

// document.querySelectorAll('.love-btn').forEach(button => {
// button.addEventListener('click', () => {
//     const productId = parseInt(button.getAttribute('data-id'));
//     const product = products.find(p => p.id === productId);

//     if (lovedProducts.some(p => p.id === productId)) {
//         lovedProducts = lovedProducts.filter(p => p.id !== productId);
//         button.innerHTML = '<i class="fa-regular fa-heart"></i>'; 
//     } else {
 
//         lovedProducts.push(product);
//         button.innerHTML = '<i class="fa-solid fa-heart"></i>'; 
//     }

//     renderLovedProducts();
// });
// });
// }

// function renderLovedProducts() {
// const lovedProductsList = document.getElementById('loved-products-list');
// lovedProductsList.innerHTML = lovedProducts.map(product => `
// <div class="product-item">
//     <img src="${product.image}" alt="${product.name}" />
//     <div class="product-info">
//         <h5>${product.name}</h5>
//         <p>${product.price}</p>
//     </div>
//     <button class="add-to-cart" onclick="addToCart(${product.id})">Add to Cart</button>
// </div>
// `).join('');
// }

// // Toggle Sidebar
// function toggleSidebar() {
// const sidebar = document.querySelector('.sidebar');
// sidebar.classList.toggle('open');
// }

// function addToCart(productId) {
// const product = products.find(p => p.id === productId);
// alert(`Added ${product.name} to cart!`);
// }

// setTimeout(() => {
// document.getElementById('loading').style.display = 'none';
// renderProducts('all');
// }, 1000);


// /////////////////////////////////////////////////////////////////
