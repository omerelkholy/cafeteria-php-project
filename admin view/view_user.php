<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Manage Users</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
      flex-direction: column;
    }

    .navbar-custom {
      background-color: #8b6b61;
    }

    .content {
      padding: 40px 20px 20px;
      padding-top: 50px;
      width: 100%;
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

    .btn-primary {
      background-color: #6b4f4f;
      border: none;
    }

    .btn-primary:hover {
      background-color: #a38181;
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

    .table th {
      background-color: #8b6b61;
      color: #fff;
    }

    tbody tr:nth-child(odd) {
      background-color: #fff;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f6f4;
    }
  </style>
</head>
<body>

  <!-- Content -->
  <div class="content">
    <div class="section">
      <h2 class="section-title">Manage Users</h2>
      <div class="d-flex justify-content-end mb-3">
        <a href="Register.php" class="btn btn-primary">Add User</a>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Room</th>
            <th>Image</th>
            <th>Ext</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Shimaa</td>
            <td>2010</td>
            <td><img src="imgs/user1.png" alt="User Image" style="width: 40px; height: 40px;"></td>
            <td>5605</td>
            <td class="action-icons">
              <i class="bi bi-pencil-square" title="Edit"></i>
              <i class="bi bi-trash" title="Delete"></i>
            </td>
          </tr>
          <tr>
            <td>Maxi</td>
            <td>2010</td>
            <td><img src="imgs/user2.png" alt="User Image" style="width: 40px; height: 40px;"></td>
            <td>5605</td>
            <td class="action-icons">
              <i class="bi bi-pencil-square" title="Edit"></i>
              <i class="bi bi-trash" title="Delete"></i>
            </td>
          </tr>
          <tr>
            <td>Nada</td>
            <td>2010</td>
            <td><img src="imgs/user3.png" alt="User Image" style="width: 40px; height: 40px;"></td>
            <td>5605</td>
            <td class="action-icons">
              <i class="bi bi-pencil-square" title="Edit"></i>
              <i class="bi bi-trash" title="Delete"></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
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
