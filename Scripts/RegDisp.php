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
    $cartArr = $_GET['cartArr'];
}
?>

<head>
    <meta charset="UTF-8">
    <title>PUser Home</title>
</head>
<body>
<?php
$cartArrParsed = array();
parse_str($cartArr,$cartArrParsed);
echo "<div align=\"center\" style=\"margin-bottom: 40px; margin-top: 20px; background-color: red\">";
echo "<a href=\"Cart.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>&cartArr=<?php if(!empty($cartArr)){echo $cartArr;} ?>\" style=\"text-decoration: none; color: #000000;\">Cart(".count($cartArrParsed).")</a>";
echo "</div>"
?>
<div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
    <b style="font-family: 'American Typewriter'; font-size: 30px">
        <a href="RegDisp.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>&cartArr=<?php if(!empty($cartArr)){echo $cartArr;} ?>" style="text-decoration: none; color: #000000;">
            PharmTech
        </a>
    </b>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href="SearchPage.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>&cartArr=<?php if(!empty($cartArr)){echo $cartArr;} ?>" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Search Drugs
    </a>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href=PrescriptionsRetr.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>&cartArr=<?php if(!empty($cartArr)){echo $cartArr;} ?>" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Prescriptions
    </a>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href="Orders.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>&cartArr=<?php if(!empty($cartArr)){echo $cartArr;} ?>" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Orders
    </a>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href="../Interfaces/LoginPage.html" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Logout
    </a>
</div>
</body>
</html>