<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sidebar edit</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
      
        body {
            background-color: #f5f5dc;
        }

        .sidebar {
            position: fixed;
            top: 20px;
            bottom: 20px;
            left: 9px;
            width: 250px;
            background: linear-gradient(145deg, #6b4f4f, #8b6b61);
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .sidebar:hover {
            transform: scale(1.02);
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 15px;
            text-decoration: none;
            font-size: 1.1rem;
            margin-bottom: 10px;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(10px);
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .btn1 {
            margin-top: 80px;
        }
    </style>
</head>
<body>
    
    <div class="sidebar">
        <a href="../admin view/dashboard.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
        <a href="../admin view/view_user.php"><i class="fas fa-users"></i>All Users</a>
        <a href="../admin view/view_checks.php"><i class="fas fa-receipt"></i>View Checks</a>
        <a href="../admin view/view_order.php"><i class="fas fa-shopping-cart"></i>View Orders</a>
        <a href="../admin view/view_product.php"><i class="fas fa-box-open"></i>View Products</a>
        <a href="../admin view/order_for_user.php"><i class="fas fa-user-plus"></i>Order for User</a>
        <a href="../login.php" class="btn1">
            <i class="fas fa-sign-out-alt"></i>Logout
        </a>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>