<?php
session_start();



if(isset($_GET['id'])){
    $id = $_GET['id'];

    unset($_SESSION['cart'][$id]);

    $count = 1;

    $_SESSION['count'] -= $count;

    header("Location: cart.php");
    return;
}

?>