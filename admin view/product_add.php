<?php
require('../components/connect.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $productName = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $query = "insert into products (name,price,category) VALUES ('$productName', '$price', '$category')";

    $statement = $connect->prepare($query);
    $result = $statement->execute();

    header("location:view_product.php");
}
?>















<?php
require('sidebar.inc.php');
?>

<!-- form.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            font-family: "Outfit", serif;
        }

        :root {
            --coffee-primary: #8b6b61;
            --coffee-secondary: #C4A484;
            --coffee-light: #DEB887;
        }

        body {
            background-color: #f8f5f2;
        }

        /* Form  */
        .form-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(139, 107, 97, 0.1);
        }

        .header {
            background-color: var(--coffee-primary);
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .btn-coffee {
            background-color: var(--coffee-primary);
            color: white;
            border: none;
        }

        .btn-coffee:hover {
            background-color: #7a5d54;
            color: white;
        }

        .form-label {
            color: var(--coffee-primary);
            font-weight: 600;
        }

        .form-control:focus {
            border-color: var(--coffee-secondary);
            box-shadow: 0 0 0 0.25rem rgba(196, 164, 132, 0.25);
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container">
                    <div class="header p-4 mb-4">
                        <h2 class="text-center m-0">Add New Product</h2>
                    </div>
                    <div class="p-4">
                        <form method="POST">
                            <div class="mb-4">
                                <label for="productImage" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="productImage" accept="image/*">
                            </div>

                            <div class="mb-4">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" name="name" class="form-control" id="productName" placeholder="e.g., Turkish Coffee" required>
                            </div>

                            <div class="mb-4">
                                <label for="productDescription" class="form-label">Product Description</label>
                                <textarea class="form-control" id="productDescription" rows="3" placeholder="Write a detailed description of the product..."></textarea>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="productPrice" class="form-label">Price</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" name="price" class="form-control" id="productPrice" placeholder="0.00" required>
                                        <span class="input-group-text">EGP</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="productCategory" class="form-label">Category</label>
                                    <select class="form-select" name="category" id="productCategory" required>
                                        <option value="none" selected disabled>Select category</option>
                                        <option value="hot drinks">Hot Drinks</option>
                                        <option value="cold drinks">Cold Drinks</option>
                                        <option value="desserts">Desserts</option>
                                        <option value="snacks">Snacks</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="productAvailability" class="form-label">Availability</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="productAvailability" checked>
                                    <label class="form-check-label" for="productAvailability">
                                        Available for sale
                                    </label>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-coffee btn-lg px-5">Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>