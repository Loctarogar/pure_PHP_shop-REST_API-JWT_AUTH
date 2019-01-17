<?php

include_once '../../core/Database.php';
include_once '../../objects/User.php';

$database = new Database();
$conn = $database->getConnection();
$user = new User($conn);

$data = json_decode(file_get_contents("php://input"));
$user->firstname = $data->firstname;
$user->lastname = $data->lastname;
$user->email = $data->email;
$user->password = $data->password;

if($user->addUser()){
    echo json_encode(["message" => "User successfully created"]);
}else{
    echo json_encode(["message" => "An error occur"]);
}