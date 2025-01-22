<?php

// $user = "root";
// $password = "";
// $server = 'localhost';
// $db = 'cafeteria';
// $connect = new PDO("mysql:host=$server;dbname=$db", $user, $password);


$user = "root";
$password = "";
$server = 'localhost';
$db = 'updated_cafeteria';
$connect = new PDO("mysql:host=$server;dbname=$db", $user, $password);




// if ($connect) {
//     echo "Connection successful";
// } else {
//     echo "Connection failed";
// }

// $query = "SELECT * FROM `users`";
// $statement = $connect->prepare($query);
// $statement->execute();
// $result = $statement->fetchAll(PDO::FETCH_ASSOC);
// print_r($result);