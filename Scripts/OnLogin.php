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


$conn = oci_connect("ora_q5c1b", "a51931153", "dbhost.ugrad.cs.ubc.ca:1522/ug");
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}
else {
    echo "<br>Connected to Oracle!</br>";
    $userName2 = "select username from UserTab where username='".$userName."'";
    $password2 = "select password from UserTab where password='".$password."'";
    $ociuserName2 = oci_parse($conn, $userName2);
    oci_execute($ociuserName2);
    oci_fetch($ociuserName2, )
