<?php
require('components/connect.php');

session_start();


if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST["email"];
    $pass = md5($_POST["password"]);

    $query = "select * from users where email = '$email' and password = '$pass'";
    $statment = $connect->prepare($query);
    $statment->execute();
    $result = $statment->fetch(PDO::FETCH_ASSOC);
   
    if($result){
    if($result['user_type'] == 'admin'){
            $_SESSION['email']=$email;
            header("location:admin view/view_user.php");
    }else if($result['user_type'] == 'user'){
            $_SESSION['email']=$email;
            $_SESSION['room_no']=$result['room_no'];
            header("location:user view/userhome.php");
    }

    }else{
        echo 'invalid email or password';
    }
}

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
    <link rel="stylesheet" href="/styling/loginstyle.css">
</head>

<body>
    <div class="mycontainer">
        <div class="login-box">
        <h4>Login</h4>
            <form action="#" method="POST">
                <div class="myinput">
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="enter your email" required>
                    </div>
                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="enter your password" required>
                    </div>
                    <div class="field">
                        <input type="submit" class="btn" name="login" value="log in">
                        <a href="">forget password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>