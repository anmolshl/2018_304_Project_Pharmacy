
<?php
require "34_project_final_SQLQuery.php";
$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    $name = $_GET['u_name'];

    $deleteQuery = "DELETE FROM Customer WHERE username='".$name."'";
    $deleteParse = oci_parse($conn, $deleteQuery);
    oci_execute($deleteParse);

    $deleteQuery = "DELETE FROM RegCustomer WHERE username='".$name."'";
    $deleteParse = oci_parse($conn, $deleteQuery);
    oci_execute($deleteParse);

    $deleteQuery = "DELETE FROM UserTab WHERE username='".$name."'";
    $deleteParse = oci_parse($conn, $deleteQuery);
    oci_execute($deleteParse);

    header("Location: 34_project_final_DeleteUser.php");
}
