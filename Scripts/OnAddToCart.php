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
    $drugDet = array();
    $drugDetParsed = array();

    parse_str($_GET['drugDet'], $drugDet);

    $drugDetx = $drugDet[0];
    $drugName = $drugDetx[0];
    $drugType = $drugDetx[1];
    $userName = $drugDet[2];
    $custNo = $drugDet[3]
    $price = $drugDetx[3];

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
    echo $userName;
    echo $custNo;
    //header("Location: RegDisp.php?cartArr=".$URLquery."&userName=".$userName."&custNo=".$custNo);
}
?>