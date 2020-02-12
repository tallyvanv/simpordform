<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions
session_start();

/*function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}
whatIsHappening();*/
//your products with their price.

$dranks = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];
$food = [
    ['name' => 'Club vegan cheese', 'price' => 3.20],
    ['name' => 'Club vegan Cheese', 'price' => 3],
    ['name' => 'Club vegan Cheese & Ham', 'price' => 4],
    ['name' => 'Club vegan Chicken', 'price' => 4],
    ['name' => 'Club vegan Salmon', 'price' => 5]
];

$products = $dranks;
if (isset($_GET["food"])) {
    if ($_GET["food"] == 1) {
        $products = $food;
    } else {
        $products = $dranks;
    }
}
$totalValue = 0;
$valueArr = [];

if (isset($_POST["products"])) {
    foreach ($products AS $i => $product) {
        if ($_POST['products'][$i] == '1') {
            array_push($valueArr, $product['price']);
        }
    }
}

$totalValue = array_sum($valueArr);

if (!isset($_COOKIE["totalspend"])) {
    setcookie("totalspend", strval($totalValue));
}
else {
    $spendCookie = $_COOKIE["totalspend"] + $totalValue;
    setcookie("totalspend", strval($totalValue + $_COOKIE["totalspend"]));
}
var_dump($totalValue);
var_dump($spendCookie);

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

if (isset($_SESSION)) {
 if (isset($_SESSION["street"]) && isset($_SESSION['streetnumber']) && isset($_SESSION['city']) && isset($_SESSION['city']) && isset($_SESSION['zipcode']))
 {
     $street = $_SESSION["street"];
     $streetnumber = $_SESSION['streetnumber'];
     $city = $_SESSION['city'];
     $zipcode = $_SESSION['zipcode'];
 }
}

require 'form-view.php';