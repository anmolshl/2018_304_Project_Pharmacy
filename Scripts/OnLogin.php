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
    $userName2 = "select username from UserTab where username='".$userName."'";
    $password2 = "select password from UserTab where password='".$password."'";
    $ociuserName2 = oci_parse($conn, $userName2);
    oci_execute($ociuserName2);
    while (oci_fetch($ociuserName2)) {
        echo oci_result($ociuserName2, 'USERNAME');
        }
    }

