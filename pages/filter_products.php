<?php
require_once __DIR__ . '/../includes/db.php';

$from       = $_POST['from']       ?? 0;
$to         = $_POST['to']         ?? 999999;
$categories = $_POST['categories'] ?? [];


    
    

     
     $query = "SELECT * FROM products JOIN categories ON products.category_id = categories.c_id 
     WHERE new_price >= ? AND new_price <= ?";
     
     $params = [$from,$to];

     if(!empty($categories)){
        $string = implode(",", array_fill(0, count($categories), '?'));
        $query .= " AND categories.name IN ($string)";
        $params = array_merge($params,$categories);
     }
     $stmt =  $conn->prepare($query);
     $stmt->execute($params);
     $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

     

     


header('Content-Type: application/json');
echo json_encode($products);