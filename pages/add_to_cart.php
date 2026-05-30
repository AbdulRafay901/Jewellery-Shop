<?php
session_start();

if(isset($_POST['submit'])){
$id = $_POST['product_id'];
$name = $_POST['product_name'];
$image = $_POST['product_image'];
$description = $_POST['product_description'];
$color = $_POST['product_color'];
$type = $_POST['product_type'];
$price = $_POST['product_price'];
$qty = $_POST['product_qty'];

if($color){
    unset($_SESSION['color']);
}

if($type){
    unset($_SESSION['size']);
}

if(empty($color)){
    $_SESSION['color'] = "Select Color";
    header("Location: productDetails.php?id=$id");
    exit;
}
if(empty($type)){
    $_SESSION['size'] = "Select Size";
    header("Location: productDetails.php?id=$id");
    exit;
}
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}
$cart_key = $id . '_' . $color . '_' . $type;

if(isset($_SESSION['cart'][$cart_key])){
    $_SESSION['cart'][$cart_key]['qty'] += $qty;
}
else{
    $_SESSION['cart'][$cart_key] = [
        'name' => $name,
        'image' => $image,
        'description' => $description,
        'color' => $color,
        'type' => $type,
        'price' => $price,
        'qty' => $qty
    ];
    
    $count = 1;
    $_SESSION['count'] += $count;

    
header("Location: cart.php");
exit;

}

}


?>