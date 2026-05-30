<?php

session_start();


if(isset($_POST['submit'])){
    foreach($_POST['qty'] as $id => $qty){
        if($qty < 1 || !ctype_digit($qty)){
            continue;
        }
        else{
             if($_SESSION['cart'][$id]){
                 $_SESSION['cart'][$id]['qty'] = $qty; 
             }
        }
    }
}

header("Location: cart.php");
exit;

?>