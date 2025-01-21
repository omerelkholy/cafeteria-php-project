<?php
require('../components/connect.php');
session_start();

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    $query = "
        SELECT 
            orders.id,
            users.name AS user_name,
            products.name AS product_name,
            orders.status,
            orders.quantity,
            orders.date,
            orders.price
        FROM orders
        JOIN users ON orders.user_id = users.id
        JOIN products ON orders.product_id = products.id
        WHERE orders.id = :id
    ";

    $statement = $connect->prepare($query);
    $statement->bindParam(':id', $orderId, PDO::PARAM_INT);
    $statement->execute();

    $order = $statement->fetch(PDO::FETCH_ASSOC);
    if (!$order) {
        echo "Order not found.";
        exit;
    }
} else {
    echo "No order ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5dc;
        }

        .content {
            padding: 40px;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .section {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #6b4f4f;
            margin-bottom: 20px;
        }

        .table th, .table td {
            text-align: left;
            padding: 12px;
            color: #6b4f4f;
        }

        .table th {
            background-color: #8b6b61;
            color: white;
        }

        .table td {
            background-color: #f9f6f4;
        }

        .btn-secondary {
            background-color: #8b6b61;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #a38181;
        }

        .status {
            font-weight: bold;
        }

        .status.processing {
            color: #d2a679;
        }

        .status.out-for-delivery {
            color: #f0ad4e;
        }

        .status.done {
            color: green;
        }
    </style>
</head>

<body>

    <div class="content">
        <div class="section">
            <h2 class="section-title">Order Details</h2>
            <table class="table table-striped">
            <tr>
    <th style="color: #f9f6f4;">User Name</th>
    <td><?php echo htmlspecialchars($order['user_name']); ?></td>
</tr>
<tr>
    <th>Product Name</th>
    <td><?php echo htmlspecialchars($order['product_name']); ?></td>
</tr>
<tr>
    <th style="color: #f9f6f4;">Quantity</th>
    <td><?php echo htmlspecialchars($order['quantity']); ?></td>
</tr>
<tr>
    <th>Price</th>
    <td><?php echo htmlspecialchars($order['price']) . " EGP"; ?></td>
</tr>
<tr>
    <th style="color: #f9f6f4;">Date</th>
    <td><?php echo htmlspecialchars($order['date']); ?></td>
</tr>
<tr>
    <th>Status</th>
    <td class="status <?php echo htmlspecialchars($order['status']); ?>">
        <?php 
            if ($order['status'] == 'processing') {
                echo 'Processing';
            } elseif ($order['status'] == 'out for delivery') {
                echo 'Out for Delivery';
            } elseif ($order['status'] == 'done') {
                echo 'Done';
            }
        ?>
    </td>
</tr>

            </table>
            <a href="view_checks.php" class="btn btn-secondary">Back to Orders</a>
        </div>
    </div>

</body>

</html>
