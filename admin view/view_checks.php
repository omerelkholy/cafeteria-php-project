<?php
require('../components/connect.php');
session_start();

if (isset($_POST['dateFrom']) || isset($_POST['dateTo']) || isset($_POST['userId'])) {
    $whereClauses = [];

    if (isset($_POST['dateFrom']) && !empty($_POST['dateFrom'])) {
        $dateFrom = $_POST['dateFrom'];
        $whereClauses[] = "orders.order_date >= :dateFrom";
    }

    if (isset($_POST['dateTo']) && !empty($_POST['dateTo'])) {
        $dateTo = $_POST['dateTo'];
        $whereClauses[] = "orders.order_date <= :dateTo";
    }

    if (isset($_POST['userId']) && !empty($_POST['userId'])) {
        $userId = $_POST['userId'];
        $whereClauses[] = "orders.user_id = :userId";
    }

    $query = "
        SELECT 
            orders.id,
            users.name AS user_name,
            orders.status,
            orders.order_date,
            orders.room_no
        FROM orders
        JOIN users ON orders.user_id = users.id
    ";

    if (count($whereClauses) > 0) {
        $query .= " WHERE " . implode(" AND ", $whereClauses);
    }

    $query .= " ORDER BY orders.order_date DESC";

    $statement = $connect->prepare($query);

    if (isset($dateFrom)) {
        $statement->bindParam(':dateFrom', $dateFrom);
    }
    if (isset($dateTo)) {
        $statement->bindParam(':dateTo', $dateTo);
    }
    if (isset($userId)) {
        $statement->bindParam(':userId', $userId);
    }

    $statement->execute();
    $orders = $statement->fetchAll(PDO::FETCH_ASSOC);
} else {
    $query = "
        SELECT 
            orders.id,
            users.name AS user_name,
            orders.status,
            orders.order_date,
            orders.room_no
        FROM orders
        JOIN users ON orders.user_id = users.id
        ORDER BY orders.order_date DESC;
    ";

    $statement = $connect->prepare($query);
    $statement->execute();
    $orders = $statement->fetchAll(PDO::FETCH_ASSOC);
}

$userQuery = "
    SELECT DISTINCT users.id, users.name
    FROM orders
    JOIN users ON orders.user_id = users.id
";
$userStatement = $connect->prepare($userQuery);
$userStatement->execute();
$users = $userStatement->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['delete_order_id'])) {
    $orderId = $_POST['delete_order_id'];

    $deleteQuery = "DELETE FROM orders WHERE id = :id";
    $deleteStmt = $connect->prepare($deleteQuery);
    $deleteStmt->bindParam(':id', $orderId, PDO::PARAM_INT);

    if ($deleteStmt->execute()) {
        echo 'success'; 
    } else {
        echo 'error'; 
    }
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checks View</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Merienda:wght@300..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Outfit", serif;
        }

        html, body {
            height: 100%;
            overflow-x: hidden;
        }

        body {
            background-color: #f5f5dc;
            font-family: Arial, sans-serif;
            display: flex;
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

        .status.processing {
            color: #d2a679;
        }

        .status.completed {
            color: green;
        }

        .status.out-of-delivery {
            color: #f0ad4e;
        }

        .status.deleted {
            color: red;
        }

        .edit-icon {
            text-decoration: none;
            color: inherit;
            cursor: pointer;
            margin-right: 10px;
            font-size: 1.2rem;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .edit-icon:hover {
            color: brown;
            transform: scale(1.2);
        }
       
        .btn-primary {
            background-color: #6b4f4f;
            border: none;
        }

        .btn-primary:hover {
            background-color: #a38181;
        }

        .btn{
            margin-top: 80px
        }
    </style>
</head>

<body>
<?php require('sidebar.inc.php'); ?>
    <div class="content">
        <div class="section">
            <h2 class="section-title">Filters</h2>
            <form method="POST" id="filtersForm">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="dateFrom" class="form-label">Date From</label>
                        <input type="date" id="dateFrom" name="dateFrom" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="dateTo" class="form-label">Date To</label>
                        <input type="date" id="dateTo" name="dateTo" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="userSelect" class="form-label">User</label>
                        <select id="userSelect" name="userId" class="form-select">
                            <option value="">Select User</option>
                            <?php foreach ($users as $user): ?>
                                <option value="<?php echo htmlspecialchars($user['id']); ?>"><?php echo htmlspecialchars($user['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Apply Filters</button>
            </form>
        </div>

        <div class="section">
            <h2 class="section-title">Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Status</th>
                        <th>Room No</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr data-order-id="<?php echo htmlspecialchars($order['id']); ?>">
                            <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                            <td class="status <?php echo htmlspecialchars($order['status']); ?>">
                                <?php 
                                    if ($order['status'] == 'processing') {
                                        echo '<i class="bi bi-arrow-repeat"></i> Processing';
                                    } elseif ($order['status'] == 'delivered') {
                                        echo '<i class="bi bi-truck"></i> delivery';
                                    } elseif ($order['status'] == 'shipped') {
                                        echo '<i class="bi bi-check-circle"></i> shipped';
                                    }
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($order['room_no'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td class="action-icons">
                                <a href="view_checks_details.php?id=<?php echo htmlspecialchars($order['id']); ?>" class="edit-icon bi bi-eye" title="View"></a>
                                <a href="javascript:void(0);" class="edit-icon bi bi-trash" title="Delete" onclick="deleteOrder(<?php echo htmlspecialchars($order['id']); ?>)"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function deleteOrder(orderId) {
        const formData = new FormData();
        formData.append('delete_order_id', orderId);

        fetch('', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                location.reload();
            } else {
                alert('An error occurred while deleting the order.');
            }
        });
    }
    </script>

</body>

</html>
