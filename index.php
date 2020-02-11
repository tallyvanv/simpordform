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
whatIsHappening();
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

function whichItems(){
    if(isset($_GET['food'])) {
        switch ($_GET['food']) {
            case '1':
                return $products = [
                    ['name' => 'Club Ham', 'price' => 3.20],
                    ['name' => 'Club Cheese', 'price' => 3],
                    ['name' => 'Club Cheese & Ham', 'price' => 4],
                    ['name' => 'Club Chicken', 'price' => 4],
                    ['name' => 'Club Salmon', 'price' => 5]
                ];
                break;
            default:
                return $products = [
                    ['name' => 'Cola', 'price' => 2],
                    ['name' => 'Fanta', 'price' => 2],
                    ['name' => 'Sprite', 'price' => 2],
                    ['name' => 'Ice-tea', 'price' => 3],
                ];
        }
    }
    else {
        return $products = [
            ['name' => 'Cola', 'price' => 2],
            ['name' => 'Fanta', 'price' => 2],
            ['name' => 'Sprite', 'price' => 2],
            ['name' => 'Ice-tea', 'price' => 3],
        ];}
}




$totalValue = 0;



function test_input($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}

$errArr = [];
$emailErr = $streetErr = $streetnumberErr = $cityErr = $zipcodeErr = "";
$email = $street = $streetnumber = $city = $zipcode = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "<div class=\"alert alert-danger\" role=\"alert\">Email is required</div>";
        array_push($errArr, $emailErr);
    } else  {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "<div class=\"alert alert-danger\" role=\"alert\">Invalid email format</div>";
            array_push($errArr, $emailErr);
        }
    }
    // hier is valid en opslagen in session
    if (empty($_POST["street"])) {
        $streetErr = "<div class=\"alert alert-danger\" role=\"alert\">Street name is required</div>";
        array_push($errArr, $streetErr);
    }
    else {
        $street = $_SESSION["street"] = $_POST["street"];
    }
    if (empty($_POST["streetnumber"])) {
        $streetnumberErr = "<div class=\"alert alert-danger\" role=\"alert\">Street number is required</div>";
        array_push($errArr, $streetnumberErr);
    } else {
        $streetnumber = $_SESSION['streetnumber'] = $_POST["streetnumber"];
        if (!is_numeric($_POST["streetnumber"])) {
            $streetnumberErr = "<div class=\"alert alert-danger\" role=\"alert\">Invalid street number</div>";
            array_push($errArr, $streetnumberErr);
        }
    }
    if (empty($_POST["city"])) {
        $cityErr = "<div class=\"alert alert-danger\" role=\"alert\">City is required</div>";
        array_push($errArr, $cityErr);
    }
    else {
        $city = $_SESSION['city'] = $_POST["city"];

    }
    if (empty($_POST["zipcode"])) {
        $zipcodeErr = "<div class=\"alert alert-danger\" role=\"alert\">Zipcode is required</div>";
        array_push($errArr, $zipcodeErr);
    } else {
        $zipcode = $_SESSION['zipcode'] = $_POST["zipcode"];
        if (!is_numeric($_POST["zipcode"])) {
            $zipcodeErr = "<div class=\"alert alert-danger\" role=\"alert\">Invalid zip code</div>";
            array_push($errArr, $zipcodeErr);
        }
    }
    if (empty($errArr)) {
        echo "is all good";
    }
}
var_dump($_SESSION["street"]);

if (isset($_SESSION)) {
    $street = $_SESSION["street"];
    $streetnumber = $_SESSION['streetnumber'];
    $city = $_SESSION['city'];
    $zipcode = $_SESSION['zipcode'];
}

require 'form-view.php';