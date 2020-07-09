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

if (!isset($_POST)) {
    $json[] = [
        "code" => '404',
        "msgs" => 'Input Not Found',
        "token" => null
    ];

    $data['value'] = $json;

    echo json_encode($data);
    die();
}
extract($_POST);
$user = new Admin();

if ($_SESSION["user_details"]->id == $encodeId) {

    if ($newPassword !== $repeatPassword) {
        $json[] = [
            "code" => '400',
            "msgs" => 'Password did not Match',
            "token" => null
        ];

        $data['value'] = $json;

        echo json_encode($data);
        die();
    }

    $passwordCovert = selectField2("users_login", "password", "id", $_SESSION["user_details"]->id);
    $value = password_verify($oldPassword, $passwordCovert);
    if ($value === true) {
        try {
            $user->update('users_login', "id",  $_SESSION["user_details"]->id, array(
                "password"                    =>    Hash::make($newPassword),
            ));

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
            "code" => '400',
            "msgs" => 'Incorrect Old Password',
            "token" => null
        ];

        $data['value'] = $json;

        echo json_encode($data);
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
