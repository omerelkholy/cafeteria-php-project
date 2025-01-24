<?php require('../components/connect.php'); ?>

<?php
$products = [];
$sql = "SELECT id, name, price, category, picture FROM products order by name asc";
$statement = $connect->prepare($sql);
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

$users = [];
$sql = "SELECT id, name, room_no FROM users";
$statement = $connect->prepare($sql);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

$rooms = [200,201,202,203,204,205,206,207];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $connect->beginTransaction();
        
        $postData = json_decode(file_get_contents('php://input'), true);
        if (!isset($postData['userId']) || !isset($postData['roomNo']) || !isset($postData['items']) || empty($postData['items'])) {
            throw new Exception("Missing required data");
        }

        $userId = $postData['userId'];
        $roomNo = $postData['roomNo']?$postData['roomNo']:null;
        $items = $postData['items'];

        $totalAmount = 0;
        foreach ($items as $item) {
            $sql = "SELECT price FROM products WHERE id = ?";
            $stmt = $connect->prepare($sql);
            $stmt->execute([$item['productId']]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$product) {
                throw new Exception("Invalid product ID: " . $item['productId']);
            }
            
            $totalAmount += $product['price'] * $item['quantity'];
        }

        $sql = "INSERT INTO orders (user_id, total_amount, room_no) VALUES (?, ?, ?)";
        $stmt = $connect->prepare($sql);
        $stmt->execute([$userId, $totalAmount, $roomNo]);
        $orderId = $connect->lastInsertId();

        $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $connect->prepare($sql);
        
        foreach ($items as $item) {
            $productStmt = $connect->prepare("SELECT price FROM products WHERE id = ?");
            $productStmt->execute([$item['productId']]);
            $product = $productStmt->fetch(PDO::FETCH_ASSOC);
            
            $stmt->execute([
                $orderId,
                $item['productId'],
                $item['quantity'],
                $product['price']
            ]);
        }

        $connect->commit();
        
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Order placed successfully']);
        exit;
        
    } catch (Exception $e) {
        $connect->rollBack();
        
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body {
            margin-top: 20px;
            background: #f5f5dc;
            font-family: "Outfit", serif;
            color: #4a4a4a;
        }

        .cart-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .cart-container h2 {
            color: #8b6b61;
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
            margin: 0px;
        }

        .total-price {
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
        }

        .btn-confirm {
            background-color: #8b6b61;
            color: #fff;
            margin-top: 20px;
            transition: background-color 0.3s ease;
            font-weight: 500;
        }

        .btn-confirm:hover {
            background-color: #a38181;
            color: white;
        }

        .room-selection select {
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .room-selection select:focus {
            border-color: #8b6b61;
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
            background-color: #8b6b61;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin: 0 5px;
        }

        .quantity-control button:hover {
            background-color: #a38181;
        }

        .quantity-control span {
            font-size: 16px;
            margin: 0 10px;
        }

        .navbar {
            background-color: #8b6b61;
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
        <h1>Admin Order System</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="cart-container">
                    <h2>Your Cart</h2>
                    <form id="orderForm">
                        <div id="cartItems"></div>
                        <div class="total-price">
                            Total: EGP <span id="totalPrice">0</span>
                        </div>
                        <div class="form-group room-selection">
                            <label for="room">Room Number:</label>
                            <select class="form-control" name="room" id="room">
                                <option disabled selected value="">Choose user room</option>
                                <?php foreach ($rooms as $room): ?>
                                    <option value="<?=$room ?>">
                                        <?=$room ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" id="confirmButton" class="btn btn-confirm btn-block">Confirm Order</button>
                        <div id="confirmationMessage" class="confirmation-message">
                            Order placed successfully!
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-9">
                <div class="form-group">
                    <label for="userSelect">Select User:</label>
                    <select class="form-control" id="userSelect">
                        <option disabled selected value="">Select a user</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo htmlspecialchars($user['id']); ?>" 
                                    data-room="<?php echo htmlspecialchars($user['room_no']); ?>">
                                <?php echo htmlspecialchars($user['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row" id="productsList">
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-6">
                            <div class="product-content product-wrap clearfix">
                                <div class="row">
                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                        <div class="product-image">
                                            <img src="../admin view/productpictures/<?php echo htmlspecialchars($product['picture']); ?>" 
                                                 alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                                 class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <div class="product-deatil">
                                            <h5 class="name">
                                                <?php echo htmlspecialchars($product['name']); ?>
                                            </h5>
                                            <p class="price-container">
                                                <span>EGP <?php echo htmlspecialchars($product['price']); ?></span>
                                            </p>
                                        </div>
                                        <div class="product-info smart-form">
                                            <div class="quantity-control">
                                                <button type="button" class="btn-decrease" 
                                                        data-product-id="<?php echo htmlspecialchars($product['id']); ?>">-</button>
                                                <span class="quantity" 
                                                      data-product-id="<?php echo htmlspecialchars($product['id']); ?>">0</span>
                                                <button type="button" class="btn-increase" 
                                                        data-product-id="<?php echo htmlspecialchars($product['id']); ?>">+</button>
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

    <script>
        const cart = {
            items: [],
            
            addItem(productId, name, price) {
                const existingItem = this.items.find(item => item.productId === productId);
                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    this.items.push({ productId, name, price, quantity: 1 });
                }
                this.updateUI();
            },
            
            removeItem(productId) {
                const index = this.items.findIndex(item => item.productId === productId);
                if (index > -1) {
                    const item = this.items[index];
                    if (item.quantity > 1) {
                        item.quantity--;
                    } else {
                        this.items.splice(index, 1);
                    }
                }
                this.updateUI();
            },
            
            clearCart() {
                this.items = [];
                this.updateUI();
            },
            
            updateUI() {
                const cartItemsContainer = document.getElementById('cartItems');
                cartItemsContainer.innerHTML = '';
                
                let totalPrice = 0;
                
                this.items.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    totalPrice += itemTotal;
                    
                    const itemElement = document.createElement('div');
                    itemElement.className = 'cart-item';
                    itemElement.innerHTML = `
                        <p>${item.name} (${item.quantity}) - EGP ${itemTotal.toFixed(2)}</p>
                        <span class="remove-item" data-product-id="${item.productId}">Remove</span>
                    `;
                    cartItemsContainer.appendChild(itemElement);
                });
                
                document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);
                
                this.items.forEach(item => {
                    const quantityDisplay = document.querySelector(`.quantity[data-product-id="${item.productId}"]`);
                    if (quantityDisplay) {
                        quantityDisplay.textContent = item.quantity;
                    }
                });
                
                document.querySelectorAll('.quantity').forEach(el => {
                    const productId = el.dataset.productId;
                    if (!this.items.some(item => item.productId === productId)) {
                        el.textContent = '0';
                    }
                });
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('btn-increase') || e.target.classList.contains('btn-decrease')) {
                    const productId = e.target.dataset.productId;
                    const productContainer = e.target.closest('.product-content');
                    const name = productContainer.querySelector('.name').textContent.trim();
                    const price = parseFloat(productContainer.querySelector('.price-container span').textContent.replace('EGP ', ''));
                    
                    if (e.target.classList.contains('btn-increase')) {
                        cart.addItem(productId, name, price);
                    } else {
                        cart.removeItem(productId);
                    }
                }
                
                if (e.target.classList.contains('remove-item')) {
                    const productId = e.target.dataset.productId;
                    cart.removeItem(productId);
                }
            });

            document.getElementById('orderForm').addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const userId = document.getElementById('userSelect').value;
                const roomNo = document.getElementById('room').value;
                
                
                try {
                    const response = await fetch('', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            userId,
                            roomNo,
                            items: cart.items
                        })
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        const confirmationMessage = document.getElementById('confirmationMessage');
                        confirmationMessage.style.display = 'block';
                        confirmationMessage.textContent = data.message;
                        
                        // Reset form and cart
                        cart.clearCart();
                        document.getElementById('orderForm').reset();
                        document.getElementById('userSelect').value = '';
                        
                        setTimeout(() => {
                            confirmationMessage.style.display = 'none';
                        }, 3000);
                    } else {
                        throw new Error(data.message);
                    }
                } catch (error) {
                    alert('Error submitting order: ' + error.message);
                }
            });

            // User selection
            document.getElementById('userSelect').addEventListener('change', function() {
                const roomNo = this.options[this.selectedIndex].dataset.room;
                if (roomNo) {
                    document.getElementById('room').value = roomNo;
                }
            });
        });
    </script>
</body>
</html>