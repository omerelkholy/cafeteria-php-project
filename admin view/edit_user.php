<?php
require('../components/connect.php');

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $query = "SELECT * FROM users WHERE id = :id";
    $statement = $connect->prepare($query);
    $statement->execute(['id' => $userId]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("User not found");
    }
} else {
    die("Invalid Request");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $room_no = isset($_POST['room_no']) ? $_POST['room_no'] : null; // optional for admin
    $user_type = $_POST['user_type'];
    $email = $_POST['email'];

    // Handle image upload
    $picture = $user['picture']; // Keep the old picture if not uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imagePath = 'uploads/' . $imageName; 
        move_uploaded_file($imageTmpName, $imagePath);
        $picture = $imagePath; 
    }

    
    $updateQuery = "UPDATE users SET name = :name, email = :email, user_type = :user_type, picture = :picture";
    if ($user_type == 'user') {
        $updateQuery .= ", room_no = :room_no"; 
    }
    $updateQuery .= " WHERE id = :id";

    $updateStmt = $connect->prepare($updateQuery);
    $params = [
        'name' => $name,
        'email' => $email,
        'user_type' => $user_type,
        'picture' => $picture,
        'id' => $userId
    ];
    if ($user_type == 'user') {
        $params['room_no'] = $room_no; 
    }

    $updateStmt->execute($params);

    header("Location: view_user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Outfit", sans-serif;
    }
    html, body {
        height: 100%;
        overflow-x: hidden;
    }
    body {
        background-color: #f5f5dc;
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        padding-top: 20px;
    }
    .content {
        width: 100%;
        max-width: 800px;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .section-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #6b4f4f;
        margin-bottom: 15px;
    }
    .form-label {
        color: #6b4f4f;
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
    .btn-primary {
        background-color: #6b4f4f;
        border: none;
    }
    .btn-primary:hover {
        background-color: #a38181;
    }
    .btn {
        margin-top: 20px;
    }
  </style>
</head>

<body>

    <div class="content">
        <h2 class="section-title">Edit User</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="user_type" class="form-label">User Type</label>
                <select class="form-select" id="user_type" name="user_type">
                    <option value="admin" <?= ($user['user_type'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="user" <?= ($user['user_type'] ?? '') === 'user' ? 'selected' : '' ?>>User</option>
                </select>
            </div>

            <!-- Show Room field only if user type is "user" -->
            <?php if ($user['user_type'] === 'user'): ?>
                <div class="mb-3">
                    <label for="room_no" class="form-label">Room</label>
                    <select class="form-select" id="room_no" name="room_no">
                        <?php for ($i = 200; $i <= 207; $i++): ?>
                            <option value="<?= $i ?>" <?= ($user['room_no'] == $i) ? 'selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="view_user.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

</body>
</html>
