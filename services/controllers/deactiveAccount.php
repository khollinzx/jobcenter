<?php
ini_set('display_errors', 1);
require_once("../../starter/header.php");

require ROOT_PATH . "vendor/autoload.php";

use \Firebase\JWT\JWT;

header('Content-Type: application/json');

$headers = apache_request_headers();

$token = $headers['Authorization'];

$jwt = strval($token);
$decoded = JWT::decode($jwt, $key, array('HS256'));

if (!$decoded) {
    $json[] = [
        "code" => '400',
        "msgs" => 'Authentication Failed',
        "token" => null
    ];

    $data['value'] = $json;

    echo json_encode($data);
    die();
}
$encodeId = json_encode(intval($decoded->data->id));

if ($_SESSION["user_details"]->id == $encodeId) {


    $user = new Admin();

    try {
        $user->deactiveAccount("users_details", "user_id", $_SESSION["user_details"]->id);
        $user->deactiveAccount("users_login", "id", $_SESSION["user_details"]->id);
        session_destroy();

        $json[] = [
            "code" => '200',
            "msgs" => 'OK',
            "token" => null
        ];

        $data['value'] = $json;

        echo json_encode($data);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {

    $json[] = [
        "code" => '404',
        "msgs" => 'Authorization Failed',
        "token" => null
    ];

    $data['value'] = $json;

    echo json_encode($data);
}
// }
