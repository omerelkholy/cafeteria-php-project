
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
    <!-- nav -->
    <nav class="navbar navbar-expand-lg navbar-dark py-3" style="background-color: #4A3428;">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="/coffee-beans (1).png" alt="Coffee Shop Logo" class="me-2">
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
                        <a class="nav-link" href="#">products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">checks</a>
                    </li>
                </ul>


                <a href="logout.php" class="btn btn-outline-coffee ms-lg-auto">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </div>
        </div>
    </nav>
      <!-- Additional CSS -->
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
    </style>



Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem vero ducimus autem. Pariatur aut excepturi fugiat odit tempora ab in explicabo, quas laboriosam incidunt dolorem temporibus reprehenderit eum non consectetur!lorem200

Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur aperiam expedita ipsa libero temporibus possimus error ad. Amet, animi fugit. Nulla expedita, totam dicta suscipit tempore omnis natus at minus dolorem dolore soluta animi quod, sit ipsa. Provident, deleniti eius. Sint dolores, nemo numquam consequuntur inventore esse repellat doloribus reprehenderit. Beatae minima pariatur dolore, distinctio neque laboriosam dolor magni debitis error officiis quidem placeat architecto, odit, explicabo totam inventore porro ullam animi natus. Modi possimus iste veritatis vero reprehenderit, atque quibusdam repudiandae molestiae provident perspiciatis pariatur tempore et similique. Ducimus vero facere excepturi nemo, iure, alias perspiciatis magnam voluptates vitae maiores, cum blanditiis voluptatibus provident mollitia fuga quos quia saepe totam ratione repellendus tenetur assumenda aperiam veritatis. Assumenda nobis dignissimos delectus quod consectetur illum fuga maxime ex non mollitia consequatur magni tempore iste placeat nulla accusamus, architecto vitae omnis soluta expedita quia! Officia quos nesciunt a aspernatur ullam expedita tempore animi doloremque illo est, vitae cum similique, necessitatibus aut maxime harum accusamus. A culpa autem distinctio consectetur exercitationem, consequuntur harum officiis quasi quos nemo vel eos obcaecati. Neque debitis, accusantium natus aliquam accusamus voluptatibus incidunt, eligendi, assumenda facere aliquid dolores doloremque illum! Blanditiis sed vero atque, culpa velit aliquid neque.
    <!-- foot -->
    <footer class="py-5" style="background-color: #4A3428;">
        <div class="container">
            <div class="row">

                <div class="col-md-4 mb-4">
                    <h5 class="mb-4 fw-bold" style="color: #C4A484;">Specialty Coffee House</h5>
                    <p class="text-light"><i class="fas fa-map-marker-alt me-2" style="color: #C4A484;"></i> Future
                        Street, City</p>
                    <p class="text-light"><i class="fas fa-phone me-2" style="color: #C4A484;"></i> 0123456789</p>
                    <p class="text-light"><i class="fas fa-envelope me-2" style="color: #C4A484;"></i>
                        info@specialtycoffee.com</p>
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
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none hover-coffee">About Us</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none hover-coffee">Contact</a>
                        </li>
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
                    <p class="mb-0 text-light">&copy; 2024 Specialty Coffee House. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Additional CSS -->
    <style>
        :root {
            --coffee-dark: #4A3428;
            --coffee-light: #C4A484;
            --coffee-accent: #D4B08C;
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
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</body>
</html>
