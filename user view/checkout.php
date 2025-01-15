<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
         body {
            background: url('img/our-story-bg.png');
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .checkout-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            margin-right: 15px;
            border-radius: 5px;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-info h5 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }

        .cart-item-info p {
            margin: 5px 0;
            font-size: 1rem;
            color: #666;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-controls button {
            background-color: #8b6b61;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .quantity-controls button:hover {
            background-color: #8b6b59;
        }

        .cart-total {
            margin-top: 20px;
            font-size: 1.2rem;
            font-weight: bold;
            text-align: right;
        }

        .checkout-form {
            margin-top: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .place-order-btn {
            width: 100%;
            padding: 15px;
            background-color: #8b6b61;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.2rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .place-order-btn:hover {
            background-color: #b87d3b;
        }
   
    </style>
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout</h1>

        <!-- Cart Items -->
        <div id="cart-items">
        </div>
        <div class="cart-total">
            <strong>Total: $<span id="cart-total-price">0.00</span></strong>
        </div>

        <!-- Checkout Form -->
        <form id="checkout-form" class="checkout-form" action="process_order.php" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Shipping Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="room-number">Room Number</label>
                <input type="text" id="room-number" name="room_number" required>
            </div>
            <div class="form-group">
                <label for="payment">Payment Method</label>
                <select id="payment" name="payment" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="cash_on_delivery">Cash on Delivery</option>
                </select>
            </div>
            <button type="submit" class="place-order-btn">Place Order</button>
        </form>
    </div>

    <!-- Custom JS -->
    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        function renderCart() {
            const cartItemsContainer = document.getElementById('cart-items');
            const cartTotalPrice = document.getElementById('cart-total-price');

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
                cartTotalPrice.textContent = '0.00';
                return;
            }

            let totalPrice = 0;
            let cartHTML = '';

            cart.forEach(item => {
                totalPrice += parseFloat(item.price.replace('$', '')) * item.quantity;

                cartHTML += `
                    <div class="cart-item">
                        <img src="${item.image}" alt="${item.name}">
                        <div class="cart-item-info">
                            <h5>${item.name}</h5>
                            <p>${item.price} x ${item.quantity}</p>
                        </div>
                    </div>
                `;
            });

            cartItemsContainer.innerHTML = cartHTML;
            cartTotalPrice.textContent = totalPrice.toFixed(2);
        }

        document.getElementById('checkout-form').addEventListener('submit', function (event) {
 
            const cartInput = document.createElement('input');
            cartInput.type = 'hidden';
            cartInput.name = 'cart';
            cartInput.value = JSON.stringify(cart);
            this.appendChild(cartInput);

            localStorage.removeItem('cart');
        });

        renderCart();
    </script>
</body>
</html>