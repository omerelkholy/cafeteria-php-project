<?php
require('../partials/usernav.php');
?>
<?php

require('../components/connect.php');


if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}

if (isset($_POST['add_to_cart'])) {
   if ($user_id == '') {
      header('location:login.php');
   } else {
      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $picture = $_POST['picture'];
      $picture = filter_var($picture, FILTER_SANITIZE_STRING);
      $qty = $_POST['qty'];
      $qty = filter_var($qty, FILTER_SANITIZE_STRING);

      $check_cart_numbers = $connect->prepare("SELECT * FROM `orders` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      if ($check_cart_numbers->rowCount() > 0) {
         $message[] = 'Already added to cart!';
      } else {

         $insert_cart = $connect->prepare("INSERT INTO `orders` (user_id, pid, name, price, quantity, picture) VALUES (?, ?, ?, ?, ?, ?)");
         $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $picture]);
         $message[] = 'Added to cart!';
      }
   }
}


$stmt = $connect->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Discover delicious and fresh coffee at our store. Shop now for the best coffee blends!">
    <meta property="og:title" content="Fresh Coffee - Product Page">
    <meta property="og:picture" content="img/coffee-banner.jpg">
    <title>Product</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
     <link rel="stylesheet" href="css/product.css?v=<?php echo time(); ?>">
     <link rel="stylesheet" href="css/style.min.css">
     <link href="img/fav.ico" rel="icon">

</head>
<body>
     <!-- Cart Icon -->
     <a href="cart.php" class="cart-toggle-btn">
        <i class="fas fa-shopping-cart"></i>
    </a>

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

            <!-- <div id="loading" class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div> -->

            <!-- All Products -->
            <div id="all" class="product-section row g-4">
                <?php
                foreach ($products as $product) {
                    echo '
                    <div class="col-md-6 col-lg-3">
                        <form action="" method="post" class="card-product card shadow-sm border-0">
                            <input type="hidden" name="pid" value="' . $product['id'] . '">
                            <input type="hidden" name="name" value="' . $product['name'] . '">
                            <input type="hidden" name="price" value="' . $product['price'] . ' ">
                            <input type="hidden" name="picture" value="' . $product['picture'] . '">
                            <input type="hidden" name="qty" value="1">
                            <div class="container-img position-relative overflow-hidden">
                                <img src="../admin view/productpictures/' . $product['picture'] . '" alt="' . $product['name'] . '" class="img-fluid" />
                                ' . ($product['discount'] ? '<span class="discount badge bg-primary position-absolute top-0 start-0 m-2">' . $product['discount'] . '</span>' : '') . '
                                <div class="button-group position-absolute top-0 end-0 d-flex flex-column gap-2 p-2">
                                    <button class="btn btn-outline-primary rounded-circle p-2" aria-label="View Product" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-primary rounded-circle p-2 love-btn" aria-label="Add to Wishlist" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist" data-id="' . $product['id'] . '">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                    <button class="btn btn-outline-primary rounded-circle p-2" aria-label="Compare Product" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <i class="fa-solid fa-code-compare"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="content-card-product p-3 text-center">
                                <div class="stars mb-2">
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-regular fa-star text-warning"></i>
                                </div>
                                <h3 class="h5 mb-2">' . $product['name'] . '</h3>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit" name="add_to_cart" class="add-cart btn btn-outline-primary rounded-circle p-2" aria-label="Add to Cart">
                                        <i class="fa-solid fa-basket-shopping"></i>
                                    </button>
                                    <p class="price mb-0">
                                        <span class="text-primary fw-bold">' . $product['price'] . ' EGP</span>
                                        ' . ($product['discount'] ? '<span class="text-muted text-decoration-line-through ms-2">$5.30</span>' : '') . '
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>';
                }
                ?>
            </div>

            <!-- Popular Products -->
            <div id="popular" class="product-section row g-4 d-none">
                <?php
                foreach ($products as $product) {
                    if ($product['category'] === 'popular') {
                        echo '
                        <div class="col-md-6 col-lg-3">
                            <form action="" method="post" class="card-product card shadow-sm border-0">
                                <input type="hidden" name="pid" value="' . $product['id'] . '">
                                <input type="hidden" name="name" value="' . $product['name'] . '">
                                <input type="hidden" name="price" value="' . $product['price'] . '">
                                <input type="hidden" name="picture" value="' . $product['picture'] . '">
                                <input type="hidden" name="qty" value="1">
                                <div class="container-img position-relative overflow-hidden">
                                    <img src="../admin view/productpictures/' . $product['picture'] . '" alt="' . $product['name'] . '" class="img-fluid" />
                                    ' . ($product['discount'] ? '<span class="discount badge bg-primary position-absolute top-0 start-0 m-2">' . $product['discount'] . '</span>' : '') . '
                                    <div class="button-group position-absolute top-0 end-0 d-flex flex-column gap-2 p-2">
                                        <button class="btn btn-outline-primary rounded-circle p-2" aria-label="View Product" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-primary rounded-circle p-2 love-btn" aria-label="Add to Wishlist" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist" data-id="' . $product['id'] . '">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                        <button class="btn btn-outline-primary rounded-circle p-2" aria-label="Compare Product" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                            <i class="fa-solid fa-code-compare"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="content-card-product p-3 text-center">
                                    <div class="stars mb-2">
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-regular fa-star text-warning"></i>
                                    </div>
                                    <h3 class="h5 mb-2">' . $product['name'] . '</h3>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button type="submit" name="add_to_cart" class="add-cart btn btn-outline-primary rounded-circle p-2" aria-label="Add to Cart">
                                            <i class="fa-solid fa-basket-shopping"></i>
                                        </button>
                                        <p class="price mb-0">
                                            <span class="text-primary fw-bold">' . $product['price'] . ' EGP</span>
                                            ' . ($product['discount'] ? '<span class="text-muted text-decoration-line-through ms-2">$5.30</span>' : '') . '
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>';
                    }
                }
                ?>
            </div>

            <!-- New Products -->
            <div id="new" class="product-section row g-4 d-none">
                <?php
                foreach ($products as $product) {
                    if ($product['category'] === 'new') {
                        echo '
                        <div class="col-md-6 col-lg-3">
                            <form action="" method="post" class="card-product card shadow-sm border-0">
                                <input type="hidden" name="pid" value="' . $product['id'] . '">
                                <input type="hidden" name="name" value="' . $product['name'] . '">
                                <input type="hidden" name="price" value="' . $product['price'] . '">
                                <input type="hidden" name="picture" value="' . $product['picture'] . '">
                                <input type="hidden" name="qty" value="1">
                                <div class="container-img position-relative overflow-hidden">
                                    <img src="../admin view/productpictures/' . $product['picture'] . '" alt="' . $product['name'] . '" class="img-fluid" />
                                    ' . ($product['discount'] ? '<span class="discount badge bg-primary position-absolute top-0 start-0 m-2">' . $product['discount'] . '</span>' : '') . '
                                    <div class="button-group position-absolute top-0 end-0 d-flex flex-column gap-2 p-2">
                                        <button class="btn btn-outline-primary rounded-circle p-2" aria-label="View Product" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-primary rounded-circle p-2 love-btn" aria-label="Add to Wishlist" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist" data-id="' . $product['id'] . '">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                        <button class="btn btn-outline-primary rounded-circle p-2" aria-label="Compare Product" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                            <i class="fa-solid fa-code-compare"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="content-card-product p-3 text-center">
                                    <div class="stars mb-2">
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-regular fa-star text-warning"></i>
                                    </div>
                                    <h3 class="h5 mb-2">' . $product['name'] . '</h3>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button type="submit" name="add_to_cart" class="add-cart btn btn-outline-primary rounded-circle p-2" aria-label="Add to Cart">
                                            <i class="fa-solid fa-basket-shopping"></i>
                                        </button>
                                        <p class="price mb-0">
                                            <span class="text-primary fw-bold">' . $product['price'] . ' EGP</span>
                                            ' . ($product['discount'] ? '<span class="text-muted text-decoration-line-through ms-2">$5.30</span>' : '') . '
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>';
                    }
                }
                ?>
            </div>
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

    <?php require('../partials/footer.php'); ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
</body>
</html>