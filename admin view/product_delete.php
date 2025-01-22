<?php
require('../components/connect.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
$query= "delete from products where id = ?;";
$statement = $connect->prepare($query);
$statement->execute([$id]);
}


header('location:view_product.php');
?>