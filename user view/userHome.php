
<?php
require('../partials/usernav.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Customized Stylesheet -->
    <link href="css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <title>Cafeen</title>
    <link href="img/fav.ico" rel="icon">
</head>

<body>
    <!-- Carousel Start -->
    <!-- <div class="container-fluid p-0 mb-5">
        <div id="blog-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#blog-carousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#blog-carousel" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/carousel-1.jpg" alt="A cup of coffee" class="w-100">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-highlight font-weight-medium m-0">Wake Up and Smell the Coffee!</h2>
                        <h1 class="display-1 text-white m-0">COFFEE</h1>
                        <h2 class="text-white m-0">Where Every Cup Tells a Story.</h2>
                        <a href="#" class="btn btn-primary font-weight-bold py-2 px-4 mt-2">Order Now</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./img/carousel-2.jpg" alt="Freshly brewed coffee" class="w-100" loading="lazy">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-highlight font-weight-medium m-0">Wake Up and Smell the Coffee!</h2>
                        <h1 class="display-1 text-white m-0">COFFEE</h1>
                        <h2 class="text-white m-0">Where Every Cup Tells a Story.</h2>
                        <a href="#" class="btn btn-primary font-weight-bold py-2 px-4 mt-2">Order Now</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#blog-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#blog-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="overlay-bottom"></div>
    </div> -->
    <!-- Carousel End -->
    <!-- Main Content Section -->
    <div class="container main-content mt-5">
        <div class="row align-items-center">
            <div class="col-md-6 main-content-text">
                <strong>Coffee</strong>
                <h1>Enjoy <br> Your Morning <br> Coffee</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit incidunt nam tenetur quae officiis quos vel. Reiciendis unde odio id.</p>
                <span>$14.50</span>
                <a href="product.php">Explore More</a>
            </div>
            <div class="col-md-6 main-content-img">
                <img src="img/model.png" alt="main">
            </div>
        </div>
    </div>

    <!-- About Section Start -->
    <div class="container-fluid py-5" id="about">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">About Us</h4>
                <h1 class="display-4">Foamous</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Our Story</h1>
                    <h5 class="mb-3">Coffee is dedicated to providing the perfect coffee experience.</h5>
                    <p class="mb-3">Inspired by our love for coffee and community, we created a space for people to
                        relax and connect.</p>
                    <a href="#" class="btn btn-secondary font-weight-bold py-2 px-4">Learn More</a>
                </div>
                <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img src="img/banner-img.png" alt="Our coffee shop" class="position-absolute w-100 h-100"
                            style="object-fit:cover;">
                    </div>
                </div>
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Our Vision</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea, quo? Fuga, nulla a doloribus atque
                        aut accusantium quam pariatur aspernatur neque
                        iure ducimus!</p>
                    <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Enjoy our coffee!</h5>
                    <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Lorem, ipsum dolor.</h5>
                    <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Lorem, ipsum dolor.</h5>
                    <a href="#" class="btn btn-primary font-weight-bold py-2 px-4 mt-2">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About Section End -->
    <section class="container top-categories my-5">
        <h1 class="text-center mb-4">Mejoir Categories</h1>
        <div class="row g-4">
            <!-- Moca Category -->
            <div class="col-md-4">
                <div
                    class="card-category category-moca text-white d-flex flex-column align-items-center justify-content-center rounded-3 p-4">
                    <p class="text-center">Cafe moca</p>
                    <span class="text-center">Order</span>
                </div>
            </div>

            <!-- Expreso Category -->
            <div class="col-md-4">
                <div
                    class="card-category category-expreso text-white d-flex flex-column align-items-center justify-content-center rounded-3 p-4">
                    <p class="text-center">Expreso Americano</p>
                    <span class="text-center">Order</span>
                </div>
            </div>

            <!-- Capuchino Category -->
            <div class="col-md-4">
                <div
                    class="card-category category-capuchino text-white d-flex flex-column align-items-center justify-content-center rounded-3 p-4">
                    <p class="text-center">Capuchino</p>
                    <span class="text-center">Order</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Section Start -->
    <div class="container-fluid pt-5" id="service">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Our Services</h4>
                <h1 class="display-4">Fresh & Organic</h1>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <img src="./img/service-1.jpg" alt="Fastest Door Delivery" class="img-fluid mb-3 mb-sm-0">
                        </div>
                        <div class="col-sm-7">
                            <h4><i class="fa fa-truck service-icon"></i>Fastest Door Delivery</h4>
                            <p class="m-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corrupti, deserunt
                                dolore?
                                consectetur dolor id doloribus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <img src="./img/service-2.jpg" alt="Online Table Booking" class="img-fluid mb-3 mb-sm-0">
                        </div>
                        <div class="col-sm-7">
                            <h4><i class="fa fa-table service-icon"></i>Online Table Booking</h4>
                            <p class="m-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda ab, nihil

                                eligendi iure fuga temporibus exercitationem animi incidunt?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Service Section End -->

    <!-- Offer Section -->
    <!-- <div class="offer container-fluid my-5 py-5 text-center position-relative overlay-top overlay-bottom">
    <div class="container py-5">
        <h1 class="display-5 text-primary mt-3">50% Off</h1>
        <h1 class="text-white mb-3">Sunday Special Offer</h1>
        <h4 class="text-white font-weight mb-4 pb-3">
            Only For Sunday 1st Dec
        </h4>
        <form action="#" class="d-flex justify-content-center mb-4">
            <div class="input-group" style="max-width: 500px;">
                <input type="text" class="form-control p-4" placeholder="Your email" style="height: 60px;">
                <button class="btn btn-primary font-weight-bold px-4" type="submit">Sign Up</button>
            </div>
        </form>
    </div>
</div> -->

<?php require('../partials/footer.php'); ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="js/main.js"></script>



</body>

</html>

