<?php

require('../components/connect.php');
require('../components/session.php');

// if(isset($_SESSION['user_id'])){
//    $user_id = $_SESSION['user_id'];
// }else{
//    $user_id = '';
//    header('location:userHome.php');
// };

if (!isset($_SESSION['user_id'])) {
   header('location: ../login.php');
   exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

$select = "select * from orders where user_id= ? order by date desc";
$statment = $connect->prepare($select);
$statment->execute([$user_id]);
$myuser = $statment->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
   <!-- font awesome cdn link  -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
   <!-- custom css file link  -->
   <style>
      .nav-item {
         font-family: "Outfit", serif;
         font-weight: 700;
         padding: 0px 40px;
      }
   </style>
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <!-- header section starts  -->
   <?php require '../partials/usernav.php'; ?>
   <!-- header section ends -->

   <div class="heading">
      <h3>orders</h3>
      <p><a href="userHome.php">home</a> <span> / orders</span></p>
   </div>

   <section class="orders">

      <h1 class="title">your orders</h1>

      <div class="box-container">

         <?php
         // if($user_id == ''){
         //    echo '<p class="empty">please login to see your orders</p>';
         // }else{
         $myquery = "SELECT * FROM orders, products as p WHERE user_id = ? and p.id = product_id";
         $select_orders = $connect->prepare($myquery);
         $select_orders->execute([$user_id]);
         if ($select_orders->rowCount() > 0) {
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">
                  <p>placed on : <span><?= $fetch_orders['date']; ?></span></p>
                  <p>name : <span><?= $user_name; ?></span></p>
                  <p>your orders : <span><?= $fetch_orders['name']; ?></span></p>
                  <p>total price : <span>$<?= $fetch_orders['price'] * $fetch_orders['quantity']; ?> </span></p>
            <?php
            }
         } else {
            echo '<p class="empty">no orders placed yet!</p>';
         }
         // }
            ?>

               </div>

   </section>










   <!-- footer section starts  -->

   <!-- footer section ends -->






   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>