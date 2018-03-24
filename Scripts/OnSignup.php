<?php
/**
 * Created by PhpStorm.
 * User: anmolsingh
 * Date: 2018-03-12
 * Time: 12:30 PM
 */

require "PasswordScripts.php";

//Get data from HTML form
$dom = new DOMDocument();
$dom->loadHTMLFile("../Interfaces/CustomerSignUp.html");
$userName = $dom->getElementById("userName");
$password1 = $dom->getElementById("password1");
$password2 = $dom->getElementById("password2");
$address = $dom->getElementById("address");
$dob = $dom->getElementById("dob");
$name = $dom->getElementById("name");

if($password1 == $password2){
    $queryUserTable = "INSERT INTO UserTab (userename, password) VALUES (".$userName.", ".$password1.");";
    $queryUserTable = "INSERT INTO Customer (userename, name, address, dob) VALUES (".$userName.", ".$name.", ".$address.", ".dob.");";
}
else{
    echo "Invalid! Please try again";
}
