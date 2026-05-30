<?php

require_once __DIR__.'/../includes/db.php';

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE Token = ?");
    $stmt->execute([$token]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row){

        $stmt = $conn->prepare("UPDATE users SET Token = ?  WHERE Token = ?");
        $stmt->execute(["NULL",$token]);

        header("Location: login.php");
        exit;
    }else{
        echo "invalid Token";
    }


}

?>