<?php
/**
 * Created by PhpStorm.
 * User: anmolsingh
 * Date: 2018-03-12
 * Time: 12:30 PM
 */

require "PasswordScripts.php";
require "SQLQuery.php";

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
    if($password1 == $password2){
        $usernameCheckQuery = "select username from userTab where username='".$username."'";
        $userCheckOci = oci_parse($conn, $usernameCheckQuery);
        selectQuery($conn, $userCheckOci);
        $row = oci_fetch_array($userCheckOci, OCI_ASSOC+OCI_RETURN_NULLS);
        if($row != null){
            echo count($row);
            //header('Location: ../Interfaces/CustomerSignUp.html');
            echo "Username already taken\n";
            echo $row[0];
        }
        else{
            $registerQueryUserTab = "insert into UserTab(username, password) VALUES ('".$username."', '".$password1."')";
            $registerQueryCust = "insert into Customer(name, address, dob, username) values ('".$name."', '".$address."', ':dob', '".$username."')";
            $nullInd = 0;
            $cust_no = 0;
            while($nullInd != 1) {
                $cust_no = rand(1, 999999);

                $custNoCheckQuery = "select customer_number from RegCustomer where customer_number= :custNo";
                $checkNoOci = oci_parse($conn, $custNoCheckQuery);
                oci_bind_by_name($checkNoOci, ":custNo", $cust_no);
                selectQuery($conn, $checkNoOci);

                $row = oci_fetch_array($checkNoOci, OCI_ASSOC+OCI_RETURN_NULLS);
                if(count($row) > 0){
                    $nullInd = 1;
                }
            }
            $registerQueryRegCust = "insert into RegCustomer(customer_number, username) values (:custNo, '".$username."')";

            $UserTabOci = oci_parse($conn, $registerQueryUserTab);
            insertQuery($conn, $UserTabOci);

            $CustOci = oci_parse($conn, $registerQueryCust);
            oci_bind_by_name($CustOci, ":dob", strtoupper(date('d-M-y', strtotime($dob))));
            insertQuery($conn, $CustOci);

            $regCustOci = oci_parse($conn, $registerQueryRegCust);
            oci_bind_by_name($regCustOci, ":custNo", $cust_no);
            insertQuery($conn, $regCustOci);

            oci_close($conn);
        }
    }
    else{
        echo "\nPasswords entered do not match!\n";
        //header('Location: ../Interfaces/CustomerSignUp.html');
    }
}
?>
