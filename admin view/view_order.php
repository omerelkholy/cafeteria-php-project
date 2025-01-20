<?php
require('../components/connect.php');
session_start();
// $query= "select p.name, u.name, status, quantity, date, price from users u, products p, orders where user_id = u.id and product_id = p.id ;";
// $statement = $connect->prepare($query);
// $statement->execute();

// $orders = $statement->fetchAll(PDO::FETCH_ASSOC);




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Processing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Merienda:wght@300..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Outfit", serif;
        }
        body {
            background-color: #f5f5dc;
            display: flex;
            height: 100vh;
            overflow-x: hidden;
        }

        .navbar-custom {
            background-color: #8b6b61;
        }

        .content {
            padding: 40px 20px 20px;
            width: 100%;
            background-color: #f5f5dc;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #8b6b61;
            color: #fff;
        }

        tbody tr:nth-child(odd) {
            background-color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f6f4;
        }

        tbody td,
        thead th {
            padding: 10px;
            text-align: center;
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

        .status {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .status.processing {
            color: #d2a679;
        }
    </style>
</head>

<body>
    <?php require('sidebar.inc.php'); ?>

    <div class="content">
        <div class="section">
            <h2 class="section-title">Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Items</th>
                        <th>Total Amount</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Shaimaa</td>
                        <td>- Coffee (50 EGP)</td>
                        <td>50 EGP</td>
                        <td>2025-01-13 10:30 AM</td>
                        <td class="status processing">
                            <i class="bi bi-arrow-repeat"></i> Processing
                        </td>
                        <td class="action-icons">
                            <i class="bi bi-trash" title="Delete"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>Ahmed</td>
                        <td>- Latte (70 EGP)</td>
                        <td>70 EGP</td>
                        <td>2025-01-12 11:45 AM</td>
                        <td class="status processing">
                            <i class="bi bi-arrow-repeat"></i> Processing
                        </td>
                        <td class="action-icons">
                            <i class="bi bi-trash" title="Delete"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.bi-trash').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                if (row) {
                    row.remove();
                }
            });
        });
    </script>

</body>

</html>