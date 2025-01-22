<?php
require('../components/session.php');
require('../partials/usernav.php');
require('../components/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your cart at Cafeen. Manage your coffee orders and proceed to checkout.">
    <meta property="og:title" content="Cafeen - Cart">
    <meta property="og:image" content="img/coffee-banner.jpg">
    <title>Foamous - Cart</title>
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
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Outfit", serif;
      }
      html, body {
        height: 100%;
        overflow-x: hidden;
      }

      body {
        background-color: #f5f5dc;
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
      }

      .navbar-custom {
        background-color: #8b6b61;
      }

      .content {
        padding: 40px 20px 20px;
        padding-top: 50px;
        margin-left: 250px;
      }

      .section {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }

      .section-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #6b4f4f;
        margin-bottom: 15px;
      }

      .btn-primary {
        background-color: #6b4f4f;
        border: none;
      }

      .btn-primary:hover {
        background-color: #a38181;
      }

      .action-icons i {
        cursor: pointer;
        margin-right: 10px;
        font-size: 1.2rem;
        transition: color 0.3s ease, transform 0.3s ease;
      }

      .action-icons i:hover {
        color: brown;
        transform: scale(1.2);
      }

      .table th {
        background-color: #8b6b61;
        color: #fff;
      }

      tbody tr:nth-child(odd) {
        background-color: #fff;
      }

      tbody tr:nth-child(even) {
        background-color: #f9f6f4;
      }

      img {
        border-radius: 50%;
        width: 60px !important;
        height: 60px !important;
      }
      .fas{
         color: #b87d4b;

      }
      
.fa-trash-alt {
   color: #b87d4b;
    border: none;
    padding: 8px;
    border-radius: 50%;
    transition: background-color 0.3s ease;
    cursor: pointer;
}


.fa-trash-alt:hover {
    background-color: #b87d4b;
    color: white;
}
    </style>
</head>

<body>
    <!-- Banner Section -->
    <header class="banner">
        <div class="container">
            <div class="content-banner text-center text-md-start">
                <p class="text-primary fs-6 fw-medium mb-3">Your Cart</p>
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

    <!-- Cart Table -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
               
                <div style="display:<?= isset($_SESSION['showAlert']) ? $_SESSION['showAlert'] : 'none'; ?>"
                     class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?= isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                unset($_SESSION['showAlert']);
                unset($_SESSION['message']);
                ?>

           
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th colspan="7">
                                    <h4 class="text-center text-white m-0">Products in your cart!</h4>
                                </th>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>
                                    <a href="action.php?clear=all" class="btn btn-primary btn-sm"
                                       onclick="return confirm('Are you sure you want to clear your cart?');">
                                        <i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $connect->prepare('SELECT * FROM cart');
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $grand_total = 0;
                            foreach ($result as $row):
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <input type="hidden" class="pid" value="<?= htmlspecialchars($row['id']) ?>">
                                <td><img src="<?= htmlspecialchars($row['product_image']) ?>" width="50" alt="<?= htmlspecialchars($row['product_name']) ?>"></td>
                                <td><?= htmlspecialchars($row['product_name']) ?></td>
                                <td>
                                    <i class="fas fa-coffee"></i>&nbsp;&nbsp;<?= number_format($row['product_price'], 2); ?> EGP
                                </td>
                                <input type="hidden" class="pprice" value="<?= htmlspecialchars($row['product_price']) ?>">
                                <td>
                                    <input type="number" class="form-control itemQty" value="<?= htmlspecialchars($row['qty']) ?>" style="width:75px;">
                                </td>
                                <td><i class="fas fa-coffee"></i>&nbsp;&nbsp;<?= number_format($row['total_price'], 2); ?> EGP</td>
                                <td>
                                    <a href="action.php?remove=<?= htmlspecialchars($row['id']) ?>" class="text-danger lead"
                                       onclick="return confirm('Are you sure you want to remove this item?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $grand_total += $row['total_price']; ?>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3">
                                    <a href="product.php" class="btn btn-primary">
                                        <i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping
                                    </a>
                                </td>
                                <td colspan="2"><b>Grand Total</b></td>
                                <td><b><i class="fas fa-coffee"></i>&nbsp;&nbsp;<?= number_format($grand_total, 2); ?> EGP</b></td>
                                <td>
                                    <a href="checkout.php" class="btn btn-primary <?= ($grand_total > 1) ? '' : 'disabled'; ?>">
                                        <i class="fas fa-credit-card"></i>&nbsp;&nbsp;Checkout
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php require('../partials/footer.php'); ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>

    <!-- AJAX Script for Cart Updates -->
    <script type="text/javascript">
    $(document).ready(function() {
        $(".itemQty").on('change', function() {
            var $el = $(this).closest('tr');
            var pid = $el.find(".pid").val();
            var pprice = $el.find(".pprice").val();
            var qty = $el.find(".itemQty").val();

            $.ajax({
                url: 'action.php',
                method: 'post',
                data: {
                    qty: qty,
                    pid: pid,
                    pprice: pprice
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + status + error);
                }
            });
        });

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