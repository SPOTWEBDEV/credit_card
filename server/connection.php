<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function checkUrlProtocol($url)
{
    $parsedUrl = parse_url($url);
    return isset($parsedUrl['scheme']) ? $parsedUrl['scheme'] : 'invalid';
}

// Automatically get the current URL
$currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
    . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// Get the protocol from the current URL
$request = checkUrlProtocol($currentUrl);

// Default configurations
define("HOST", "localhost");

// Determine if online or offline
$isLocalhost = ($_SERVER['HTTP_HOST'] === 'localhost');

// Database connection (Only use one based on environment)


if ($isLocalhost) {
    // Offline (Localhost)
    $domain = "http://localhost/credit_card/";

    define("USER", "root");
    define("PASSWORD", "");
    define("DATABASE", "credit_card");

    // Database connection
    $connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
} else {
    // Online (Live Server)
    $domain = "https://grubsp.com/";

    define("USER", "josemaka_grubsp");
    define("PASSWORD", "josemaka_grubsp");
    define("DATABASE", "josemaka_grubsp");

    // Database connection
    $connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
}



$sitename = "Grub Shop";



$crypto_options = [
    'Exodus wallet' => 'bc1qgzd0yxxqsxwhdtcudnkgjqakdajdyplhtdn0q2',
];


function maskCardNumber($number)
{
    $last4 = substr($number, -4);
    $maskedLength = strlen($number) - 4;
    $maskedPart = str_repeat('*', $maskedLength) . $last4;
    return trim(chunk_split($maskedPart, 4, ' '));
}





session_start();


?>