<?php
$current_dir = dirname(__FILE__);
$project_root = dirname($current_dir);
require_once $project_root . '/components/session.php';


if (!isset($_SESSION['user_id'])) {
    header('location:../login.php');
    exit();
}

$user_name = $_SESSION['user_name'];
$user_pic = $_SESSION['user_pic'];

?>


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

    .btn1 {
        margin-top: 50px
    }

    .admin_pic{
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }



    p{
        color: white;
        text-align: center;
        padding: 0px 20px;
        font-size: 20px;
    }
</style>


<!-- Sidebar -->
<div class="sidebar">
    <p> <?= $user_name; ?>
    <img class="admin_pic" src="../userpictures/<?= $user_pic; ?>" alt=""></p>
    <a href="../admin view/dashboard.php">Dashboard</a>
    <a href="../admin view/view_user.php">All Users</a>
    <a href="../admin view/view_checks.php">View Checks</a>
    <a href="../admin view/view_order.php">View Orders</a>
    <a href="../admin view/view_product.php">View Products</a>
    <a href="../admin view/admin_order.php">Order for User</a>
    <a href="../logout.php" class="btn1">
        <i class="fas fa-sign-out-alt me-2"></i>Logout
    </a>
</div>