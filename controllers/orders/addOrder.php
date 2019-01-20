<?php

include_once '../../objects/Order.php';
include_once '../../objects/Cart.php';
include_once '../../core/Database.php';

$database = new Database();
$conn  = $database->getConnection();
$order = new Order($conn);
$cart  = new Cart($conn);

$data = json_decode(file_get_contents("php://input"));
$userId = $data->userId;
$order->setUserId($userId);
$orderId = $order->addOrder();

if(false !== $orderId){
    $cart->setUserId($userId);
    $cart->setOrderId($orderId);
    $stmt = $cart->deleteUsersCart();
    $num = $stmt->rowCount();
    if($num > 0){
        echo json_encode([
            "message"  => "Order was created",
            "rowCount" => $stmt->rowCount()
        ]);
    }else{
        echo json_encode([
            "message" => "That already deleted"
        ]);
    }
}else{
    echo json_encode([
        "message" => "Order creating failed"
    ]);
}
