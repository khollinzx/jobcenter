<?php
ini_set('display_errors', 1);
require_once("../../starter/header.php");

require ROOT_PATH . "vendor/autoload.php";

use \Firebase\JWT\JWT;

$token_id = Token::generate();

if (Input::exists()) {
    $validate = new Validation();
    $validation = $validate->check($_POST, array(
        "firstName"                     => array('required' => true),
        "lastName"                 => array('required' => true),
        "email"                 => array('required' => true),
        "country"                 => array('required' => true),
        "phoneNumber"                => array('required' => true),
        "newpassword"                => array('required' => true),
        "confirmPassword"                => array('required' => true)
    ));
    if ($validation->passed()) {

        $user = new Admin();

        $firstName = strtolower(Input::get('firstName'));
        $lastName = strtolower(Input::get('lastName'));
        $emailAddress = Input::get('email');
        $password = Input::get('newpassword');
        $confirmPassword = Input::get('confirmPassword');
        $country = Input::get('country');
        $phoneNumber = Input::get('phoneNumber');
        $image = "user.png";


        try {

            if ($password !== $confirmPassword) {
                $json[] = [
                    "code" => '400',
                    "msgs" => 'Password did not Match',
                    "token" => null
                ];

                $data['value'] = $json;

                echo json_encode($data);
                die();
            }

            $checkIfExist = selectExistUser('users_login', 'username', $emailAddress);

            if ($checkIfExist !== 0) {
                $json[] = [
                    "code" => '400',
                    "msgs" => 'User already exist',
                    "token" => null
                ];

                $data['value'] = $json;

                echo json_encode($data);
                die();
            } else {

                $user->create('users_login', array(
                    "username"                     =>    $emailAddress,
                    "password"                     =>    Hash::make($password),
                    "token_id"            =>    $token_id,
                ));

                $select = select_individual_id('id', 'users_login', 'token_id', $token_id);

                $user->create('users_details', array(
                    "user_id"                     =>    $select['id'],
                    "firstName"                 =>    $firstName,
                    "image"                 =>    $image,
                    "lastName"                     =>   $lastName,
                    "country"                 =>    $country,
                    "phoneNumber"            => $phoneNumber,
                    "token_id"                     =>    $token_id
                ));

                $remember = (Input::get('remember') === 'on') ? true : false;
                $login = $user->login($emailAddress, $password, $remember, "users_login", "username");

                if ($login === true) {


                    $user_metadata = array(
                        $payload,
                        "data" => array(
                            "id" => $user->data()->id,
                            "email" => $user->data()->username,
                            "token_id" => $user->data()->token_id
                        )
                    );

                    $_SESSION["user_details"] = $user->data();

                    $jwtToken = JWT::encode($user_metadata, $key);

                    $json[] = [
                        "code" => '200',
                        "msgs" => 'OK',
                        "token" => $jwtToken
                    ];

                    $data['value'] = $json;

                    echo json_encode($data);
                }
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
