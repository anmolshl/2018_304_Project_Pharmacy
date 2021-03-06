<html lang="en" style="background-color: beige">
<head>
    <meta charset="UTF-8">
    <title>Welcome User!</title>
</head>
<body>
<h1 style="color: #001111;">Prescriptions</h1>
<div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
    <b style="font-family: 'American Typewriter'; font-size: 30px">
        <a href="34_project_final_SQLConnect.php" style="text-decoration: none; color: #000000;">
            PharmTech
        </a>
    </b>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href="../Interfaces/34_project_final_LoginPage.html" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Logout
    </a>
</div>
</body>


<?php
require "34_project_final_SQLQuery.php";

$userName = $_GET['userName'];
$password = $_GET['custNo'];
$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    echo "<br>Connected to Oracle!</br>";
    date_default_timezone_set('Canada/Vancouver');
    $date = date('d-m-Y');
    echo "$date";
    $PrescriptionQuery = "SELECT expiration, prescription_number, issued_date FROM Prescription WHERE username = '".$userName."' AND expiration >= CAST(CURRENT_TIMESTAMP AS DATE)";
    $ociQuery = oci_parse($conn, $PrescriptionQuery);
    oci_execute($ociQuery);
    selectQuery($conn, $ociQuery);
    echo "<table border='1' align='center'>\n";
    echo "<tr>\n";
    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Expiration</td>\n";
    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Prescription_number</td>\n";
    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Issued Date</td>\n";
    while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        foreach ($row as $item) {
            echo "    <td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";
    oci_close($conn);
}

?>

</html>