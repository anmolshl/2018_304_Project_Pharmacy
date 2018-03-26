<?php session_start();
?>
/**
* Created by PhpStorm.
* User: lilinjian
* Date: 25/03/2018
* Time: 15:18
*/
<!DOCTYPE html>
<html lang="en" style="background-color: beige">
<head>
    <meta charset="UTF-8">
    <title>Pharmtech - Sign up</title>
</head>
<body>
<form>
    <div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
        <b style="font-family: 'American Typewriter'; font-size: 30px">PharmTech</b>
    </div>
    <div class="container" align="center">
        <input id="s_loc" type="text" name="s_loc" placeholder="Store Location" required>
    </div>
    <div class="container" align="center">
        <input id="u_name" type="text" name="u_name" placeholder="User Name" required>
    </div>
    <div class="container" align="center">
        <input id="s_add" type="text" name="s_add" placeholder="Store Address" required>
    </div>
    <div class="container" align="center">
        <input id="d_name" type="text" name="d_name" placeholder="Drug Name" required>
    </div>
    <div class="container" align="center">
        <input id="refill" type="boolean" name="refill" placeholder="Refill?" required>
    </div>
    <div class="container" align="center">
        <input id="expir" type="date" name="expir" placeholder="Expiration" required>
    </div>
    <div class="container" align="center">
        <input id="c_num" type="number" name="c_num" placeholder="Customer Number" required>
    </div>
    <div class="container" align="center">
        <input id="issued_d" type="date" name="issued_d" placeholder="Issued Date" required>
    </div>
    <div class="container" align="center">
        <input id="dosage" type="number" name="dosage" placeholder="Dosage" required>
    </div>
</form>
</body>
<?php
/*$s_loc = $_GET['s_loc'];
$u_name = $_GET['u_name'];
$s_add = $_GET['s_add'];
$d_name = $_GET['d_name'];
$refill = $_GET['refill'];
$expir = $_GET['expir'];
$c_num = $_GET['c_num'];
$issued_d = $_GET['issued_d'];
$dosage = $_GET['dosage'];*/
$p_num = rand(10000,99999);
/*$prescriptionWrite = "insert into Prescription_orders(store_location, username, store_address, drug_name, refill,
                                                          expiration, customer_number, prescription_number, issued_date, dosage)
                          VALUES ('".$s_loc."','".$_uname."','".$s_add."','".$d_name."','".$d_name."','".$refill."'
                                    ,'".$expir."','".$c_num."','".$p_num."', '".$issued_d."', '".$dosage."')";*/
$_SESSION['p_num'] = $p_num;
?>
<form action="Pharmacist.php" method="GET">
    <div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
        <b style="font-family: 'American Typewriter'; font-size: 30px">PharmTech</b>
    </div>
    <input type="submit" value="submit">
</form>
</html>