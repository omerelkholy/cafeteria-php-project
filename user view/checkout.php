<?php
session_start();
require('../partials/usernav.php');
require('../components/connect.php');

$grand_total = 0;
$allItems = '';
$items = [];

$sql = "SELECT CONCAT(product_name, '(', qty, ')') AS ItemQty, total_price FROM cart";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
    $grand_total += $row['total_price'];
    $items[] = $row['ItemQty'];
}
$allItems = implode(', ', $items);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Checkout page for Cafeen. Complete your coffee order and proceed to payment.">
    <meta property="og:title" content="Cafeen - Checkout">
    <meta property="og:image" content="img/coffee-banner.jpg">
    <title>Cafeen - Checkout</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
    <link href="css/product.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link href="img/fav.ico" rel="icon">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .navbar-custom {
            background-color: #8b6b61;
        }

        .jumbotron {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #b87d4b;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #9c6840;
        }

        .form-control:focus {
            border-color: #b87d4b;
            box-shadow: 0 0 5px rgba(184, 125, 75, 0.5);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group select {
            appearance: none;
            background-color: #fff;
        }

        .form-group input[type="submit"] {
            background-color: #b87d4b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group input[type="submit"]:hover {
            background-color: #9c6840;
        }
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
                <p class="text-primary fs-6 fw-medium mb-3">Checkout</p>
                <h1 class="text-white display-4 fw-medium mb-4">
                    Manage Your <br />Coffee Orders
                </h1>
                <a href="product.php" class="btn btn-primary text-uppercase px-5 py-3 rounded-pill">
                    Continue Shopping
                </a>
            </div>
        </div>
    </header>

    <!-- Button Group -->
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

    <!-- Checkout Form -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 px-4 pb-4" id="order">
                <h4 class="text-center text-info p-2">Complete your order!</h4>
                <div class="jumbotron p-3 mb-2 text-center">
                    <h6 class="lead"><b>Product(s) : </b><?= htmlspecialchars($allItems); ?></h6>
                    <h5><b>Total Amount Payable : </b><?= number_format($grand_total, 2) ?> EGP</h5>
                </div>
                <form action="" method="post" id="placeOrder">
                    <input type="hidden" name="products" value="<?= htmlspecialchars($allItems); ?>">
                    <input type="hidden" name="grand_total" value="<?= htmlspecialchars($grand_total); ?>">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
                    </div>
                    <!-- <div class="form-group">
                        <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
                    </div> -->
                    <div class="form-group">
                        <textarea name="room_no" class="form-control" rows="3" placeholder="Enter room number Here..." required></textarea>
                    </div>
                    <!-- <h6 class="text-center lead">Select Payment Mode</h6>
 <div class="form-group">
                        <select name="pmode" class="form-control" required>
                            <option value="" selected disabled>-Select Payment Mode-</option>
                            <option value="netbanking">Net Banking</option>
                            <option value="cards">Debit/Credit Card</option>
                        </select>
                    </div> --> 
                    <div class="form-group">
                     <a href="order.php">   <input type="submit" name="submit" value="Place Order" class="btn btn-primary btn-block"></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require('../partials/footer.php'); ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            
            $("#placeOrder").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: $('form').serialize() + "&action=order",
                    success: function(response) {
                        $("#order").html(response);
                    }
                });
            });

            // Load total no.of items added in the cart and display in the navbar
            load_cart_item_number();

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