<?php

include_once '../../core/Database.php';
include_once '../../objects/Cart.php';
include_once '../../objects/Product.php';
include_once '../../objects/User.php';

$database = new Database();
$conn = $database->getConnection();
$cart = new Cart($conn);
$product = new Product($conn);

$data = json_decode(file_get_contents("php://input"));

if(isset($data->userId) && isset($data->productId)){
    $userId = $data->userId;
    $productId = $data->productId;
}else{
    echo json_encode([
        "message" => "user or product doesn't exists"
    ]);

    return false;
}
if(isset($data->quantity)){
    $quantity = $data->quantity;
}else{
    $quantity = 1;
}

$cart->setUserId($userId);
$cart->setProductId($productId);
$cart->setQuantity($quantity);
$stmt = $cart->addCart();

echo json_encode($stmt);

