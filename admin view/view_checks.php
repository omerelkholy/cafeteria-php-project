<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checks View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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

        .sidebar {
            position: fixed;
            top: 20px; 
            bottom: 20px; 
            left: 9px;
            height: auto;
            width: 250px;
            background-color: #6b4f4f;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
            font-size: 1.1rem;
            margin-bottom: 10px;
            border-radius: 5px;
            text-align: center; 
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #d2a679;
            color: white; 
        }

        
        .sidebar a:first-child {
            margin-top: 20px; 
        }

        .content {
    margin-left: 250px;
    padding: 40px 20px 20px; 
    padding-top: 50px; 
    width: 100%;
    background-color: #f5f5dc;
}


        .section {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #6b4f4f;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        thead {
            background-color: #8b6b61;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f6f4;
        }

        tbody tr:nth-child(odd) {
            background-color: #fff;
        }

        tbody td, thead th {
            padding: 4px 8px; 
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            font-size: 0.9rem;
            word-wrap: break-word;
            text-align: center;
        }

        th, td {
            min-width: 120px; 
        }

        .status {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .status.processing {
            color: #d2a679;
        }

        .status.completed {
            color: #6b4f4f;
        }

        .status.deleted {
            color: #8b6b61;
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

        .form-control, .form-select {
            border-radius: 50px;
            transition: border-color 0.3s, box-shadow 0.3s;
            border-color: #ccc;
            font-size: 1rem;
        }

        .form-control:hover, .form-select:hover {
            border-color: #8b6b61;
            box-shadow: 0 0 5px rgba(139, 107, 97, 0.5);
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 5px rgba(139, 107, 97, 0.5);
        }
        
        .modal-dialog {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            border-radius: 15px;
        }
        .btn-primary {
      background-color: #6b4f4f;
      border: none;
    }
    .btn-primary:hover {
      background-color: #a38181;
    }
    </style>
</head>

<body>
    <div class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="view_user.php">All Users</a>
        <a href="view_checks.php">View Checks</a>
        <a href="view_order.php">View Orders</a>
        <a href="add_product.php">Add Product</a>
        <a href="order_for_user.php">Order for User</a>
    </div>

    <div class="content">
        <div class="section">
            <h2 class="section-title">Filters</h2>
            <form>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="dateFrom" class="form-label">Date From</label>
                        <input type="date" id="dateFrom" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="dateTo" class="form-label">Date To</label>
                        <input type="date" id="dateTo" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="userSelect" class="form-label">User</label>
                        <select id="userSelect" class="form-select">
                            <option value="">Select User</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

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
                        <td>shimaa</td>
                        <td> Coffee (50 EGP)</td>
                        <td>50 EGP</td>
                        <td>2025-01-13 10:30 AM</td>
                        <td class="status processing">
                            <i class="bi bi-arrow-repeat"></i> Processing
                        </td>
                        <td class="action-icons">
                            <i class="bi bi-eye view-btn" 
                               data-name="shimaa" 
                               data-item="Coffee" 
                               data-price="50 EGP" 
                               data-date="2025-01-13 10:30 AM" 
                               data-status="Processing" 
                               title="View"></i>
                            <i class="bi bi-trash" title="Delete"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>nada</td>
                        <td> Cappuccino (60 EGP)</td>
                        <td>60 EGP</td>
                        <td>2025-01-12 11:00 AM</td>
                        <td class="status completed">
                            <i class="bi bi-check-circle"></i> Completed
                        </td>
                        <td class="action-icons">
                            <i class="bi bi-eye view-btn" 
                               data-name="nada" 
                               data-item="Cappuccino" 
                               data-price="60 EGP" 
                               data-date="2025-01-12 11:00 AM" 
                               data-status="Completed" 
                               title="View"></i>
                            <i class="bi bi-trash" title="Delete"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>abdallah</td>
                        <td> Espresso (80 EGP)</td>
                        <td>80 EGP</td>
                        <td>2025-01-13 9:13 AM</td>
                        <td class="status deleted">
                            <i class="bi bi-trash"></i> Deleted
                        </td>
                        <td class="action-icons">
                            <i class="bi bi-eye view-btn" 
                               data-name="abdallah" 
                               data-item="Espresso" 
                               data-price="80 EGP" 
                               data-date="2025-01-13 9:13 AM" 
                               data-status="Deleted" 
                               title="View"></i>
                            <i class="bi bi-trash" title="Delete"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="modalName"></span></p>
                    <p><strong>Item:</strong> <span id="modalItem"></span></p>
                    <p><strong>Price:</strong> <span id="modalPrice"></span></p>
                    <p><strong>Date & Time:</strong> <span id="modalDate"></span></p>
                    <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
 
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            const name = this.getAttribute('data-name');
            const item = this.getAttribute('data-item');
            const price = this.getAttribute('data-price');
            const date = this.getAttribute('data-date');
            const status = this.getAttribute('data-status');

            document.getElementById('modalName').textContent = name;
            document.getElementById('modalItem').textContent = item;
            document.getElementById('modalPrice').textContent = price;
            document.getElementById('modalDate').textContent = date;
            document.getElementById('modalStatus').textContent = status;

            const viewModal = new bootstrap.Modal(document.getElementById('viewModal'));
            viewModal.show();
        });
    });

  
    document.querySelectorAll('.bi-trash').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            if (row) {
                row.remove();
            }
        });
    });
</script>

</body>

</html>