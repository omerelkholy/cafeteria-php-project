

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

    .btn1{
        margin-top: 80px
    }
</style>


<!-- Sidebar -->
<div class="sidebar">
    <a href="../admin view/dashboard.php">Dashboard</a>
    <a href="../admin view/view_user.php">All Users</a>
    <a href="../admin view/view_checks.php">View Checks</a>
    <a href="../admin view/view_order.php">View Orders</a>
    <a href="../admin view/view_product.php">View Products</a>
    <a href="../admin view/admin_order.php">Order for User</a>
    <a href="../login.php" class="btn1">
        <i class="fas fa-sign-out-alt me-2"></i>Logout
    </a>
</div>