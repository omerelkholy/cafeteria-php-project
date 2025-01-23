<?php
require('../components/connect.php');
session_start();

if (!isset($_GET['id'])) {
    echo "Order ID not provided.";
    exit;
}

$orderId = $_GET['id'];

$query = "
    SELECT 
        orders.id AS order_id,
        users.name AS user_name,
        products.name AS product_name,
        order_details.quantity,
        order_details.price,
        orders.order_date,
        orders.status
    FROM order_details
    INNER JOIN orders ON order_details.order_id = orders.id
    INNER JOIN products ON order_details.product_id = products.id
    INNER JOIN users ON orders.user_id = users.id
    WHERE orders.id = :order_id
";

$statement = $connect->prepare($query);
$statement->bindParam(':order_id', $orderId, PDO::PARAM_INT);
$statement->execute();
$orderDetails = $statement->fetchAll(PDO::FETCH_ASSOC);

$totalPrice = 0;
foreach ($orderDetails as $detail) {
    $totalPrice += $detail['quantity'] * $detail['price'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Merienda:wght@300..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5dc;
            font-family: "Outfit", serif;
            padding: 20px;
        }

        .order-info {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .order-info strong {
            color: #8b6b61;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        td,
        th {
            padding: 10px;
            text-align: center;
        }

        .total-price {
            font-size: 20px;
            font-weight: bold;
            color: #8b6b61;
            margin-top: 20px;
        }

        .status-badge {
            font-weight: bold;
        }

        .status-processing {
            background-color: #f0ad4e;
            color: white;
        }

        .status-shipped {
            background-color: #28a745;
            color: white;
        }

        .status-delivered {
            background-color: #5bc0de;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center">Order Details</h2>

        <div class="order-info">
            <p><strong>Order ID:</strong> <?php echo htmlspecialchars($orderDetails[0]['order_id']); ?></p>
            <p><strong>User Name:</strong> <?php echo htmlspecialchars($orderDetails[0]['user_name']); ?></p>
            <p><strong>Date:</strong> <?php echo htmlspecialchars($orderDetails[0]['order_date']); ?></p>
            <p><strong>Status:</strong>
                <?php
                $status = $orderDetails[0]['status'];
                $statusClass = "";
                switch ($status) {
                    case "processing":
                        $statusClass = "status-processing";
                        break;
                    case "shipped":
                        $statusClass = "status-shipped";
                        break;
                    case "delivered":
                        $statusClass = "status-delivered";
                        break;
                    default:
                        $statusClass = "status-processing";
                }
                echo "<span class='badge status-badge " . $statusClass . "'>" . ucfirst($status) . "</span>";
                ?>
            </p>
        </div>

        <table class="order-table table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderDetails as $detail): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detail['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($detail['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($detail['price']); ?> EGP</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total-price">
            <p><strong>Total Price:</strong> <?php echo number_format($totalPrice, 2); ?> EGP</p>
        </div>
    </div>

</body>

</html>