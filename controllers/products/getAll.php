<?php
/**
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
*/

include_once '../../core/Database.php';
include_once '../../objects/Product.php';

$db = new Database();
$conn = $db->getConnection();
$product = new Product($conn);
$stmt = $product->getAll();
$num = $stmt->rowCount();
if($num > 0){
    http_response_code(200);
    echo json_encode($stmt->fetchAll());
}else{
    http_response_code(404);
    echo json_encode(["message" => "No products found"]);
}
