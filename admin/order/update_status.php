<?php

require_once __DIR__. '/../../includes/db.php';


if(isset($_POST['id'])){
    $id = $_POST['id'];
    $status = $_POST['status'];


    if($status == "shipped"){
        $stmt = $conn->prepare("SELECT * FROM orders WHERE id  = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        require_once __DIR__. '/shipped_email.php';

        ShippedEmail($row['Email'], $row['first_name'], $row['order_number']);
    }

    $stmt = $conn->prepare("UPDATE orders SET  status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);



    header("Location: orders.php");
}

?>