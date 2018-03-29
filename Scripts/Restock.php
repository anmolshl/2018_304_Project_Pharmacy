
<?php
require "SQLQuery.php";
$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    $restock = $_GET['quantity'];
    $drug_name = $_GET['drug_name'];
    echo "$restock\n";
    echo "$drug_name\n";


    $retrstockQuery = "SELECT quantity FROM Drugs WHERE drug_name='".$drug_name."'";
    $ociQuery = oci_parse($conn, $retrstockQuery);
    selectQuery($conn, $ociQuery);
    while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        foreach ($row as $item) {
            $fetch = $item + $restock;
            echo "$item\n";
        }
        }
    echo "$fetch\n";
    $restockQuery = "UPDATE Drugs SET quantity = '".$fetch."' WHERE drug_name = '".$drug_name."'";
    $restockParse = oci_parse($conn, $retstockQuery);
    $result = oci_execute($restockParse, OCI_COMMIT_ON_SUCCESS);
    if(!$result){
    echo oci_error();}
    }
    oci_free_statement($restockParse);



