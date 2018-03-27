<?php
/**
 * Created by PhpStorm.
 * User: anmolsingh
 * Date: 2018-02-18
 * Time: 9:06 PM
 */

require "PasswordScripts.php";
require "SQLConnect.php";

//Get data from HTML form
$dom = new DOMDocument();
$dom->loadHTMLFile("../Interfaces/LoginPage.html");
$userName = $dom->getElementById("userName");
$password = $dom->getElementById("password");


$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    echo "<br>Connected to Oracle!</br>";
    $userName2 = "select username from UserTab where drug_name='".$userName."'";
    $password2 = "select password from UserTab where password='".$password."'";
    $ociuserName2 = oci_parse($conn, $userName2);
    $ocipassword2 = oci_parse($conn, $password2);
    if ($password == $ocipassword2 && $userName == $ociuserName2) {
        header("RegCustDatRetr.php");
    }
    else {
        echo "Please try again, wrong username or password\n";
    }
    }
