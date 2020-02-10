<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions
session_start();



function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$products = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

$totalValue = 0;



function test_input($data) {
    $data = trim($data);
//  $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$emailErr = $streetErr = $streetnumberErr = $cityErr = $zipcodeErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "<div class=\"alert alert-danger\" role=\"alert\">Email is required</div>";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "<div class=\"alert alert-danger\" role=\"alert\">Invalid email format</div>";
        }
    }
    if (empty($_POST["street"])) {
        $streetErr = "<div class=\"alert alert-danger\" role=\"alert\">Street name is required</div>";
    }
    if (empty($_POST["streetnumber"])) {
        $streetnumberErr = "<div class=\"alert alert-danger\" role=\"alert\">Street number is required</div>";
    } else {
        $streetnumber = $_POST["streetnumber"];
        if (!is_numeric($streetnumber)) {
            $streetnumberErr = "<div class=\"alert alert-danger\" role=\"alert\">Invalid street number</div>";
        }
    }
    if (empty($_POST["city"])) {
        $cityErr = "<div class=\"alert alert-danger\" role=\"alert\">City is required</div>";
    }
    if (empty($_POST["zipcode"])) {
        $zipcodeErr = "<div class=\"alert alert-danger\" role=\"alert\">Zipcode is required</div>";
    } else {
        $zipcode = $_POST["zipcode"];
        if (!is_numeric($zipcode)) {
            $zipcodeErr = "<div class=\"alert alert-danger\" role=\"alert\">Invalid zip code</div>";
        }
    }
}

require 'form-view.php';