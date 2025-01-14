<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specialty Coffee</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark py-3" style="background-color: #4A3428;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="coffee-beans (1).png" alt="Coffee Shop Logo" class="me-2">
                <span class="brand-text fw-bold">Specialty Coffee</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <style>
        :root {
            --coffee-dark: #4A3428;
            --coffee-light: #C4A484;
            --coffee-accent: #D4B08C;
        }

        .brand-text {
            color: var(--coffee-light);
        }

        .navbar .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            margin: 0 1rem;
            transition: all 0.3s ease;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: var(--coffee-light) !important;
        }

        .btn-outline-coffee {
            color: var(--coffee-light);
            border-color: var(--coffee-light);
            transition: all 0.3s ease;
        }

        .btn-outline-coffee:hover {
            background-color: var(--coffee-light);
            color: var(--coffee-dark);
        }

        @media (max-width: 991.98px) {
            .navbar-nav {
                text-align: center;
                padding: 1rem 0;
            }

            .navbar .nav-link {
                margin: 0.5rem 0;
            }

            .btn-outline-coffee {
                margin-top: 1rem;
                width: 100%;
            }
        }

        .hover-coffee:hover {
            color: var(--coffee-light) !important;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--coffee-light) !important;
            transition: color 0.3s ease;
        }
    </style>

    <div class="main-content">
        <div>
            <img src="vecteezy_a-dramatic-coffee-splash-with-coffee-beans-suspended-in_47759488.png"
                alt="Coffee splash with suspended coffee beans"
                style="width: 100%; height: auto; max-width: 600px;">
        </div>
    </div>

    <footer class="py-5" style="background-color: #4A3428;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-4 fw-bold" style="color: #C4A484;">Specialty Coffee House</h5>
                    <p class="text-light"><i class="fas fa-map-marker-alt me-2" style="color: #C4A484;"></i> Future Street, City</p>
                    <p class="text-light"><i class="fas fa-phone me-2" style="color: #C4A484;"></i> 0123456789</p>
                    <p class="text-light"><i class="fas fa-envelope me-2" style="color: #C4A484;"></i> info@specialtycoffee.com</p>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="mb-4 fw-bold" style="color: #C4A484;">Opening Hours</h5>
                    <p class="text-light">Sunday - Thursday: 8:00 AM - 11:00 PM</p>
                    <p class="text-light">Friday - Saturday: 8:00 AM - 12:00 AM</p>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="mb-4 fw-bold" style="color: #C4A484;">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none hover-coffee">Home</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none hover-coffee">Menu</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none hover-coffee">About Us</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none hover-coffee">Contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <hr style="background-color: #C4A484;">
                    <div class="d-flex justify-content-center social-icons my-4">
                        <a href="#" class="mx-3 text-light"><i class="fab fa-facebook-f fa-2x"></i></a>
                        <a href="#" class="mx-3 text-light"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="mx-3 text-light"><i class="fab fa-twitter fa-2x"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0 text-light">&copy; 2025 Specialty Coffee House. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>