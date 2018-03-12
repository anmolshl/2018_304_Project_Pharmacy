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

