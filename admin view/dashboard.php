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
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <style>
         * {
             font-family: "Outfit", serif;
         }

         body {
             background-color: #f5f5dc;
         }

         .row {
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
     </style>
 </head>

 <body>
     <?php require('sidebar.inc.php'); ?>
     <h1>Welcome to Dashboard</h1>
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-4">
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