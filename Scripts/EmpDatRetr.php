<?php
/**
 * Created by PhpStorm.
 * User: anmolsingh
 * Date: 2018-03-27
 * Time: 1:37 PM
 */

//TODO: create UI for Employee

$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    echo "<br>Connected to Oracle!</br>";
    session_start();
    if(!isset($_SESSION['userName'])){
        header('Location: ../Interfaces/LoginPage.html');
    }
    else{
        //TODO: create UI for Employee
    }
}