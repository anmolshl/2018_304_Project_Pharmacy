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

    $drugName = $_GET['2'];
    $drugType = $_GET['3'];
    $userName = $_GET['0'];
    $custNo = $_GET['1'];
    $price = $_GET['4'];

    echo $drugType;
    echo $drugName;
    echo $price;

    $cartArr = array();
    $i = 7;
    while (!empty($_GET[strval($i)])){
        array_push($cartArr, $_GET[strval($i)]);
        $i++;
    }

    $i = 0;

    array_push($cartArr, $drugName);
    array_push($cartArr, $drugType);
    array_push($cartArr, $price);

    $queryArrUnparsed = array();

    array_push($queryArrUnparsed, $userName);
    array_push($queryArrUnparsed, $custNo);

    foreach ($cartArr as $cartx){
        array_push($queryArrUnparsed, $cartx);
    }

    $URLquery = http_build_query($queryArrUnparsed);
    echo $userName;
    echo $custNo;
    header("Location: RegDisp.php?".$URLquery);
}
?>