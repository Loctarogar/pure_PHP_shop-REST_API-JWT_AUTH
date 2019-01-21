<?php

include_once '../../objects/Product.php';
include_once '../../core/Database.php';

$database = new Database();
$conn = $database->getConnection();
$product = new Product($conn);

$data = json_decode(file_get_contents("php://input"));
$productId = $data->productId;

$isDeleted = $product->deleteProduct($productId);
if($isDeleted){
    echo json_encode(["messate" => "Product was successfully deleted"]);

    return;
}else{
    echo json_encode(["message" => "Product wasn't found"]);

    return;
}
