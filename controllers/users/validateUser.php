<?php

include_once '../../core/jwtData.php';
use \Firebase\JWT\JWT;
include_once '../../php-jwt-master/src/BeforeValidException.php';
include_once '../../php-jwt-master/src/ExpiredException.php';
include_once '../../php-jwt-master/src/SignatureInvalidException.php';
include_once '../../php-jwt-master/src/JWT.php';

$data = json_decode(file_get_contents("php://input"));
if(isset($data->jwt)){
    $jwtToken = $data->jwt;
}else{
    $jwtToken = false;
}
if(false !== $jwtToken){
    $decodedUserData = JWT::decode($jwtToken, $key, ['HS256']);
    echo json_encode([
        "status"  => "true",
        "user"    => $decodedUserData->data
    ]);

    return true;
}
