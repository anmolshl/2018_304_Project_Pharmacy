<?php
/**
 * Created by PhpStorm.
 * User: lilinjian
 * Date: 28/03/2018
 * Time: 23:59
 */
require "34_project_final_SQLQuery.php";

$userName = $_GET[$userName];
$password = $_GET[$password];
$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    echo "<br>Connected to Oracle!</br>";
    date_default_timezone_set('Canada/Vancouver');
    $date = date('d-m-Y');
    echo "$date";
    if(isset($_GET['check_all']))$EmoloyeeQuery = "SELECT * FROM Pharmtech";
    if(isset($_GET['check_by_name'])){
        $name = $_GET['check_by_name'];
        $EmoloyeeQuery = "SELECT * FROM Pharmtech WHERE name = ".$name."'";
    }

    $ociQuery = oci_parse($conn, $PrescriptionQuery);
    oci_execute($ociQuery);
    selectQuery($conn, $ociQuery);
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