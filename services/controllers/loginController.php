<?php
ini_set('display_errors', 1);
require_once("../../starter/header.php");

require ROOT_PATH . "vendor/autoload.php";

use \Firebase\JWT\JWT;


if (Input::exists()) {
    $validate = new Validation();
    $validation = $validate->check($_POST, array(
        "username"                     => array('required' => true),
        "password"                 => array('required' => true)
    ));
    if ($validation->passed()) {

        $user = new Admin();

        $username = Input::get('username');
        $password = Input::get('password');


        try {

            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login($username, $password, $remember, "users_login", "username");

            if ($login === true) {

                $user_metadata = array(
                    $payload,
                    "data" => array(
                        "id" => $user->data()->id,
                        "email" => $user->data()->username,
                        "token_id" => $user->data()->token_id
                    )
                );

                $jwtToken = JWT::encode($user_metadata, $key);

                $json[] = [
                    "code" => '200',
                    "msgs" => 'OK',
                    "token" => $jwtToken
                ];

                $data['value'] = $json;

                echo json_encode($data);
            } else {
                $json[] = [
                    "code" => '400',
                    "msgs" => 'Invalid Username Or Password',
                    "token" => null
                ];

                $data['value'] = $json;

                echo json_encode($data);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
} else {
    $json[] = [
        "code" => '404',
        "msgs" => 'Input Not Found',
        "token" => null
    ];

    $data['value'] = $json;

    echo json_encode($data);
    die();
}
