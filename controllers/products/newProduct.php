<?php

include_once '../../core/Database.php';
include_once '../../objects/Product.php';

$db = new Database();
$conn = $db->getConnection();
$product = new Product($conn);
$data = json_decode(file_get_contents("php://input"));
$product->setName($data->name);
$product->setPrice($data->price);
$product->setDescription($data->description);
$product->setCategories($data->category);
$product->addProduct();

echo json_encode(["message" => "ok" ]);
