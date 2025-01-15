<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: url('img/bg.png');
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .cart-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .cart-item {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .cart-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            object-fit: cover;
        }

        .quantity-controls button {
            background-color: #8b6b61;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .quantity-controls button:hover {
            background-color: #9c6840;
        }

        .checkout-btn {
            width: 100%;
            padding: 15px;
            background-color: #8b6b61;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.3rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .checkout-btn:hover {
            background-color: #9c6840;
        }

        .empty-cart-message {
            text-align: center;
            font-size: 1.5rem;
            color: #666;
            padding: 50px 0;
        }
    </style>
</head>
<body>
    <div class="container cart-container">
        <h1 class="text-center mb-4">Your Cart</h1>
        <div id="cart-items-list">
            <div class="empty-cart-message">Your cart is empty.</div>
        </div>
        <div class="cart-summary mt-4 pt-3 border-top">
            <p class="fs-5 fw-bold">Total Items: <span id="cart-total-items">0</span></p>
            <p class="fs-5 fw-bold">Total Price: <span id="cart-total-price">$0.00</span></p>
        </div>
        <button class="checkout-btn mt-4" onclick="checkout()">Checkout</button>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        function checkout() {
            window.location.href = "checkout.html";
        }
    </script>
</body>
</html>