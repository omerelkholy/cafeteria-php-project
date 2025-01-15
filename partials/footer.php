<!-- footer -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
    <style>
         *{
            font-family: "Outfit", serif;
        }
        :root {
            --coffee-primary: #8b6b61;
            --coffee-secondary: #C4A484;
            --coffee-light: #DEB887;
        }

        
        footer {
            background-color: var(--coffee-primary) !important;
        }

        .hover-coffee:hover {
            color: var(--coffee-light) !important;
            transition: color 0.3s ease;
        }

        .social-icons .fa-facebook-f:hover{
            color: #0866ff !important;
            transition: color 0.3s ease;
        }
        .social-icons .fa-youtube:hover{
            color: #ff0033 !important;
            transition: color 0.3s ease;
        }
        .social-icons .fa-twitter:hover{
            color: #24a4f2 !important;
            transition: color 0.3s ease;
        }
    </style>
</head>
<body>
    <footer class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-4 fw-bold" style="color: #C4A484;">Specialty Coffee House</h5>
                    <p class="text-light"><i class="fas fa-map-marker-alt me-2" style="color: #C4A484;"></i> Future Street, City</p>
                    <p class="text-light"><i class="fas fa-phone me-2" style="color: #C4A484;"></i> 0123456789</p>
                    <p class="text-light"><i class="fas fa-envelope me-2" style="color: #C4A484;"></i> info@Foamous.com</p>
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
                        <a href="#" class="mx-3 text-light"><i class="fab fa-youtube fa-2x"></i></a>
                        <a href="#" class="mx-3 text-light"><i class="fab fa-twitter fa-2x"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0 text-light">&copy; 2025 Foamous House. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>