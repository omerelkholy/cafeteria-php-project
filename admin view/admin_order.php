<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order Page</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body {
            margin-top: 20px;
            background: #f4e9d8; 
        }
        .product-content {
            border: 2px solid #dfe5e9;
            margin-bottom: 20px;
            margin-top: 12px;
            background: #fff;
            padding: 4px;
            -webkit-box-shadow: 0 1px 4px 0 rgba(0,0,0,0.37);
            box-shadow: 0 1px 4px 0 rgba(0,0,0,0.37);
        }
        .product-content .product-image {
            background-color: #fff;
            display: block;
            min-height: 238px;
            overflow: hidden;
            position: relative;
        }
        .product-content .product-deatil {
            border-bottom: 1px solid #dfe5e9;
            padding-bottom: 17px;
            padding-left: 16px;
            padding-top: 16px;
            position: relative;
            background: #fff;
        }
        .product-content .product-deatil h5 a {
            color: #2f383d;
            font-size: 15px;
            line-height: 19px;
            text-decoration: none;
            padding-left: 0;
            margin-left: 0;
        }
        .product-content .product-deatil h5 a span {
            color: #9aa7af;
            display: block;
            font-size: 13px;
        }
        .product-content .description {
            font-size: 12.5px;
            line-height: 20px;
            padding: 10px 14px 16px 19px;
            background: #fff;
        }
        .product-content .product-info {
            padding: 11px 19px 10px 20px;
        }
        .product-content .product-info a.add-to-cart {
            color: #2f383d;
            font-size: 13px;
            padding-left: 16px;
        }
        .cart-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart-item {
            margin-bottom: 15px;
        }
        .total-price {
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
        }
        .quantity-control {
            display: flex;
            align-items: center;
        }
        .quantity-control button {
            margin: 0 5px;
        }
        .btn-confirm {
            background-color: #8B4513; 
            color: #fff;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .btn-confirm:hover {
            background-color: #6e3610; 
        }
        .room-selection {
            margin-top: 20px;
        }
        .room-selection select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        .room-selection select:focus {
            border-color: #8B4513; 
            outline: none;
        }
        .confirmation-message {
            display: none;
            margin-top: 20px;
            padding: 10px;
            background-color: #d4edda; 
            color: #155724; 
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
        <!-- cart -->
            <div class="col-md-3">
                <div class="cart-container">
                    <h2>Order Cart</h2>
                    <form id="orderForm">
                      
                        <div id="cart-items">
                           
                            <div class="cart-item">
                                <h5>Tea - EGP 20 x 2</h5>
                                <div class="quantity-control">
                                    <button type="button" class="btn btn-sm btn-secondary">-</button>
                                    <button type="button" class="btn btn-sm btn-secondary">+</button>
                                </div>
                            </div>
                            <div class="cart-item">
                                <h5>Coffee - EGP 25 x 1</h5>
                                <div class="quantity-control">
                                    <button type="button" class="btn btn-sm btn-secondary">-</button>
                                    <button type="button" class="btn btn-sm btn-secondary">+</button>
                                </div>
                            </div>
                        </div>

                    
                        <div class="form-group">
                            <label for="notes">extras:</label>
                            <textarea class="form-control" name="notes" id="notes" rows="3"></textarea>
                        </div>

                     
                        <div class="total-price">
                            Total: EGP 65
                        </div>

                        
                        <div class="form-group room-selection">
                            <label for="room">Room Number:</label>
                            <select class="form-control" name="room" id="room">
                                <option value="1">Room 1</option>
                                <option value="2">Room 2</option>
                                <option value="3">Room 3</option>
                                <option value="4">Room 207</option>
                            </select>
                        </div>

                        
                        <button type="button" id="confirmButton" class="btn btn-confirm btn-block">Confirm Order</button>

                        <!-- Confirmation Message -->
                        <div id="confirmationMessage" class="confirmation-message">
                            our delivey is on the way 
                        </div>
                    </form>
                </div>
            </div>

            <!-- Product -->
            <div class="col-md-9">
                <!-- Users -->
                <div class="form-group">
                    <label for="user">Select User:</label>
                    <select class="form-control" name="user" id="user">
                        <option value="1">omer</option>
                        <option value="2">shimaa</option>
                        <option value="3">hadeer</option>
                    </select>
                </div>

                <!-- Products -->
                <div class="row">
                    <!-- Tea -->
                    <div class="col-md-6">
                        <div class="product-content product-wrap clearfix">
                            <div class="row">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="product-image">
                                        <img src="https://www.bootdey.com/image/194x228/B0C4DE" alt="Tea" class="img-responsive">
                                        <span class="tag2 hot">HOT</span>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <div class="product-deatil">
                                        <h5 class="name">
                                            <a href="#">Tea <span>Hot Drinks</span></a>
                                        </h5>
                                        <p class="price-container">
                                            <span>EGP 20</span>
                                        </p>
                                    </div>
                                    <div class="description">
                                        <p>A classic Tea.</p>
                                    </div>
                                    <div class="product-info smart-form">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <button type="button" class="btn btn-success">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coffee -->
                    <div class="col-md-6">
                        <div class="product-content product-wrap clearfix">
                            <div class="row">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="product-image">
                                        <img src="https://www.bootdey.com/image/194x228/87CEFA" alt="Coffee" class="img-responsive">
                                        <span class="tag2 hot">HOT</span>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <div class="product-deatil">
                                        <h5 class="name">
                                            <a href="#">Coffee <span>Hot Drinks</span></a>
                                        </h5>
                                        <p class="price-container">
                                            <span>EGP 25</span>
                                        </p>
                                    </div>
                                    <div class="description">
                                        <p>A classic Coffee.</p>
                                    </div>
                                    <div class="product-info smart-form">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <button type="button" class="btn btn-success">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Iced Coffee -->
                    <div class="col-md-6">
                        <div class="product-content product-wrap clearfix">
                            <div class="row">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="product-image">
                                        <img src="https://www.bootdey.com/image/194x228/ADD8E6" alt="Iced Coffee" class="img-responsive">
                                        <span class="tag2 hot">COLD</span>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <div class="product-deatil">
                                        <h5 class="name">
                                            <a href="#">Iced Coffee <span>Cold Drinks</span></a>
                                        </h5>
                                        <p class="price-container">
                                            <span>EGP 30</span>
                                        </p>
                                    </div>
                                    <div class="description">
                                        <p>Refreshing Iced Coffee.</p>
                                    </div>
                                    <div class="product-info smart-form">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <button type="button" class="btn btn-success">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boba Tea -->
                    <div class="col-md-6">
                        <div class="product-content product-wrap clearfix">
                            <div class="row">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="product-image">
                                        <img src="https://www.bootdey.com/image/194x228/FFC0CB" alt="Boba Tea" class="img-responsive">
                                        <span class="tag2 hot">COLD</span>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <div class="product-deatil">
                                        <h5 class="name">
                                            <a href="#">Boba Tea <span>Cold Drinks</span></a>
                                        </h5>
                                        <p class="price-container">
                                            <span>EGP 35</span>
                                        </p>
                                    </div>
                                    <div class="description">
                                        <p>Delicious Boba Tea.</p>
                                    </div>
                                    <div class="product-info smart-form">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <button type="button" class="btn btn-success">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boba Iced Coffee -->
                    <div class="col-md-6">
                        <div class="product-content product-wrap clearfix">
                            <div class="row">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="product-image">
                                        <img src="https://www.bootdey.com/image/194x228/D3D3D3" alt="Boba Iced Coffee" class="img-responsive">
                                        <span class="tag2 hot">COLD</span>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <div class="product-deatil">
                                        <h5 class="name">
                                            <a href="#">Boba Iced Coffee <span>Cold Drinks</span></a>
                                        </h5>
                                        <p class="price-container">
                                            <span>EGP 40</span>
                                        </p>
                                    </div>
                                    <div class="description">
                                        <p>Boba Iced Coffee with a twist.</p>
                                    </div>
                                    <div class="product-info smart-form">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <button type="button" class="btn btn-success">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Green Tea -->
                    <div class="col-md-6">
                        <div class="product-content product-wrap clearfix">
                            <div class="row">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="product-image">
                                        <img src="https://www.bootdey.com/image/194x228/90EE90" alt="Green Tea" class="img-responsive">
                                        <span class="tag2 hot">HOT</span>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <div class="product-deatil">
                                        <h5 class="name">
                                            <a href="#">Green Tea <span>Hot Drinks</span></a>
                                        </h5>
                                        <p class="price-container">
                                            <span>EGP 15</span>
                                        </p>
                                    </div>
                                    <div class="description">
                                        <p>Healthy Green Tea.</p>
                                    </div>
                                    <div class="product-info smart-form">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <button type="button" class="btn btn-success">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hot Chocolate -->
                    <div class="col-md-6">
                        <div class="product-content product-wrap clearfix">
                            <div class="row">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="product-image">
                                        <img src="https://www.bootdey.com/image/194x228/8B4513" alt="Hot Chocolate" class="img-responsive">
                                        <span class="tag2 hot">HOT</span>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <div class="product-deatil">
                                        <h5 class="name">
                                            <a href="#">Hot Chocolate <span>Hot Drinks</span></a>
                                        </h5>
                                        <p class="price-container">
                                            <span>EGP 35</span>
                                        </p>
                                    </div>
                                    <div class="description">
                                        <p>Rich Hot Chocolate.</p>
                                    </div>
                                    <div class="product-info smart-form">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <button type="button" class="btn btn-success">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ice Chocolate -->
                    <div class="col-md-6">
                        <div class="product-content product-wrap clearfix">
                            <div class="row">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="product-image">
                                        <img src="https://www.bootdey.com/image/194x228/A0522D" alt="Ice Chocolate" class="img-responsive">
                                        <span class="tag2 hot">COLD</span>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <div class="product-deatil">
                                        <h5 class="name">
                                            <a href="#">Ice Chocolate <span>Cold Drinks</span></a>
                                        </h5>
                                        <p class="price-container">
                                            <span>EGP 30</span>
                                        </p>
                                    </div>
                                    <div class="description">
                                        <p>Chilled Ice Chocolate.</p>
                                    </div>
                                    <div class="product-info smart-form">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <button type="button" class="btn btn-success">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Banana with Milk -->
                    <div class="col-md-6">
                        <div class="product-content product-wrap clearfix">
                            <div class="row">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="product-image">
                                        <img src="https://www.bootdey.com/image/194x228/FFFFE0" alt="Banana with Milk" class="img-responsive">
                                        <span class="tag2 hot">COLD</span>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <div class="product-deatil">
                                        <h5 class="name">
                                            <a href="#">Banana with Milk <span>Cold Drinks</span></a>
                                        </h5>
                                        <p class="price-container">
                                            <span>EGP 25</span>
                                        </p>
                                    </div>
                                    <div class="description">
                                        <p>Refreshing Banana with Milk.</p>
                                    </div>
                                    <div class="product-info smart-form">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <button type="button" class="btn btn-success">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 
   
</body>
</html>