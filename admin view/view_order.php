<?php
require('../components/connect.php');
session_start();


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
    where status in( 'processing' ,'out for delivery')
    ORDER BY orders.date DESC;
";

$statement = $connect->prepare($query);
$statement->execute();
$orders = $statement->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['delete_order_id'])) {
    
    $orderId = $_POST['delete_order_id'];

    $deleteQuery = "DELETE FROM orders WHERE id = :id";
    $deleteStmt = $connect->prepare($deleteQuery);
    $deleteStmt->bindParam(':id', $orderId, PDO::PARAM_INT);
    
    
    if ($deleteStmt->execute()) {
        echo 'success'; 
    } else {
        echo 'error'; 
    }
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Merienda:wght@300..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
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
        .navbar-custom {
            background-color: #8b6b61;
        }

        .content {
            padding: 40px 20px 20px;
            width: 100%;
            background-color: #f5f5dc;
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

        .status.out-of-delivery {
            color: #f0ad4e;
        }

        .status.deleted {
            color: red;
        }

        .edit-icon {
            text-decoration: none;
            color: inherit;
            cursor: pointer;
            margin-right: 10px;
            font-size: 1.2rem;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .edit-icon:hover {
            color: brown;
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <?php require('sidebar.inc.php'); ?>

    <div class="content">
        <div class="section">
            <h2 class="section-title">Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr data-order-id="<?php echo htmlspecialchars($order['id']); ?>">
                            <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($order['price']) . " EGP"; ?></td>
                            <td><?php echo htmlspecialchars($order['date']); ?></td>
                            <td class="status <?php echo htmlspecialchars($order['status']); ?>">
                                <?php 
                                    if ($order['status'] == 'processing') {
                                        echo '<i class="bi bi-arrow-repeat"></i> Processing';
                                    } elseif ($order['status'] == 'out for delivery') {
                                        echo '<i class="bi bi-truck"></i> Out of Delivery';
                                    } elseif ($order['status'] == 'done') {
                                        echo '<i class="bi bi-check-circle"></i> Done';
                                    }
                                ?>
                            </td>
                            <td class="action-icons">
                                <a href="edit_order.php?id=<?php echo htmlspecialchars($order['id']); ?>" class="edit-icon bi bi-pencil-square" title="Edit"></a>
                                <a href="javascript:void(0);" class="edit-icon bi bi-trash" title="Delete" onclick="deleteOrder(<?php echo htmlspecialchars($order['id']); ?>)"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function deleteOrder(orderId) {
            if (confirm('Are you sure you want to delete this order?')) {
              
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '', true);  
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        
                        const row = document.querySelector(`tr[data-order-id='${orderId}']`);
                        if (row) {
                            row.remove();
                        }
                    } else {
                        alert('Error deleting order!');
                    }
                };
                xhr.send('delete_order_id=' + orderId); 
            }
        }
    </script>
</body>
</html>