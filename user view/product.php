<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Discover delicious and fresh coffee at our store. Shop now for the best coffee blends!">
    <meta property="og:title" content="Fresh Coffee - Product Page">
    <meta property="og:image" content="img/coffee-banner.jpg">
    <title>Product</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
     <link rel="stylesheet" href="css/product.css">
     <link rel="stylesheet" href="css/style.min.css">
     <link href="img/fav.ico" rel="icon">

</head>
<body>
     <!-- Cart Icon -->
     <a href="cart.html" class="cart-toggle-btn">
        <i class="fas fa-shopping-cart"></i>
    </a>
     <!-- Cart Sidebar -->
     <!-- <div class="sidebar cart-sidebar">
        <div class="close-btn" onclick="toggleCartSidebar()">
            <i class="fas fa-times"></i>
        </div>
        <h3>Your Cart</h3>
        <div id="cart-items-list">
            <div class="empty-cart-message">Your cart is empty.</div>
        </div>
        <div class="cart-summary">
            <p>Total Items: <span id="cart-total-items">0</span></p>
            <p>Total Price: <span id="cart-total-price">$0.00</span></p>
        </div>
    </div> -->

    <!-- Button to Open Cart Sidebar -->
    <!-- <button class="cart-toggle-btn" onclick="toggleCartSidebar()">
        <i class="fas fa-shopping-cart"></i> View Cart
    </button> -->
    <!-- Banner Section -->
    <header class="banner">
        <div class="container">
            <div class="content-banner text-center text-md-start">
                <p class="text-primary fs-6 fw-medium mb-3">Delicious Coffee</p>
                <h1 class="text-white display-4 fw-medium mb-4">
                    100% Natural <br />Fresh Coffee
                </h1>
                <a href="#" class="btn btn-primary text-uppercase px-5 py-3 rounded-pill">
                    Buy Now
                </a>
            </div>
        </div>
    </header>

    <!-- Product Section -->
    <main class="top-products py-5">
        <div class="container" id="product-container">
      
            <div class="container-options d-flex justify-content-center gap-4 mb-5">
                <button class="btn btn-outline-primary rounded-pill px-4 py-2" data-target="all">All</button>
                <button class="btn btn-outline-primary rounded-pill px-4 py-2" data-target="popular">Popular</button>
                <button class="btn btn-outline-primary rounded-pill px-4 py-2" data-target="new">New</button>
            </div>

     
            <div id="loading" class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div id="all" class="product-section row g-4"></div>
            <div id="popular" class="product-section row g-4 d-none"></div>
            <div id="new" class="product-section row g-4 d-none"></div>
        </div>
    </main>
     <!-- Sidebar -->
    <div class="sidebar">
        <div class="close-btn" onclick="toggleSidebar()">
            <i class="fas fa-times"></i>
        </div>
        <h3>Loved Products</h3>
        <div id="loved-products-list"></div>
    </div>
    <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
        <i class="fas fa-heart"></i> 
    </button>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="js/scripts.js">
    </script>
</body>
</html>