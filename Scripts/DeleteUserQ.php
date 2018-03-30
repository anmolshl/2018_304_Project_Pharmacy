
<?php
require "SQLQuery.php";
$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    $name = $_GET['u_name'];

    $deleteQuery = "DELETE FROM Customer WHERE username='".$name."'";
    $deleteParse = oci_parse($conn, $deleteQuery);
    oci_execute($deleteParse);
}
