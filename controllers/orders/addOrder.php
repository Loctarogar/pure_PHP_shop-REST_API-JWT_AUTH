<?php

include_once '../../objects/Order.php';
include_once '../../objects/Cart.php';
include_once '../../core/Database.php';

$database = new Database();
$conn  = $database->getConnection();
//$order = new Order($conn);
$cart  = new Cart($conn);

$data = json_decode(file_get_contents("php://input"));
$userId = $data->userId;
$orderId = 1;
$cart->setUserId($userId);
$cart->setOrderId($orderId);

$stmt = $cart->deleteUsersCart();
$stmt->fetchAll();
echo json_encode([
    "message" => $stmt
]);