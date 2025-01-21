<?php
include 'connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:userHome.php');
    exit();
}

$fetch_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$fetch_profile->execute([$user_id]);
$fetch_profile = $fetch_profile->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];

    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);

    if ($check_cart->rowCount() > 0) {
        if ($address == '') {
            $message[] = 'Please add your address!';
        } else {
            
            $insert_order = $conn->prepare("INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

           
            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart->execute([$user_id]);

            $message[] = 'Order placed successfully!';
        }
    } else {
        $message[] = 'Your cart is empty!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Custom CSS for Checkout Page */
        body {
            background: #f9f9f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .checkout-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .heading {
            text-align: center;
            margin-bottom: 30px;
        }

        .heading h3 {
            font-size: 2rem;
            color: #333;
        }

        .heading p {
            font-size: 1.2rem;
            color: #666;
        }

        .cart-items {
            margin-bottom: 30px;
        }

        .cart-items h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item .name {
            font-size: 1.2rem;
            color: #333;
        }

        .cart-item .price {
            font-size: 1.2rem;
            color: #8b6b61;
        }

        .grand-total {
            text-align: right;
            margin-top: 20px;
            font-size: 1.5rem;
            color: #333;
        }

        .grand-total .price {
            color: #8b6b61;
            font-weight: bold;
        }

        .user-info {
            margin-top: 30px;
        }

        .user-info h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        .user-info p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 10px;
        }

        .user-info select {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .user-info .btn {
            width: 100%;
            padding: 15px;
            background: #8b6b61;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .user-info .btn:hover {
            background: #6b4f4f;
        }

        .user-info .btn.disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 1rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <!-- Header Section -->


    <!-- Checkout Section -->
    <div class="checkout-container">
        <div class="heading">
            <h3>Checkout</h3>
            <p><a href="home.php">Home</a> <span> / Checkout</span></p>
        </div>

        <!-- Display Error Messages -->
        <?php
        if (!empty($message)) {
            foreach ($message as $msg) {
                echo '<div class="alert alert-success">' . $msg . '</div>';
            }
        }
        ?>

        <form action="" method="post">
            <div class="cart-items">
                <h3>Cart Items</h3>
                <?php
                $grand_total = 0;
                $cart_items = [];
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);
                if ($select_cart->rowCount() > 0) {
                    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                        $cart_items[] = $fetch_cart['name'] . ' (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ') - ';
                        $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                ?>
                        <div class="cart-item">
                            <span class="name"><?= $fetch_cart['name']; ?></span>
                            <span class="price">$<?= $fetch_cart['price']; ?> x <?= $fetch_cart['quantity']; ?></span>
                        </div>
                <?php
                    }
                } else {
                    echo '<p class="empty">Your cart is empty!</p>';
                }
                ?>
                <div class="grand-total">
                    <span class="name">Grand Total:</span>
                    <span class="price">$<?= $grand_total; ?></span>
                </div>
                <a href="cart.php" class="btn">View Cart</a>
            </div>

            <input type="hidden" name="total_products" value="<?= implode(', ', $cart_items); ?>">
            <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
            <input type="hidden" name="name" value="<?= $fetch_profile['name']; ?>">
            <input type="hidden" name="number" value="<?= $fetch_profile['number']; ?>">
            <input type="hidden" name="email" value="<?= $fetch_profile['email']; ?>">
            <input type="hidden" name="address" value="<?= $fetch_profile['address']; ?>">

            <div class="user-info">
                <h3>Your Info</h3>
                <p><i class="fas fa-user"></i><span><?= $fetch_profile['name']; ?></span></p>
                <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number']; ?></span></p>
                <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email']; ?></span></p>
                <a href="update_profile.php" class="btn">Update Info</a>

                <h3>Delivery Address</h3>
                <p><i class="fas fa-map-marker-alt"></i><span><?= ($fetch_profile['address'] == '') ? 'Please enter your address' : $fetch_profile['address']; ?></span></p>
                <a href="update_address.php" class="btn">Update Address</a>

                <select name="method" class="box" required>
                    <option value="" disabled selected>Select Payment Method --</option>
                    <option value="cash on delivery">Cash on Delivery</option>
                    <option value="credit card">Credit Card</option>
                    <option value="paytm">Paytm</option>
                    <option value="paypal">Paypal</option>
                </select>

                <input type="submit" value="Place Order" class="btn <?= ($fetch_profile['address'] == '') ? 'disabled' : ''; ?>" name="submit">
            </div>
        </form>
    </div>

    <!-- Footer Section -->


    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>
</html>