<?php
require('../partials/usernav.php');
?>
<?php
require('../partials/usernav.php');
require('../components/connect.php');

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
    <!-- Customized Stylesheet -->
     <link href="css/style.min.css" rel="stylesheet">
    <link href="css/product.css" rel="stylesheet?v=<?php echo time(); ?>">
     <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <title>Foamous</title>
     <link href="img/fav.ico" rel="icon">

    <style>
             .fas{
         color: #b87d4b;

      }
      
    </style>

</head>
<body>
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

    <!-- Button Group Start -->
    <div class="container-fluid bg-dark py-2">
        <div class="d-flex justify-content-center gap-3">
            <a href="product.php" class="btn btn-outline-light">
                <i class="fas fa-coffee me-2"></i>Products
            </a>
            <!-- <a href="#" class="btn btn-outline-light">
                <i class="fas fa-th-list me-2"></i>Categories
            </a> -->
            <a href="checkout.php" class="btn btn-outline-light">
                <i class="fas fa-money-check-alt me-2"></i>Checkout
            </a>
            <a href="cart.php" class="btn btn-outline-light position-relative">
                <i class="fas fa-shopping-cart"></i>
                <span id="cart-item" class="badge bg-danger position-absolute top-0 start-100 translate-middle">0</span>
            </a>
        </div>
    </div>
    <!-- Button Group End -->

    <!-- Displaying Products Start -->
    <div class="container">
        <div id="message"></div>
        <div class="row mt-2 pb-3">
            <?php foreach ($products as $product): ?>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card-product card shadow-sm border-0">
                        <div class="container-img position-relative overflow-hidden">
                            <img src="../admin view/productpictures/<?= htmlspecialchars($product['picture']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="card-img-top" height="250" />
                            <div class="button-group position-absolute top-0 end-0 d-flex flex-column gap-2 p-2">
                                <button class="btn btn-outline-primary rounded-circle p-2" aria-label="View Product" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                                <button class="btn btn-outline-primary rounded-circle p-2 love-btn" aria-label="Add to Wishlist" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist" data-id="<?= $product['id'] ?>">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <button class="btn btn-outline-primary rounded-circle p-2" aria-label="Compare Product" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                    <i class="fa-solid fa-code-compare"></i>
                                </button>
                            </div>
                        </div>
                        <div class="content-card-product p-3 text-center">
    <h4 class="card-title text-center mb-2"><?= htmlspecialchars($product['name'] ?? '') ?></h4>
    <h5 class="card-text text-center mb-3">
        <i class="fas fa-coffee"></i>&nbsp;&nbsp;<?= number_format($product['price'] ?? 0, 2) ?> EGP
    </h5>
    <form action="" method="post" class="form-submit">
        <div class="row p-2">
            <div class="col-md-6 py-1 pl-4">
                <b>Quantity : </b>
            </div>
            <div class="col-md-6">
                <input type="number" class="form-control pqty" name="qty" value="1" min="1">
            </div>
        </div>
        <input type="hidden" name="pid" class="pid" value="<?= htmlspecialchars($product['id'] ?? '') ?>">
        <input type="hidden" name="name" class="pname" value="<?= htmlspecialchars($product['name'] ?? '') ?>">
        <input type="hidden" name="price" class="pprice" value="<?= htmlspecialchars($product['price'] ?? 0) ?>">
        <input type="hidden" name="picture" class="pimage" value="<?= htmlspecialchars($product['picture'] ?? '') ?>">
        <button type="submit" name="add_to_cart" class="btn btn-primary addItemBtn">
            <i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to cart
        </button>
    </form>
</div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Displaying Products End -->

    <?php require('../partials/footer.php'); ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="js/main.js"></script>

    <!-- AJAX Script for Adding to Cart -->
    <script type="text/javascript">
    $(document).ready(function() {
        load_cart_item_number();

        $(".form-submit").submit(function(e) {
            e.preventDefault();
            var $form = $(this);
            var pid = $form.find(".pid").val();
            var pname = $form.find(".pname").val();
            var pprice = $form.find(".pprice").val();
            var pimage = $form.find(".pimage").val();
            var pqty = $form.find(".pqty").val();

            $.ajax({
                url: 'action.php',
                method: 'post',
                data: {
                    pid: pid,
                    pname: pname,
                    pprice: pprice,
                    pimage: pimage,
                    pqty: pqty
                },
                success: function(response) {
                    $("#message").html(response);
                    window.scrollTo(0, 0);
                    load_cart_item_number(); 
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + status + error);
                }
            });
        });

        
        function load_cart_item_number() {
            $.ajax({
                url: 'action.php',
                method: 'get',
                data: {
                    cartItem: "cart_item"
                },
                success: function(response) {
                    $("#cart-item").html(response);
                }
            });
        }
    });
    </script>
</body>
</html>