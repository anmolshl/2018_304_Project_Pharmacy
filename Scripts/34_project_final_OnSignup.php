<?php
/**
 * Created by PhpStorm.
 * User: anmolsingh
 * Date: 2018-03-12
 * Time: 12:30 PM
 */
require "34_project_final_PasswordScripts.php";
require "34_project_final_SQLQuery.php";
$password1 = $_GET['password1'];
$password2 = $_GET['password2'];
$username = $_GET['userName'];
$address = $_GET['address'];
$dob = $_GET['dob'];
$name = $_GET['name'];
$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    echo "<br>Connected to Oracle!</br>";
    if($password1 == $password2) {
        $usernameCheckQuery = "select username from userTab where username='" . $username . "'";
        $userCheckOci = oci_parse($conn, $usernameCheckQuery);
        selectQuery($conn, $userCheckOci);
        $i = 0;
        while ($row = oci_fetch_array($userCheckOci, OCI_ASSOC + OCI_RETURN_NULLS)) {
            ++$i;
            header('Location: ../Interfaces/34_project_final_CustomerSignUpUserTaken.html');
        }
        if($i == 0){
            $registerQueryUserTab = "insert into UserTab(username, password) VALUES ('" . $username . "', '" . $password1 . "')";
            $nullInd = 0;
            $cust_no = 0;
            while ($nullInd != 1) {
                $cust_no = rand(1, 999999);
                echo "<br>" . (string)$cust_no . "</br>";
                $custNoCheckQuery = "select customer_number from RegCustomer where customer_number= :custNo";
                $checkNoOci = oci_parse($conn, $custNoCheckQuery);
                oci_bind_by_name($checkNoOci, ":custNo", $cust_no);
                selectQuery($conn, $checkNoOci);
                $row = oci_fetch_array($checkNoOci, OCI_ASSOC + OCI_RETURN_NULLS);
                if (count($row) > 0) {
                    $nullInd = 1;
                }
            }
            $registerQueryCust = "insert into Customer(name, address, dob, username, customer_number) values ('" . $name . "', '" . $address . "', to_date('" . $dob . "', 'dd-mm-yyyy'), '" . $username . "', " . (string)$cust_no . ")";
            $registerQueryRegCust = "insert into RegCustomer(customer_number, username) values (:custNo, '" . $username . "')";
            $UserTabOci = oci_parse($conn, $registerQueryUserTab);
            insertQuery($conn, $UserTabOci);
            $CustOci = oci_parse($conn, $registerQueryCust);
            insertQuery($conn, $CustOci);
            $regCustOci = oci_parse($conn, $registerQueryRegCust);
            oci_bind_by_name($regCustOci, ":custNo", $cust_no);
            insertQuery($conn, $regCustOci);
            oci_close($conn);
            header('Location: ../Interfaces/34_project_final_LoginPage.html');
        }
    }
    else{
        echo "\nPasswords entered do not match!\n";
        header('Location: ../Interfaces/34_project_final_CustomerSignUpPassMismatch.html');
    }
}
?>