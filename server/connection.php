<?php


$domain = "http://localhost/credit_card/";

$connection = mysqli_connect('localhost','root','','credit_card');


if(!$connection){
    die('Server Error => ERROR 500 ');
}

session_start();


?>