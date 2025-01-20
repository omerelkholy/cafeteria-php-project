<?php
require('../components/connect.php');
$query= "select * from products order by category desc;";
$statement = $connect->prepare($query);
$statement->execute();

$products = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Manage Users</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Merienda:wght@300..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Outfit", serif;
    }
    html, body {
      height: 100%;
      overflow-x: hidden;
    }

    body {
      background-color: #f5f5dc;
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
    }

    .navbar-custom {
      background-color: #8b6b61;
    }

    .content {
      padding: 40px 20px 20px;
      padding-top: 50px;
      margin-left: 250px;
    }

    .section {
      background-color: #ffffff;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .section-title {
      font-size: 1.5rem;
      font-weight: bold;
      color: #6b4f4f;
      margin-bottom: 15px;
    }

    .btn-primary {
      background-color: #6b4f4f;
      border: none;
    }

    .btn-primary:hover {
      background-color: #a38181;
    }

    .action-icons i {
      cursor: pointer;
      margin-right: 10px;
      font-size: 1.2rem;
      transition: color 0.3s ease, transform 0.3s ease;
    }

    .action-icons i:hover {
      color: brown;
      transform: scale(1.2);
    }

    .table th {
      background-color: #8b6b61;
      color: #fff;
    }

    tbody tr:nth-child(odd) {
      background-color: #fff;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f6f4;
    }

    img{
      border-radius: 50%;
      width: 60px !important;
      height: 60px !important;
    }
    .bi-trash,.bi-pencil-square{
      color: #6b4f4f;
    }
  </style>
</head>
<body>
<?php require('sidebar.inc.php'); ?>
  <!-- Content -->
  <div class="content">
    <div class="section">
      <h2 class="section-title">Manage Products</h2>
      <div class="d-flex justify-content-end mb-3">
        <a href="product_add.php" class="btn btn-primary">Add Product</a>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>price</th>
            <th>Image</th>
            <th>Category</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($products as $product): ?>
          <tr>
            <td><?= $product['name'] ?></td>
            <td><?= $product['price']." EGP" ?></td>
            <td><img src="productpictures/<?= $product['picture'] ?>" alt="product Image" style="width: 40px; height: 40px;"></td>
            <td><?= $product['category'] ?></td>
            <td class="action-icons">
              <i class="bi bi-pencil-square" title="Edit"></i>
             <a href="product_delete.php?id=<?=$product['id']?>"> <i class="bi bi-trash" title="Delete"></i> </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- <script>
    document.querySelectorAll('.bi-trash').forEach(button => {
      button.addEventListener('click', function () {
          const row = this.closest('tr');
          if (row) {
              row.remove();
          }
      });
    });
  </script> -->
</body>
</html>
