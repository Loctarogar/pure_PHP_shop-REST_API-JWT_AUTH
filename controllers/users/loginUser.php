<?php

include_once '../../core/Database.php';
include_once '../../core/jwtData.php';
include_once '../../objects/User.php';

use \Firebase\JWT\JWT;
include_once '../../php-jwt-master/src/BeforeValidException.php';
include_once '../../php-jwt-master/src/ExpiredException.php';
include_once '../../php-jwt-master/src/SignatureInvalidException.php';
include_once '../../php-jwt-master/src/JWT.php';

$database = new Database();
$conn = $database->getConnection();
$user = new User($conn);

$data = json_decode(file_get_contents("php://input"));
$dataEmail = $data->email;
$isEmailExists = $user->isEmailExists($dataEmail);


if($isEmailExists && password_verify($data->password, $user->password)){
    $token = [
        "iss"  => $iss,
        "aud"  => $aud,
        "iat"  => $iat,
        "nbf"  => $nbf,
        "data" => [
            "firstname" => $user->firstname,
            "lastname"  => $user->lastname,
            "email"     => $user->email
        ]
    ];
    $jwt = JWT::encode($token, $key);

    echo json_encode(["m" => "ok", "jwt" => $jwt]);
}else{
    echo json_encode(["m" => "not ok"]);
}