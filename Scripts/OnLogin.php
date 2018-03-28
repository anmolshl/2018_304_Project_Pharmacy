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
    $employeeCheckQuery = "select username from Pharmtech where username = '".$userName."'";
    $employeeCheck = 0;
    $employeeCheckQueryOCI = oci_parse($conn, $employeeCheckQuery);
    selectQuery($conn, $employeeCheckQueryOCI);
    while($row = oci_fetch_array($employeeCheckQueryOCI, OCI_ASSOC+OCI_RETURN_NULLS)) {
        $employeeCheck = 1;
    }
    oci_free_statement($employeeCheckQueryOCI);
    $custNo = "";
    $custNoQuery = "select customer_number from RegCustomer where username='".$userName."'";
    $custNoQueryOci = oci_parse($conn, $custNoQuery);
    selectQuery($conn, $custNoQuery);
    while($row = oci_fetch_array($custNoQueryOci, OCI_ASSOC+OCI_RETURN_NULLS)){
        foreach ($row as $item){
            $custNo = $item;
        }
    }
    oci_free_statement($custNoQueryOci);
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
                session_start();
                $_SESSION['userName'] = $userName;
                $_SESSION['custNo'] = $custNo;
                if($employeeCheck == 1){
                    header("Location: EmpDatRetr.php");
                }
                else{
                    header("Location: RegDisp.php");
                }
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