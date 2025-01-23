<?php
require('../components/connect.php');
session_start();

// جلب الطلب بناءً على ID الطلب
$orderId = $_GET['id'];

// استعلام لجلب بيانات الطلب والمنتجات المرتبطة به
$query = "
    SELECT 
        od.id AS order_detail_id,
        p.id AS product_id,
        p.name AS product_name,
        od.quantity,
        od.price
    FROM 
        order_details od
    INNER JOIN products p ON od.product_id = p.id
    WHERE 
        od.order_id = :order_id;
";

$statement = $connect->prepare($query);
$statement->bindParam(':order_id', $orderId, PDO::PARAM_INT);
$statement->execute();
$orderDetails = $statement->fetchAll(PDO::FETCH_ASSOC);

// استعلام لجلب اسم المستخدم
$userQuery = "SELECT name FROM users WHERE id = (SELECT user_id FROM orders WHERE id = :order_id)";
$userStmt = $connect->prepare($userQuery);
$userStmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
$userStmt->execute();
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

// استعلام لجلب قائمة جميع المنتجات
$productQuery = "SELECT id, name, price FROM products";
$productStmt = $connect->prepare($productQuery);
$productStmt->execute();
$products = $productStmt->fetchAll(PDO::FETCH_ASSOC);

// إضافة منتج جديد
if (isset($_POST['add_product'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $productPrice = null;

    foreach ($products as $product) {
        if ($product['id'] == $productId) {
            $productPrice = $product['price'];
            break;
        }
    }

    if ($productPrice !== null) {
        $insertQuery = "
            INSERT INTO order_details (order_id, product_id, quantity, price)
            VALUES (:order_id, :product_id, :quantity, :price)
        ";
        $insertStmt = $connect->prepare($insertQuery);
        $insertStmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $insertStmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $insertStmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $insertStmt->bindParam(':price', $productPrice, PDO::PARAM_STR);
        $insertStmt->execute();
        header("Location: edit_order.php?id=$orderId");
        exit;
    }
}

// تعديل كمية منتج
if (isset($_POST['update_quantity'])) {
    $orderDetailId = $_POST['order_detail_id'];
    $quantity = $_POST['quantity'];
    $updateQuery = "UPDATE order_details SET quantity = :quantity WHERE id = :id";
    $updateStmt = $connect->prepare($updateQuery);
    $updateStmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $updateStmt->bindParam(':id', $orderDetailId, PDO::PARAM_INT);
    $updateStmt->execute();
    header("Location: edit_order.php?id=$orderId");
    exit;
}

// حذف منتج من الطلب
if (isset($_POST['delete_product'])) {
    $orderDetailId = $_POST['order_detail_id'];
    $deleteQuery = "DELETE FROM order_details WHERE id = :id";
    $deleteStmt = $connect->prepare($deleteQuery);
    $deleteStmt->bindParam(':id', $orderDetailId, PDO::PARAM_INT);
    $deleteStmt->execute();
    header("Location: edit_order.php?id=$orderId");
    exit;
}


$statuses = ['processing', 'delivered','shipped'];
if (isset($_POST['status'])){
    $status = $_POST['status'];
    $updateStatus = "update orders set status = ? where id = ?";
    $updateStmt = $connect->prepare($updateStatus);
    $updateStmt->execute([$status, $orderId]);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Merienda:wght@300..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome for icons -->
    <style>
        body {
            background-color: #f4f1e1;
            color: #5a3e36;
            font-family: "Outfit", serif;
        }
        .container {
            background-color: #d5bf9d;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2, h4 {
            color: #8b6b61;
        }
        .table th, .table td {
            text-align: center;
        }
        .btn-custom {
            background-color: #8b6b61;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #c79e83;
        }
        .btn-icon {
            background-color: #8b6b61;
            color: #fff;
            font-size: 18px;
        }
        .btn-icon:hover {
            background-color: #c79e83;
        }
        .btn:hover{
            color: white;
        }
        
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Order #<?php echo htmlspecialchars($orderId); ?> - <small>by <?php echo htmlspecialchars($user['name']); ?></small></h2>
    <hr>

    <!-- قائمة المنتجات المرتبطة بالطلب -->
    <h4>Order Details</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalPrice = 0;
            foreach ($orderDetails as $detail): 
                $totalPrice += $detail['quantity'] * $detail['price'];
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($detail['product_name']); ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="number" name="quantity" value="<?php echo htmlspecialchars($detail['quantity']); ?>" min="1" required>
                            <input type="hidden" name="order_detail_id" value="<?php echo htmlspecialchars($detail['order_detail_id']); ?>">
                            <button type="submit" name="update_quantity" class="btn btn-sm btn-icon"><i class="fas fa-sync-alt"></i> Update</button>
                        </form>
                    </td>
                    <td><?php echo htmlspecialchars($detail['quantity'] * $detail['price']); ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="order_detail_id" value="<?php echo htmlspecialchars($detail['order_detail_id']); ?>">
                            <button type="submit" name="delete_product" class="btn btn-sm btn-icon"><i class="fas fa-trash-alt"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- إضافة منتج جديد -->
    <h4>Add Product to Order</h4>
    <form method="POST" class="row g-3">
        <div class="col-md-6">
            <label for="product_id" class="form-label">Select Product</label>
            <select name="product_id" id="product_id" class="form-select">
                <option value="">Select a Product</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo htmlspecialchars($product['id']); ?>">
                        <?php echo htmlspecialchars($product['name']) . " - $" . htmlspecialchars($product['price']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1">
        </div>
        <div class="col-md-6">
        <label for="status" class="form-label">Select the status</label>
            <select name="status" id="status" class="myselect form-select">
                <option value="" disabled selected>Select the Status</option>
                <?php foreach ($statuses as $status ) :?>
                <option value="<?=$status?>"><?=$status?></option>
                <?php endforeach ?>
                </select>
            </div>
        <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" name="add_product" class="btn btn-custom w-100"><i class="fas fa-plus-circle"></i> Add</button>
        </div>
    </form>

    <!-- عرض الإجمالي -->
    <hr>
    <div class="row">
        <div class="col-md-6">
            <h4>Total Price: $<?php echo number_format($totalPrice, 2); ?></h4>
        </div>
    </div>
    <div class="mt-4">
        <a href="view_order.php" class="btn btn-custom">
            <i class="fas fa-arrow-left"></i> Back to View Orders
        </a>
    </div>
</div>
</body>
</html>
