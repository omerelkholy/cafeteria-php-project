<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side_Bar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f5f5dc; 
        }
        .navbar-custom {
            background-color: #8b6b61;
        }
        .sidebar {
            position: fixed;
            top: 20px; 
            bottom: 20px; 
            left: 9px;
            height: auto;
            width: 250px;
            background-color: #6b4f4f;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
            font-size: 1.1rem;
            margin-bottom: 10px;
            border-radius: 5px;
            text-align: center; 
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #d2a679;
            color: white; 
        }

       
        .sidebar a:first-child {
            margin-top: 20px; 
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="view_user.php">All Users</a>
        <a href="view_checks.php">View Checks</a>
        <a href="view_order.php">View Orders</a>
        <a href="add_product.php">Add Product</a>
        <a href="order_for_user.php">Order for User</a>
    </div>

</body>
</html>
