<?php
/**
 * Created by PhpStorm.
 * User: anmolsingh
 * Date: 2018-03-27
 * Time: 3:14 PM
 */
require "SQLQuery.php";
$conn = oraConnect();
if(!$conn){
    exit;
}
else{
    $drugName = $_GET['drugName'];
    $drugType = $_GET['drugType'];
    $userName = $_GET['userName'];
    $custNo = $_GET['custNo'];
    $price = $_GET['price'];

    echo $drugType;
    echo $drugName;
    echo $price;


    $rowArr = array();
    array_push($rowArr, $drugName);
    array_push($rowArr, $drugType);
    array_push($rowArr, $price);

    $cartArr = $_GET['$cartArray'];
    if(empty($cartArr)){
        $cartArr = array();
    }
    array_push($cartArr, $rowArr);

    $URLquery = http_build_query($cartArr);
    header("Location: RegDisp.php?cartArr=".$URLquery."&userName=".$userName."&custNo=".$custNo);
}
?>