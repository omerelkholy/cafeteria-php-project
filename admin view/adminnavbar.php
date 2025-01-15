<!-- navbar -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --coffee-primary: #8b6b61;
            --coffee-secondary: #C4A484;
            --coffee-light: #DEB887;
        }

        
        .navbar {
            background-color: var(--coffee-primary) !important;
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
/* اللوج اوت اللي اتعدل */
        .btn-outline-coffee {
            background-color: white !important;
            color: var(--coffee-primary) !important;
            border-color: white !important;
            transition: all 0.3s ease;
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
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="/beans.png" alt="Coffee Shop Logo" class="me-2">
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
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Checks</a>
                    </li>
                </ul>

                <a href="logout.php" class="btn btn-outline-coffee ms-lg-auto">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </div>
        </div>
    </nav>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>