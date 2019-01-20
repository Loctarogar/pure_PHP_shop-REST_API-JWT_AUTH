<?php

include_once '../../core/Database.php';
include_once '../../objects/Cart.php';
include_once '../../objects/User.php';

$database = new Database();
$conn = $database->getConnection();

$cart = new Cart($conn);

$data = json_decode(file_get_contents("php://input"));
$user = $data->user;
$cart->setUserId($user);
$stmt  = $cart->getAllProductsForUser();
$allProductsInCart = $stmt->fetchAll();

echo json_encode([
    "message" => "ok",
    "products" => $allProductsInCart
    ]);

