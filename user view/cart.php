<?php

require('../components/connect.php');
require('../components/session.php');



if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:userHome.php');
   exit();
}
if (isset($_POST['delete'])) {
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $connect->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
   $message[] = 'Cart item deleted!';
}

if (isset($_POST['delete_all'])) {
   $delete_cart_item = $connect->prepare("DELETE FROM `orders` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   $message[] = 'Deleted all items from cart!';
}

if (isset($_POST['update_qty'])) {
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $connect->prepare("UPDATE `orders` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'Cart quantity updated!';
}

$grand_total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      body {
         background: url('img/bg.png');
         font-family: "Outfit", serif;
      }

      .cart-container {
         max-width: 1200px;
         margin: 50px auto;
         padding: 30px;
         background-color: #fff;
         box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
         border-radius: 15px;
      }

      .cart-item {
         margin-bottom: 20px;
         padding: 15px;
         border: 1px solid #ddd;
         border-radius: 10px;
         background-color: #fff;
         transition: transform 0.2s ease, box-shadow 0.2s ease;
      }

      .cart-item:hover {
         transform: translateY(-5px);
         box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
      }

      .cart-item img {
         width: 100px;
         height: 100px;
         border-radius: 10px;
         object-fit: cover;
      }

      .quantity-controls button {
         background-color: #8b6b61;
         color: white;
         border: none;
         padding: 8px 12px;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s ease;
      }

      .quantity-controls button:hover {
         background-color: #9c6840;
      }

      .checkout-btn {
         width: 100%;
         padding: 15px;
         background-color: #8b6b61;
         color: white;
         border: none;
         border-radius: 10px;
         cursor: pointer;
         font-size: 1.3rem;
         font-weight: 600;
         transition: background-color 0.3s ease;
      }

      .checkout-btn:hover {
         background-color: #9c6840;
      }

      .empty-cart-message {
         text-align: center;
         font-size: 1.5rem;
         color: #666;
         padding: 50px 0;
      }
   </style>
</head>

<body>

   <!-- Header Section -->


   <!-- Banner Section -->
   <header class="banner">
      <div class="container">
         <div class="content-banner text-center text-md-start">
            <p class="text-primary fs-6 fw-medium mb-3">Shopping Cart</p>
            <h1 class="text-white display-4 fw-medium mb-4">
               Your Cart
            </h1>
            <p><a href="userHome.php">Home</a> <span> / Cart</span></p>
         </div>
      </div>
   </header>

   <!-- Cart Section -->
   <section class="cart py-5">
      <div class="cart-container">
         <h1 class="title text-center mb-5">Your Cart</h1>

         <div class="cart-items">
            <?php
            $grand_total = 0;
            $select_cart = $connect->prepare("SELECT * FROM `orders` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if ($select_cart->rowCount() > 0) {
               while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                  $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                  $grand_total += $sub_total;
            ?>
                  <div class="cart-item">
                     <form action="" method="post">
                        <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                           <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye text-primary"></a>
                           <button type="submit" class="fas fa-times text-danger bg-transparent border-0" name="delete" onclick="return confirm('Delete this item?');"></button>
                        </div>
                        <div class="d-flex align-items-center">
                           <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="<?= $fetch_cart['name']; ?>" class="me-4">
                           <div class="flex-grow-1">
                              <h3 class="h5 mb-2"><?= $fetch_cart['name']; ?></h3>
                              <div class="d-flex justify-content-between align-items-center">
                                 <p class="price mb-0">
                                    <span class="text-primary fw-bold">$<?= $fetch_cart['price']; ?></span>
                                 </p>
                                 <div class="quantity-controls d-flex align-items-center">
                                    <input type="number" name="qty" class="form-control me-2" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
                                    <button type="submit" class="fas fa-edit text-primary bg-transparent border-0" name="update_qty"></button>
                                 </div>
                              </div>
                              <div class="sub-total mt-2">
                                 Subtotal: <span class="text-primary fw-bold">$<?= $sub_total; ?></span>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
            <?php
               }
            } else {
               echo '<p class="empty-cart-message">Your cart is empty.</p>';
            }
            ?>
         </div>

         <!-- Cart Total and Actions -->
         <div class="cart-total text-center mt-5">
            <p class="fs-4">Cart Total: <span class="text-primary fw-bold">$<?= $grand_total; ?></span></p>
            <a href="checkout.php" class="checkout-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
         </div>

         <div class="more-btn text-center mt-4">
            <form action="" method="post">
               <button type="submit" class="btn btn-danger <?= ($grand_total > 1) ? '' : 'disabled'; ?>" name="delete_all" onclick="return confirm('Delete all items from cart?');">Delete All</button>
            </form>
            <a href="menu.php" class="btn btn-outline-primary mt-3">Continue Shopping</a>
         </div>
      </div>
   </section>

   <!-- Footer Section -->


   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

   <!-- Custom JS -->
   <script src="js/script.js"></script>
</body>

</html>