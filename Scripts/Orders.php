<html lang="en" style="background-color: beige">
<head>
    <meta charset="UTF-8">
    <title>Welcome User!</title>
</head>
<body>
<h1 style="color: #001111;">Orders</h1>
<div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
    <b style="font-family: 'American Typewriter'; font-size: 30px">
        <a href="SQLConnect.php" style="text-decoration: none; color: #000000;">
            PharmTech
        </a>
    </b>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href="../Interfaces/LoginPage.html" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Logout
    </a>
</div>
</body>


<?php
require "SQLQuery.php";

$userName = $_GET[$userName];
$password = $_GET[$password];
$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    echo "<br>Connected to Oracle!</br>";
    $PrescriptionQuery = "SELECT drug_name, refill, expiration, prescription_number, issued_date, dosage FROM Prescription_orders WHERE username = '".$userName."'";
    $ociQuery = oci_parse($conn, $PrescriptionQuery);
    oci_execute($ociQuery);
    selectQuery($conn, $ociQuery);
    echo "<table border='1'>\n";
    echo "<tr>\n";
    echo "<td>Drug Name</td>\n";
    echo "<td>Refill</td>\n";
     echo "<td>Expiration</td>\n";
    echo "<td>Prescription_number</td>\n";
    echo "<td>Issued Date</td>\n";
     echo "<td>Dosage</td>\n";
    while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        foreach ($row as $item) {
            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";
    oci_close($conn);
}

?>

</html>



