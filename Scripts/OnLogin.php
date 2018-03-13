<?php
/**
 * Created by PhpStorm.
 * User: anmolsingh
 * Date: 2018-02-18
 * Time: 9:06 PM
 */

require "PasswordScripts.php";

//Get data from HTML form
$dom = new DOMDocument();
$dom->loadHTMLFile("../Interfaces/LoginPage.html");
$userName = $dom->getElementById("userName");
$password = $dom->getElementById("password");

