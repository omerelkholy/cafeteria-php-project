<?php
require('../components/connect.php');
require('../components/session.php');

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
   header('location: ../login.php');
   exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Fetch orders for the logged-in user
$select_orders = $connect->prepare('
    SELECT o.id AS order_id, o.total_amount, o.status, o.order_date,
           od.product_id, od.quantity, od.price,
           p.name AS product_name
    FROM orders o
    JOIN order_details od ON o.id = od.order_id
    JOIN products p ON od.product_id = p.id
    WHERE o.user_id = ?
    ORDER BY o.order_date DESC
');
$select_orders->execute([$user_id]);
$orders = $select_orders->fetchAll(PDO::FETCH_ASSOC);

// Group order details by order ID
$grouped_orders = [];
foreach ($orders as $order) {
    $order_id = $order['order_id'];
    if (!isset($grouped_orders[$order_id])) {
        $grouped_orders[$order_id] = [
            'order_id' => $order['order_id'],
            'total_amount' => $order['total_amount'],
            'status' => $order['status'],
            'order_date' => $order['order_date'],
            'products' => []
        ];
    }
    $grouped_orders[$order_id]['products'][] = [
        'product_name' => $order['product_name'],
        'quantity' => $order['quantity'],
        'price' => $order['price']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Font Awesome -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
   <!-- Custom CSS -->
   <link href="css/style.min.css" rel="stylesheet">
   <link href="css/product.css" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
   <link href="img/fav.ico" rel="icon">
   <style>
      .nav-item {
         font-family: "Outfit", serif;
         font-weight: 700;
         padding: 0px 40px;
      }

      .table thead th {
         background-color: #8b6b61;
         color: #fff;
      }

      .table tbody tr:nth-child(odd) {
         background-color: #fff;
      }

      .table tbody tr:nth-child(even) {
         background-color: #f9f6f4;
      }

      .status.processing {
         color: #d2a679;
      }

      .status.completed {
         color: green;
      }

      .status.cancelled {
         color: red;
      }

      /* Center the content */
      .center-content {
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         text-align: center;
      }

      .center-table {
         width: 80%;
         margin: 0 auto;
      }
   </style>
</head>

<body>

   <!-- Header Section -->
   <?php require '../partials/usernav.php'; ?>

   <!-- Banner Section -->
   <header class="banner">
      <div class="container">
         <div class="content-banner text-center text-md-start">
            <h1 class="text-white display-4 fw-medium mb-4">
               Saw Your <br />Coffee Orders
            </h1>
         </div>
      </div>
   </header>

   <!-- Orders Section -->
   <section class="orders container mt-4 center-content">
      <h1 class="title mb-4">Your Orders</h1>

      <?php if (empty($grouped_orders)): ?>
         <p class="empty">No orders placed yet!</p>
      <?php else: ?>
         <div class="table-responsive center-table">
            <table class="table table-bordered table-hover">
               <thead>
                  <tr>
                     <th>Order ID</th>
                     <th>Placed On</th>
                     <th>Status</th>
                     <th>Total Amount</th>
                     <th>Products</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($grouped_orders as $order): ?>
                     <tr>
                        <td><?= htmlspecialchars($order['order_id']); ?></td>
                        <td><?= htmlspecialchars($order['order_date']); ?></td>
                        <td class="status <?= htmlspecialchars($order['status']); ?>">
                           <i class="bi bi-arrow-repeat"></i> 
                           <?= ucfirst($order['status']); ?>
                        </td>
                        <td>$<?= number_format($order['total_amount'], 2); ?></td>
                        <td>
                           <ul class="list-unstyled">
                              <?php foreach ($order['products'] as $product): ?>
                                 <li>
                                    <?= htmlspecialchars($product['product_name']); ?> -
                                    Quantity: <?= htmlspecialchars($product['quantity']); ?> -
                                    Price: $<?= number_format($product['price'], 2); ?>
                                 </li>
                              <?php endforeach; ?>
                           </ul>
                        </td>
                     </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
      <?php endif; ?>
   </section>

   <!-- Footer Section -->
   <?php require '../partials/footer.php'; ?>

   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
   <!-- Custom JS File Link -->
   <script src="js/script.js"></script>
</body>

</html>