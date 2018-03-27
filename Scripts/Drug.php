<?php session_start();
?>

<!DOCTYPE html>
<html lang="en" style="background-color: beige">

<head>
    <meta charset="UTF-8">
    <title>Pharmtech - Add Drug</title>
</head>

<body>
<form action="Pharmacist.php" method="post">
    <div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
        <b style="font-family: 'American Typewriter'; font-size: 30px">
            <a href="SQLConnect.php" style="text-decoration: none; color: #000000;">
                PharmTech
            </a>
        </b>
    </div>
    <div class="container" align="center">
        <input name="refill" type="boolean" name="refill" placeholder="Refill?" required>
    </div>
    <div class="container" align="center">
        <input name="expir" type="date" name="expir" placeholder="Expiration" required>
    </div>
    <div class="container" align="center">
        <input name="c_num" type="number" name="c_num" placeholder="Customer Number" required>
    </div>
    <div class="container" align="center">
        <input name="u_name" type="number" name="u_name" placeholder="Customer Name" required>
    </div>
    <div class="container" align="center">
        <input name="issued_d" type="date" name="issued_d" placeholder="Issued Date" required>
    </div>
    <div class="container" align="center" style="margin-top: 20px;">
        <button type="submit">Submit</button>
    </div>
</form>

</body>

<?php
$conn = oci_connect("ora_q5c1b", "a51931153", "dbhost.ugrad.cs.ubc.ca:1522/ug");
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}
else {
    $u_name = $_POST['u_name'];
    $refill = $_POST['refill'];
    $expir = $_POST['expir'];
    $c_num = $_POST['c_num'];
    $issued_d = $_POST['issued_d'];
    $p_num = rand(10000, 99999);
    $_SESSION['p_num'] = $p_num;


    $prescriptionWrite = "insert into Prescription(refill,expiration, customer_number, username, prescription_number, issued_date)
                              VALUES ('" . $refill . "' ,'" . $expir . "','" . $c_num . "','" . $_uname . ",'" . $p_num . "', '" . $issued_d . "')";

    if($prescriptionWrite){
        echo 'Insert Successfully';
    }
}
/*$s_loc = $_GET['s_loc'];
$u_name = $_GET['u_name'];
$s_add = $_GET['s_add'];
$d_name = $_GET['d_name'];
$refill = $_GET['refill'];
$expir = $_GET['expir'];
$c_num = $_GET['c_num'];
$issued_d = $_GET['issued_d'];
$dosage = $_GET['dosage'];*/
/*$prescriptionWrite = "insert into Prescription_orders(store_location, username, store_address, drug_name, refill,
                                                          expiration, customer_number, prescription_number, issued_date, dosage)
                          VALUES ('".$s_loc."','".$_uname."','".$s_add."','".$d_name."','".$d_name."','".$refill."'
                                    ,'".$expir."','".$c_num."','".$p_num."', '".$issued_d."', '".$dosage."')";*/

?>

</html>