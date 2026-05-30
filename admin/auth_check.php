<?php



if(!isset($_SESSION['username'])){
     header("Location:" . BASE_URL . "/authentication/login.php");
     exit;
}
if($_SESSION['Role'] !== "admin"){
     header("Location:". BASE_URL . "/index.php");
     exit;
}

?>