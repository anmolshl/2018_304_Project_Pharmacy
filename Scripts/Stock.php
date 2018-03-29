
<?php
//print this information of this stock
include '../Interfaces/EmployeeUI/StockPage.html';
oraConnect();
if (isset($_GET['stock_ID'])) {
    $s_id = $_GET['stock_ID'];
    $query = "select * from Stock where stock_ID = '".$s_id."'";
    selectQuery($query, $conn);
}
if (isset($_GET['restock']))
{
    $query = "insert into stock_stores_drugs VALUES ('".$_GET['drug_add']."','".$_GET['drug_name']."','".$_GET['stock_ID']."')";
    insertQuery($query, $conn);
}
if (isset($_GET['drug_name'])){
    $s_id = $_GET['drug_name'];
    $query = "select * from Stock where stock_ID = '".$s_id."'";
    selectQuery($query, $conn);
}
?>



