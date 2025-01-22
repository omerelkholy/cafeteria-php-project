<?php

require('../components/connect.php');

// Corrected SQL query
$query = "
    SELECT 
        orders.id AS order_id,
        users.name AS user_name,
        orders.total_amount,
        orders.status,
        orders.order_date AS date,
        GROUP_CONCAT(products.name SEPARATOR ', ') AS product_names,
        SUM(order_details.quantity) AS total_quantity
    FROM orders
    JOIN users ON orders.user_id = users.id
    JOIN order_details ON orders.id = order_details.order_id
    JOIN products ON order_details.product_id = products.id
    GROUP BY orders.id
    ORDER BY orders.order_date DESC;
";

$statement = $connect->prepare($query);
$statement->execute();
$orders = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            font-family: "Outfit", serif;
        }
        body {
            background-color: #f5f5dc;
            display: flex;
            height: 100vh;
            overflow-x: hidden;
        }

        .content {
            padding: 40px 20px 20px;
            width: 100%;
            background-color: #f5f5dc;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #8b6b61;
            color: #fff;
        }

        tbody tr:nth-child(odd) {
            background-color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f6f4;
        }

        tbody td,
        thead th {
            padding: 10px;
            text-align: center;
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

        .status.processing {
            color: #d2a679;
        }

        .status.completed {
            color: green;
        }

        .status.deleted {
            color: red;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="section">
            <h2 class="section-title">Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Product Names</th>
                        <th>Total Quantity</th>
                        <th>Total Amount</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                            <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($order['product_names']); ?></td>
                            <td><?php echo htmlspecialchars($order['total_quantity']); ?></td>
                            <td><?php echo htmlspecialchars($order['total_amount']) . " EGP"; ?></td>
                            <td><?php echo htmlspecialchars($order['date']); ?></td>
                            <td class="status <?php echo htmlspecialchars($order['status']); ?>">
                                <i class="bi bi-arrow-repeat"></i> 
                                <?php echo ucfirst($order['status']); ?>
                            </td>
                            <td class="action-icons">
                                <i class="bi bi-trash" title="Delete"></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>