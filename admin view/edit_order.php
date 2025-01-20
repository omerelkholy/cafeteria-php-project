<?php
require('../components/connect.php');

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    $query = "
        SELECT 
            orders.id,
            users.name AS user_name,
            products.name AS product_name,
            orders.status,
            orders.quantity,
            orders.price,
            orders.product_id
        FROM orders
        JOIN users ON orders.user_id = users.id
        JOIN products ON orders.product_id = products.id
        WHERE orders.id = :id;
    ";

    $statement = $connect->prepare($query);
    $statement->execute(['id' => $orderId]);
    $order = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        die("Order not found");
    }

    $productQuery = "SELECT id, name FROM products";
    $productStatement = $connect->prepare($productQuery);
    $productStatement->execute();
    $products = $productStatement->fetchAll(PDO::FETCH_ASSOC);
} else {
    die("Invalid Request");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $productId = $_POST['product_id'];

    $updateQuery = "UPDATE orders SET quantity = :quantity, price = :price, status = :status, product_id = :product_id WHERE id = :id";
    $updateStmt = $connect->prepare($updateQuery);
    $params = [
        'quantity' => $quantity,
        'price' => $price,
        'status' => $status,
        'product_id' => $productId,
        'id' => $orderId
    ];

    $updateStmt->execute($params);

    header("Location: view_order.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5dc;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            padding-top: 20px;
        }

        .content {
            width: 100%;
            max-width: 800px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #6b4f4f;
            margin-bottom: 15px;
        }

        .form-label {
            color: #6b4f4f;
        }

        .form-control,
        .form-select {
            border-radius: 50px;
            transition: border-color 0.3s, box-shadow 0.3s;
            border-color: #ccc;
            font-size: 1rem;
        }

        .form-control:hover,
        .form-select:hover {
            border-color: #8b6b61;
            box-shadow: 0 0 5px rgba(139, 107, 97, 0.5);
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 5px rgba(139, 107, 97, 0.5);
        }

        .btn-primary {
            background-color: #6b4f4f;
            border: none;
        }

        .btn-primary:hover {
            background-color: #a38181;
        }

        .btn {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="content">
        <h2 class="section-title">Edit Order</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="user_name" class="form-label">User Name</label>
                <input type="text" class="form-control" id="user_name" value="<?= htmlspecialchars($order['user_name'] ?? '') ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <select class="form-select" id="product_id" name="product_id" required>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= $product['id'] ?>" <?= $product['id'] == $order['product_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($product['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?= htmlspecialchars($order['quantity'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="<?= htmlspecialchars($order['price'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="processing" <?= $order['status'] == 'processing' ? 'selected' : '' ?>>Processing</option>
                    <option value="out for delivery" <?= $order['status'] == 'out for delivery' ? 'selected' : '' ?>>Out for Delivery</option>
                    <option value="done" <?= $order['status'] == 'done' ? 'selected' : '' ?>>Done</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="view_order.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

</body>

</html>
