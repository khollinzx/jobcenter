<?php
// Calling the core 
require_once("../starter/header.php");

// getting the page to be displayed
if (!isset($_GET["pg"]) || $_GET["pg"] == "") {
    $_GET["pg"] = "login";
}

// calling the Admin class
$user = new Admin();

// checking if the user is logged in already
if ($user->isLoggedin()) {
    // Get the user data
    $_SESSION['user_details'];
}

// Check if pg exits
if (isset($_GET["pg"])) {
    //If pg exists, assign its value to $page_name
    $page_name = $_GET["pg"];
    $linkTitle = $page_name;
}

// checking if the user deatils has been assigned to the SESSSION Class
if (isset($_SESSION["user_details"])) {


    // passing the page to a variavble $filename
    $filename = ROOT_PATH . "users/pages/" . $page_name . ".php";

    //checking if the file exist
    if (file_exists($filename)) {

        /**
         * Calling in the Header
         * and Navbar
         */
        include(ROOT_PATH . 'inc/header.php');

        include(ROOT_PATH . 'inc/navbar.php');

        // Display the page
        include(ROOT_PATH . 'users/pages/' . $page_name . '.php');
        // calling the footer
        include(ROOT_PATH . 'inc/footer.php');
    } else {

        /**
         * if the page does not exist
         * page not found will be display
         */
        include(ROOT_PATH . 'inc/loginheader.php');
        include(ROOT_PATH . "users/pages/page-not-found.php");
    }
} else {
    // Redirect to Login page if the user is not logged in
    Redirect::to("../");
}
