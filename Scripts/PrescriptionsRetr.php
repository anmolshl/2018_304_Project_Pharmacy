<html>

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
    $PrescriptionQuery = "SELECT drug_name, refill, expiration, issued_date, dosage FROM Prescription_orders WHERE username = '" . $userName . "'";
    $ociQuery = oci_parse($conn, $PrescriptionQuery);
    oci_execute($ociQuery);
    selectQuery($conn, $ociQuery);
    echo "<table border='1'>\n";
    echo "<tr>\n";
    echo "<td>Drug Name</td>\n";
    echo "<td>Refill</td>\n";
    echo "<td>Expiration</td>\n";
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