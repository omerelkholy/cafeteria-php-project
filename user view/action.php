<?php
session_start();
require '../components/connect.php'; 

if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pimage = $_POST['pimage'];
    $pqty = $_POST['pqty'];
    $total_price = $pprice * $pqty;

    $stmt = $connect->prepare('SELECT id FROM cart WHERE product_id = ?');
    $stmt->execute([$pid]);
    $product_id = $stmt->fetchColumn();

    if (!$product_id) {
        
        $query = $connect->prepare('INSERT INTO cart (product_id, product_name, product_price, product_image, qty, total_price) VALUES (?, ?, ?, ?, ?, ?)');
        $query->execute([$pid, $pname, $pprice, $pimage, $pqty, $total_price]);

        echo '<div class="alert alert-success alert-dismissible mt-2">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Item added to your cart!</strong>
              </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible mt-2">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Item already added to your cart!</strong>
              </div>';
    }
}

if (isset($_GET['cartItem']) && $_GET['cartItem'] == 'cart_item') {
    $stmt = $connect->query('SELECT * FROM cart');
    $rows = $stmt->rowCount();
    echo $rows;
}

if (isset($_GET['remove'])) {
    $id = $_GET['remove'];

    $stmt = $connect->prepare('DELETE FROM cart WHERE id = ?');
    $stmt->execute([$id]);

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Item removed from the cart!';
    header('location:cart.php');
}

if (isset($_GET['clear'])) {
    $stmt = $connect->prepare('DELETE FROM cart');
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'All items removed from the cart!';
    header('location:cart.php');
}

if (isset($_POST['qty'])) {
    $qty = $_POST['qty'];
    $pid = $_POST['pid'];
    $pprice = $_POST['pprice'];
    $tprice = $qty * $pprice;
    $stmt = $connect->prepare('UPDATE cart SET qty = ?, total_price = ? WHERE product_id = ?');
    $stmt->execute([$qty, $tprice, $pid]);
}



if (isset($_POST['action']) && $_POST['action'] == 'order') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $products = $_POST['products']; 
    $grand_total = $_POST['grand_total'];
    $room_no = $_POST['room_no'];

  
    $stmt = $connect->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user_id = $stmt->fetchColumn();

    if (!$user_id) {

        $stmt = $connect->prepare('INSERT INTO users (name, email, room_no) VALUES (?, ?, ?)');
        $stmt->execute([$name, $email, $room_no]);
        $user_id = $connect->lastInsertId(); 
    }


    $stmt = $connect->prepare('INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, ?)');
    $stmt->execute([$user_id, $grand_total, 'processing']);
    $order_id = $connect->lastInsertId(); 

    $stmt = $connect->prepare('SELECT product_id, qty, total_price FROM cart');
    $stmt->execute();
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($cart_items as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['qty'];
        $price = $item['total_price'];

        $stmt = $connect->prepare('INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)');
        $stmt->execute([$order_id, $product_id, $quantity, $price]);
    }

    $stmt = $connect->prepare('DELETE FROM cart');
    $stmt->execute();

    echo '<div class="text-center">
              <h1 class="display-4 mt-2 text-dark">Thank You!</h1>
              <h2 class="text-success">Your Order Placed Successfully!</h2>
              <h4 class="bg-danger text-light rounded p-2">Items Purchased: ' . htmlspecialchars($products) . '</h4>
              <h4>Your Name: ' . htmlspecialchars($name) . '</h4>
              <h4>Your E-mail: ' . htmlspecialchars($email) . '</h4>
              <h4>Total Amount Paid: ' . number_format($grand_total, 2) . '</h4>
          </div>';
}
?>