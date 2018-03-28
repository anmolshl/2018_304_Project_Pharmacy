<html lang="en" style="background-color: beige">
<?php

$userName = $_GET['userName'];
$custNo = $_GET['custNo'];

if(empty($userName) || empty($custNo)){
    header("Location: ../Interfaces/LoginPage.html");
}

echo $userName;
echo $custNo;

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
    <title>PUser Home</title>
</head>
<body>
<div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
    <b style="font-family: 'American Typewriter'; font-size: 30px">
        <a href="RegDisp.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>" style="text-decoration: none; color: #000000;">
            PharmTech
        </a>
    </b>
</div>
<form action="SearchPage.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>">
    <div class="container" align="center" style="margin-top: 20px;">
        <button type="submit" style="width: 70px">Search</button>
    </div>
</form>
<form action="PrescriptionsRetr.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>">
    <div class="container" align="center">
        <button type="submit" style="width: 80px;">Prescriptions</button>
    </div>
</form>
<form action="SearchPage.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>">
    <div class="container" align="center">
        <button type="submit" style="width: 70px;">Orders</button>
    </div>
</form>
</form>
<form action="../Interfaces/LoginPage.html">
    <div class="container" align="center">
        <button type="submit" style="width: 70px;">Logout</button>
    </div>
</form>
</body>
</html>