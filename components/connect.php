<?php

$username = "root";
$password = "";
$server = 'localhost';
$db = 'cafeteria';
$connect = new PDO("mysql:host=$server;dbname=$db", $username, $password);

if ($connect) {
    echo "Connection successful";
} else {
    echo "Connection failed";
}

$query = "SELECT * FROM `users`";
$statment = $connect->prepare($query);
$statment->execute();
$result = $statment->fetchAll(PDO::FETCH_ASSOC);
print_r($result);