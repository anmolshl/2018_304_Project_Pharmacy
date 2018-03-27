<?php
/**
 * Created by PhpStorm.
 * User: anmolsingh
 * Date: 2018-02-18
 * Time: 9:06 PM
 */
require "PasswordScripts.php";
require "SQLQuery.php";
//Get data from HTML form
$userName = $_GET['userName'];
$password = $_GET['password'];
$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    echo "<br>Connected to Oracle!</br>";
    $passwordQuery = "select password from UserTab where username='".$userName."'";
    $ociPasswordQuery = oci_parse($conn, $passwordQuery);
    selectQuery($conn, $ociPasswordQuery);
    $i = 0;
    while($row = oci_fetch_array($ociPasswordQuery, OCI_ASSOC+OCI_RETURN_NULLS)){
        ++$i;
        $checkPass = 0;
        foreach ($row as $item) {
            if (checkPass1Pass2($item, $password)){
                $checkPass = 1;
                header("Location: RegCustDatRetr.php");
                break;
            }
        }
        if($checkPass == 0){
            header('Location: ../Interfaces/LoginPageWrongPass.html');
        }
    }
    if($i == 0){
        header('Location: ../Interfaces/LoginPageNoUser.html');
    }
}