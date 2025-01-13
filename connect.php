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

