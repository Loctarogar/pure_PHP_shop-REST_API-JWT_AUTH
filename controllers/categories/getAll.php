<?php

include_once '../../core/Database.php';
include_once '../../objects/Category.php';

$database = new Database();
$db = $database->getConnection();
$category = new Category($db);
$categories = $category->getAll();


echo json_encode($categories->fetchAll());