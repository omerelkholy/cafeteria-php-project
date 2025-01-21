 <?php
require('../components/connect.php');






$totalUsers = "SELECT COUNT(*) as total FROM users";
$statement = $connect->prepare($totalUsers);
$statement->execute();
$resultUser = $statement->fetchAll(PDO::FETCH_ASSOC);



$totalOrders = "SELECT COUNT(*) as total FROM orders";
$statement = $connect->prepare($totalOrders);
$statement->execute();
$resultOrder = $statement->fetchAll(PDO::FETCH_ASSOC);


$totalProducts = "SELECT COUNT(*) as total FROM products";
$statement = $connect->prepare($totalProducts);
$statement->execute();
$resultProduct = $statement->fetchAll(PDO::FETCH_ASSOC);
// $conn->close();
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f5f5dc;
            padding: 20px;
        }

        .container{
            margin-left: 250px;
        }
        .stat-card {
            background: linear-gradient(145deg, #f8f8f8, #e0e0e0);
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            padding: 20px;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .stat-card h3 {
            color: #555;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .stat-card p {
            font-size: 32px;
            font-weight: bold;
            color: #8b6b61;
            margin: 0;
        }


        h1 {
            color: #8b6b61;
            font-size: 32px;
            text-align: center;
            margin-bottom: 40px;
        }


        .row {
            gap: 20px;
        }
    </style>
</head>

<body>
<?php require('sidebar.inc.php'); ?>
    <div class="container">

        <h1>Welcome to the Dashboard</h1>

        <div class="row">

            <div class="col-md-3">
                <div class="card stat-card text-center">
                    <h3>Total Users</h3>
                    <p>
                    <?= $resultUser[0]['total'] ?? 0; ?> 
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card text-center">
                    <h3>Total Orders</h3>
                    <p>
                    <?= $resultOrder[0]['total'] ?? 0; ?> 
                    </p>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card stat-card text-center">
                    <h3>Total Products</h3>
                    <p>
                    <?= $resultProduct[0]['total'] ?? 0; ?> 
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>