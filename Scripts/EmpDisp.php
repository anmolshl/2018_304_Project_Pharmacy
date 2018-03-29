<html lang="en" style="background-color: beige">
<?php

$userName = $_GET['userName'];
$custNo = $_GET['custNo'];

if(empty($userName)){
    header("Location: ../Interfaces/LoginPage.html");
}

echo $userName;

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
        <a href="EmpDisp.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>" style="text-decoration: none; color: #000000;">
            PharmTech
        </a>
    </b>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href=../Interfaces/FillPrescription.html?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Fill Prescriptions
    </a>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href="Restock.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Restock
    </a>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href="../Interfaces/LoginPage.html" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Logout
    </a>
</div>
</body>
</html>