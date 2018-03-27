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
<form action="../Interfaces/LoginPage.html">
    <div class="container" align="center" style="margin-top: 20px;">
        <button type="submit" style="width: 70px">Login</button>
    </div>
</form>
<form action="../Interfaces/CustomerSignUp.html">
    <div class="container" align="center">
        <button type="submit" style="width: 70px;">Sign Up</button>
    </div>
</form>
<form action="UnregCustDatRetr.php">
    <div class="container" align="center">
        <button type="submit" style="width: 70px;">Guest</button>
    </div>
</form>
</body>
</html>