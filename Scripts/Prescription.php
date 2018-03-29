

<?php
require "SQLQuery.php";
$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    $name = $_GET['u_name'];
    $expire = $_GET['expire'];
    $refill = $_GET['refill'];
    $cnum = $_GET['c_num'];
    $issued = $_GET['issued_d'];
    $pnum = rand(10000, 99999);
    $userName = $_GET['userName'];

    $prescriptioninsQuery = "INSERT INTO Prescription(refill, expiration, customer_number, username, prescription_number, issued_date)
VALUES('" . $refill . "','" . $expire . "','" . $cnum . "','" . $name . "','" . $pnum . "','" . $issued . "')";

    $prescriptioninsParse = oci_parse($conn, $prescriptioninsQuery);
    insertQuery($conn, $prescriptioninsParse);
    oci_close($conn);
}


