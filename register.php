<?php

require('components/connect.php');
require('components/session.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$username = $_POST['username'];
	$email = $_POST['email'];
    $password = $_POST['password'];
	$hashedpassword = md5($password);
    $room_no = $_POST['room'] ?? null;
    $user_type = $_POST['user_type'];


    $emailRegex = '/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/';
    $usernameRegex = '/^[a-zA-Z]{3,12}$/';
    $passwordRegex = '/^.{5,}$/';
    $errors = [];
    if (!preg_match($usernameRegex, $username)) {
        $errors["username"] = "Please enter a valid username.";
    }
    if (!preg_match($emailRegex, $email)) {
        $errors["email"] = "Please enter a valid email.";
    }
    if (!preg_match($passwordRegex, $password)) {
        $errors["password"] = "Please enter a valid password.";
    }
	$statement = $connect->prepare("SELECT * FROM users WHERE email = ?");
    $statement->execute([$email]);
    if ($statement->rowCount() > 0) {
        $errors["email"] = "A user with this email already exists.";
    }
    $_SESSION["errors"] = $errors;

    if (empty($_SESSION["errors"])) {


		$query = "insert into users (name, email, password, room_no, user_type) VALUES (?, ?, ?, ?, ?)";

		$statement = $connect->prepare($query);
		$result = $statement->execute([$username, $email, $hashedpassword, $room_no, $user_type]);


		if (isset($_FILES['picture'])) {
			$picName = $_FILES['picture']['name'];
			$tmp_picName = $_FILES['picture']['tmp_name'];
			$folder = 'userpictures/' . $picName;
			if (move_uploaded_file($tmp_picName, $folder)) {
				$query2 = "update users set picture = ? where email = '$email' ";
				$statement = $connect->prepare($query2);
				$result = $statement->execute([$picName]);
			}
		}


		header("location:admin view/view_user.php");
    }else{
        header("location:register.php");
        exit();
    }
}



?>



<?php
require_once __DIR__ . '/admin view/sidebar.inc.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>login</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Aubrey&family=Birthstone&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lexend+Deca:wght@100..900&family=Micro+5&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+IE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Tiny5&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="styling/registerstyle.css?v=<?php echo time(); ?>">
</head>

<body>
	<div class="mycontainer">
		<div class="login-box">
			<h4>Register</h4>
			<form action="" method="POST" enctype="multipart/form-data" class="mt-5">
				<div class="myinput">
					<div class="field input">
						<label for="select">Is it a User or an Admin</label>
						<select name="user_type" id="user_type">
							<option value="user" selected>User</option>
							<option value="admin">Admin</option>
						</select>
					</div>
					<div class="field input">
						<label for="username">User name</label>
						<input type="text" name="username" placeholder="enter your user name" required>  
					</div>
                    <?php if (isset($_SESSION["errors"]['username'])) {
                        echo
                        "<p class='text-danger'>"
                            . $_SESSION["errors"]["username"] .
                            "</p>";
                    }
                    unset($_SESSION['errors']['username']);
                    ?>
					<div class="field input">
						<label for="email">Email</label>
						<input type="text" name="email" placeholder="enter your email" required>
					</div>
                    <?php if (isset($_SESSION["errors"]['email'])) {
                        echo
                        "<p class='text-danger'>"
                            . $_SESSION["errors"]["email"] .
                            "</p>";
                    }
                    unset($_SESSION['errors']['email']);
                    ?>
					<div class="field input">
						<label for="password">Password</label>
						<input type="password" name="password" placeholder="enter your password" required>
					</div>
                    <?php if (isset($_SESSION["errors"]['password'])) {
                        echo
                        "<p class='text-danger'>"
                            . $_SESSION["errors"]["password"] .
                            "</p>";
                    }
                    unset($_SESSION['errors']['password']);
                    ?>
					<div class="field input">
						<label for="select">Choose the room</label>
						<select name="room" id="room">
							<option disabled selected value="null">choose user room</option>
							<option value="200">200</option>
							<option value="201">201</option>
							<option value="202">202</option>
							<option value="203">203</option>
							<option value="204">204</option>
							<option value="205">205</option>
							<option value="206">206</option>
							<option value="207">207</option>
						</select>
					</div>
					<div class="field input mt-3">
						<label for="picture">choose an picture</label>
						<div>
							<input class="form-control" type="file" name="picture" id="picture" accept=".jpg, .png, .jpeg, .svg">
						</div>
					</div>
					<div class="field">
						<input type="submit" class="btn" name="register" value="Sign Up">
					</div>
				</div>
			</form>
		</div>
	</div>



	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
