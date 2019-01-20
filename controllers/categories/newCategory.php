<?php

include_once '../../core/Database.php';
include_once '../../objects/Category.php';

$database = new Database();
$conn = $database->getConnection();
$category = new Category($conn);

$data = json_decode(file_get_contents("php://input"));

$categoryName = $data->name;
$category->setName($categoryName);
$stmt = $category->addCategory();
$num = $stmt->rowCount();

echo json_encode(["num" => $num]);
