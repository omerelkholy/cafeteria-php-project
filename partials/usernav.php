
<!-- navbar -->
<!DOCTYPE html>
<html lang="en">
    <?php $pageName = substr($_SERVER['SCRIPT_NAME'], strpos($_SERVER['SCRIPT_NAME'], "/")+1); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Merienda:wght@300..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Outfit", serif;
        }

        :root {
            --coffee-primary: #8b6b61;
            --coffee-secondary: #C4A484;
            --coffee-light: #DEB887;
        }


        .navbar {
            background-color: var(--coffee-primary) !important;
        }

        .nav-item {
            padding: 0px 30px;
        }

        .brand-text {
            color: var(--coffee-light);
            font-size: 35px;
            font-family: "Merienda", serif;
        }


        .navbar .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            margin: 0 1rem;
            transition: all 0.3s ease;
            font-size: 18px;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: var(--coffee-light) !important;
        }

        /* اللوج اوت اللي اتعدل */
        .btn-outline-coffee {
            background-color: white !important;
            color: var(--coffee-primary) !important;
            border-color: white !important;
            transition: all 0.3s ease;
            border-radius: 15px !important;
        }

        .btn-outline-coffee:hover {
            background-color: transparent !important;
            color: white !important;
            border-color: white !important;
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
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/user view/userHome.php">
                <img src="/beans.png" alt="Coffee Shop Logo" class="me-2">
                <span class="brand-text fw-bold">Foamous</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName ==  'user view/userHome.php' ? 'active':'';?>" href="/user view/userHome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName ==  'user view/product.php' ? 'active':'';?>" href="/user view/product.php">Menu</a>
                    </li>

                </ul>

                <a href="../login.php" class="btn btn-outline-coffee ms-lg-auto">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </div>
        </div>
    </nav>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>