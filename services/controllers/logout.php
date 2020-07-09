<?php
ini_set('display_errors', 1);
require_once("../../starter/header.php");

$user = new Admin();
$user->logout();
session_destroy();

echo json_encode(['success' => 'true']);
