<?php
require('../components/connect.php');

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

   
    $query = "SELECT * FROM products WHERE id = :id";
    $statement = $connect->prepare($query);
    $statement->execute(['id' => $productId]);
    $product = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Product not found");
    }
} else {
    die("Invalid Request");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $picture = $_FILES['picture'];

     $imageName = $product['picture'];
     $picture = $product['picture'];
     if (isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
         $imageName = $_FILES['picture']['name'];
         $imageTmpName = $_FILES['picture']['tmp_name'];
         $imagePath = 'productpictures/' . $imageName; 
         move_uploaded_file($imageTmpName, $imagePath);
         $picture = $imagePath; 
     }

  
    $updateQuery = "UPDATE products SET name = :product_name, price = :price, category = :category, picture = :picture WHERE id = :id";
    $updateStmt = $connect->prepare($updateQuery);
    $params = [
        'product_name' => $productName,
        'price' => $price,
        'category' => $category,
        'picture' => $imageName,
        'id' => $productId
    ];

    $updateStmt->execute($params);

    header("Location: view_product.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Product</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f5dc;
      font-family: "Outfit", serif;
      display: flex;
      justify-content: center;
      padding-top: 20px;
    }

    .content {
      width: 100%;
      max-width: 800px;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .section-title {
      font-size: 1.5rem;
      font-weight: bold;
      color: #6b4f4f;
      margin-bottom: 15px;
    }

    .form-label {
      color: #6b4f4f;
    }

    .form-control {
      border-radius: 50px;
      transition: border-color 0.3s, box-shadow 0.3s;
      border-color: #ccc;
    }

    .form-control:hover {
      border-color: #8b6b61;
      box-shadow: 0 0 5px rgba(139, 107, 97, 0.5);
    }

    .form-control:focus {
      box-shadow: 0 0 5px rgba(139, 107, 97, 0.5);
    }

    .btn-primary {
      background-color: #6b4f4f;
      border: none;
    }

    .btn-primary:hover {
      background-color: #a38181;
    }
  </style>
</head>
<body>
  <div class="content">
    <h2 class="section-title">Edit Product</h2>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="product_name" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="product_name" name="product_name" value="<?= htmlspecialchars($product['name']) ?>" required>
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
      </div>

      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-control" id="category" name="category" required>
          <option value="hot_drinks" <?= $product['category'] == 'hot_drinks' ? 'selected' : '' ?>>Hot Drinks</option>
          <option value="cold_drinks" <?= $product['category'] == 'cold_drinks' ? 'selected' : '' ?>>Cold Drinks</option>
          <option value="desserts" <?= $product['category'] == 'desserts' ? 'selected' : '' ?>>Desserts</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="picture" class="form-label">Product Picture</label>
        <input type="file" class="form-control" id="picture" name="picture">
      </div>

      <button type="submit" class="btn btn-primary">Save Changes</button>
      <a href="view_product.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</body>
</html>
