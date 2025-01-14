
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product add</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --coffee-primary: #6F4E37;
            --coffee-secondary: #C4A484;
            --coffee-light: #DEB887;
        }
        
        body {
            background-color: #f8f5f2;
        }
        
        .form-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(111, 78, 55, 0.1);
        }
        
        .btn-coffee {
            background-color: var(--coffee-primary);
            color: white;
            border: none;
        }
        
        .btn-coffee:hover {
            background-color: #5d4130;
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
        
        .header {
            background-color: var(--coffee-primary);
            color: white;
            border-radius: 15px 15px 0 0;
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
                        <form>
                            <div class="mb-4">
                                <label for="productImage" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="productImage" accept="image/*" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName" placeholder="e.g., Turkish Coffee" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="productDescription" class="form-label">Product Description</label>
                                <textarea class="form-control" id="productDescription" rows="3" placeholder="Write a detailed description of the product..." required></textarea>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="productPrice" class="form-label">Price</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="productPrice" placeholder="0.00" required>
                                        <span class="input-group-text">USD</span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="productCategory" class="form-label">Category</label>
                                    <select class="form-select" id="productCategory" required>
                                        <option value="" selected disabled>Select category</option>
                                        <option value="hot-drinks">Hot Drinks</option>
                                        <option value="cold-drinks">Cold Drinks</option>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</body>
</html>
