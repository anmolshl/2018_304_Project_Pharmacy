<html lang="en" style="background-color: beige">
<?php
/**
 * Created by PhpStorm.
 * User: anmolsingh
 * Date: 2018-03-13
 * Time: 10:36 AM
 */
require "SQLQuery.php";

$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    print "Connected to Oracle!";
}
?>

<head>
    <meta charset="UTF-8">
    <title>Pharmtech - Home</title>
</head>
<body>
<div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
    <b style="font-family: 'American Typewriter'; font-size: 30px">
        <a href="SQLConnect.php" style="text-decoration: none; color: #000000;">
            PharmTech
        </a>
    </b>
</div>
<div align="center" >
    <b style="font-family: 'American Typewriter'; font-size: 15px">Online drug reservation system</b>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href="../Interfaces/LoginPage.html" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Login
    </a>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href="../Interfaces/CustomerSignUp.html" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Sign Up
    </a>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href="SearchPage.php" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Continue as Guest
    </a>
</div>
</body>
</html>