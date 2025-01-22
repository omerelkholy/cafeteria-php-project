<?php
$host = 'localhost';
$dbname = 'cafeteria';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// هجيب البينات اللى هتتعرض فى الصفحةمن هنا 
$products = [];
$sql = "SELECT id, name, price, category, picture FROM products";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// الداتا بتاع اليزرز من هنا
$users = [];
$sql = "SELECT id, name, room_no FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// ارقام الاوض
$rooms = [];
$sql = "SELECT DISTINCT room_no FROM users WHERE room_no IS NOT NULL";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row['room_no'];
    }
}

// الكود اللي يهيتنفذ لما اضغط علي الزرار
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // بشيك علي البيانات المطلوبة من اليوزر
    if (!isset($_POST['user']) || !isset($_POST['room']) || !isset($_POST['product_id']) || !isset($_POST['quantity'])) {
        die("Error: Missing required data.");
    }

    // الداتا اللي جايه بحطها في فاريابلز
    $userId = $_POST['user'];
    $roomNo = $_POST['room'];
    $productIds = $_POST['product_id'];
    $quantities = $_POST['quantity'];

    // التحقق من أن product_id و quantity عبارة عن مصفوفات
    if (!is_array($productIds) || !is_array($quantities)) {
        die("Error: Invalid data format.");
    }

    // بدخل الطلب في جدول الاوردرات
    foreach ($productIds as $index => $productId) {
        if (!isset($quantities[$index])) {
            continue; // سكيب لو مفيش كمية مطابقة
        }

        $quantity = $quantities[$index];
        $sql = "INSERT INTO orders (user_id, product_id, quantity, room_no) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("iiis", $userId, $productId, $quantity, $roomNo);

        if (!$stmt->execute()) {
            die("Error executing statement: " . $stmt->error);
        }

        $stmt->close();
    }

    echo "Order submitted successfully!";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body {
            margin-top: 20px;
            background: #f5f5dc;
            font-family: 'Poppins', sans-serif;
            color: #4a4a4a;
        }

        .cart-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .cart-container h2 {
            color: #8B4513;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .cart-item {
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-item p {
            margin: 0;
        }

        .total-price {
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
        }

        .btn-confirm {
            background-color: #8B4513;
            color: #fff;
            margin-top: 20px;
            transition: background-color 0.3s ease;
            font-weight: 500;
        }

        .btn-confirm:hover {
            background-color: #6e3610;
        }

        .room-selection select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .room-selection select:focus {
            border-color: #8B4513;
            outline: none;
        }

        .confirmation-message {
            display: none;
            margin-top: 20px;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
        }

        .product-content {
            border: 2px solid #dfe5e9;
            margin-bottom: 20px;
            margin-top: 12px;
            background: #fff;
            padding: 4px;
            -webkit-box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.37);
            box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.37);
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .product-content:hover {
            transform: translateY(-5px);
        }

        .product-content .product-image {
            background-color: #fff;
            display: block;
            min-height: 238px;
            overflow: hidden;
            position: relative;
            border-radius: 10px 10px 0 0;
        }

        .product-content .product-image img {
            width: 100%;
            height: auto;
            border-radius: 10px 10px 0 0;
        }

        .product-content .product-deatil {
            border-bottom: 1px solid #dfe5e9;
            padding-bottom: 17px;
            padding-left: 16px;
            padding-top: 16px;
            position: relative;
            background: #fff;
        }

        .product-content .product-deatil h5 a {
            color: #2f383d;
            font-size: 15px;
            line-height: 19px;
            text-decoration: none;
            padding-left: 0;
            margin-left: 0;
        }

        .product-content .product-deatil h5 a span {
            color: #9aa7af;
            display: block;
            font-size: 13px;
        }

        .product-content .description {
            font-size: 12.5px;
            line-height: 20px;
            padding: 10px 14px 16px 19px;
            background: #fff;
        }

        .product-content .product-info {
            padding: 11px 19px 10px 20px;
        }

        .product-content .product-info .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            transition: background-color 0.3s ease;
        }

        .product-content .product-info .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .remove-item {
            color: #dc3545;
            cursor: pointer;
            font-size: 14px;
            margin-left: 10px;
        }

        .remove-item:hover {
            color: #c82333;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .quantity-control button {
            background-color: #8B4513;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin: 0 5px;
        }

        .quantity-control button:hover {
            background-color: #6e3610;
        }

        .quantity-control span {
            font-size: 16px;
            margin: 0 10px;
        }

        .navbar {
            background-color: #8B4513;
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .navbar h1 {
            margin: 0;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>admin Order System</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- Cart -->
            <div class="col-md-3">
                <div class="cart-container">
                    <h2>your Cart</h2>
                    <form id="orderForm" method="POST">
                        <div id="cart-items">
                        </div>
                        <div class="total-price">
                            Total: EGP <span id="total-price">0</span>
                        </div>
                        <div class="form-group room-selection">
                            <label for="room">Room Number:</label>
                            <select class="form-control" name="room" id="room">
                                <option value="">Select Room</option>
                                <?php foreach ($rooms as $room): ?>
                                    <option value="<?php echo $room; ?>">Room <?php echo $room; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" name="user" id="user" value="">
                        <button type="submit" id="confirmButton" class="btn btn-confirm btn-block">Confirm Order</button>
                        <div id="confirmationMessage" class="confirmation-message">
                            Our delivery is on the way.
                        </div>
                    </form>
                </div>
            </div>

            <!-- المنيو-->
            <div class="col-md-9">
                <div class="form-group">
                    <label for="user">Select User:</label>
                    <select class="form-control" name="user" id="user-select">
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['id']; ?>" data-room="<?php echo $user['room_no']; ?>">
                                <?php echo $user['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row">
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-6">
                            <div class="product-content product-wrap clearfix">
                                <div class="row">
                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                        <div class="product-image">
                                            <img src="<?php echo $product['picture']; ?>" alt="<?php echo $product['name']; ?>" class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <div class="product-deatil">
                                            <h5 class="name">
                                                <a href="#"><?php echo $product['name']; ?></a>
                                            </h5>
                                            <p class="price-container">
                                                <span>EGP <?php echo $product['price']; ?></span>
                                            </p>
                                        </div>
                                        <div class="product-info smart-form">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="quantity-control">
                                                        <button class="btn-decrease" data-product-id="<?php echo $product['id']; ?>">-</button>
                                                        <span class="quantity" data-product-id="<?php echo $product['id']; ?>">0</span>
                                                        <button class="btn-increase" data-product-id="<?php echo $product['id']; ?>">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        let cart = [];

        // الكمية + او -
        $(document).on('click', '.btn-increase', function() {
            const productId = $(this).data('product-id');
            const product = cart.find(item => item.id === productId);

            if (product) {
                product.quantity += 1;
            } else {
                const productName = $(this).closest('.product-content').find('.name a').text();
                const productPrice = parseFloat($(this).closest('.product-content').find('.price-container span').text().replace('EGP ', ''));
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    quantity: 1
                });
            }

            updateCartUI();
            updateQuantityDisplay(productId);
        });

        $(document).on('click', '.btn-decrease', function() {
            const productId = $(this).data('product-id');
            const product = cart.find(item => item.id === productId);

            if (product) {
                if (product.quantity > 1) {
                    product.quantity -= 1;
                } else {
                    cart = cart.filter(item => item.id !== productId);
                }
            }

            updateCartUI();
            updateQuantityDisplay(productId);
        });

        function updateCartUI() {
            const cartItems = $('#cart-items');
            cartItems.empty();

            let totalPrice = 0;
            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                totalPrice += itemTotal;

                cartItems.append(`
                    <div class="cart-item">
                        <p>${item.name} (${item.quantity}) - EGP ${itemTotal}</p>
                        <span class="remove-item" data-index="${index}">Remove</span>
                        <input type="hidden" name="product_id[]" value="${item.id}">
                        <input type="hidden" name="quantity[]" value="${item.quantity}">
                    </div>
                `);
            });

            $('#total-price').text(totalPrice.toFixed(2));
        }

        function updateQuantityDisplay(productId) {
            const product = cart.find(item => item.id === productId);
            const quantityDisplay = $(`.quantity[data-product-id="${productId}"]`);
            quantityDisplay.text(product ? product.quantity : 0);
        }

        $(document).on('click', '.remove-item', function() {
            const index = $(this).data('index');
            cart.splice(index, 1);
            updateCartUI();
        });

        document.getElementById('user-select').addEventListener('change', function() {
            const selectedUser = this.options[this.selectedIndex];
            const userId = selectedUser.value;
            document.getElementById('user').value = userId;
        });

        $('#orderForm').on('submit', function(e) {
            e.preventDefault();

            // لو الكارت فاضي
            if (cart.length === 0) {
                alert("Your cart is empty. Please add products before confirming the order.");
                return;
            }

            // هنبعت الداتا ب ajax
            const formData = $(this).serializeArray();
            formData.push({
                name: 'product_id[]',
                value: cart.map(item => item.id)
            });
            formData.push({
                name: 'quantity[]',
                value: cart.map(item => item.quantity)
            });

            $.ajax({
                url: '',
                type: 'POST',
                data: $.param(formData),
                success: function(response) {
                    $('#confirmationMessage').show();
                    setTimeout(() => {
                        $('#confirmationMessage').hide();
                        cart = [];
                        updateCartUI();
                        $('#orderForm')[0].reset();
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    alert('Error submitting order. Please try again.');
                }
            });
        });
    </script>
</body>

</html>